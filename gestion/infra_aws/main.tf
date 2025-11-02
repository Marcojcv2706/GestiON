# infra_aws/main.tf

terraform {
  required_providers {
    aws = {
      source  = "hashicorp/aws"
      version = "~> 5.0"
    }
  }
}

provider "aws" {
  region = "us-east-1" # Elige tu región
}

# --- Variables (para personalización) ---
variable "db_username" {
  description = "Usuario admin de la BD"
  default     = "admin"
}
variable "db_password" {
  description = "Password admin de la BD"
  type        = string
  sensitive   = true
  # ¡CORRECCIÓN! El valor 'default' se ha quitado.
  # Jenkins inyectará el valor de forma segura.
}

# --- RED (VPC) ---
resource "aws_vpc" "main" {
  cidr_block = "10.0.0.0/16"
  enable_dns_support   = true
  enable_dns_hostnames = true
  
  tags = {
    Name = "proyecto-vpc"
  }
}

resource "aws_subnet" "public_a" {
  vpc_id                  = aws_vpc.main.id
  cidr_block              = "10.0.1.0/24"
  availability_zone       = "us-east-1a"
  map_public_ip_on_launch = true
  
  tags = { Name = "proyecto-public-a" }
}

resource "aws_subnet" "public_b" {
  vpc_id                  = aws_vpc.main.id
  cidr_block              = "10.0.2.0/24"
  availability_zone       = "us-east-1b"
  map_public_ip_on_launch = true

  tags = { Name = "proyecto-public-b" }
}

resource "aws_subnet" "private_a" {
  vpc_id                  = aws_vpc.main.id
  cidr_block              = "10.0.3.0/24"
  availability_zone       = "us-east-1a"
  
  tags = { Name = "proyecto-private-a" }
}

resource "aws_subnet" "private_b" {
  vpc_id                  = aws_vpc.main.id
  cidr_block              = "10.0.4.0/24"
  availability_zone       = "us-east-1b"
  
  tags = { Name = "proyecto-private-b" }
}

resource "aws_internet_gateway" "gw" {
  vpc_id = aws_vpc.main.id
  tags   = { Name = "proyecto-igw" }
}

resource "aws_route_table" "public" {
  vpc_id = aws_vpc.main.id
  route {
    cidr_block = "0.0.0.0/0"
    # --- ¡CORRECCIÓN DE TYPO! ---
    # Era 'aws__internet_gateway' y debe ser 'aws_internet_gateway'
    gateway_id = aws_internet_gateway.gw.id
  }
  tags = { Name = "proyecto-public-rt" }
}

resource "aws_route_table_association" "public_a" {
  subnet_id      = aws_subnet.public_a.id
  route_table_id = aws_route_table.public.id
}

resource "aws_route_table_association" "public_b" {
  subnet_id      = aws_subnet.public_b.id
  route_table_id = aws_route_table.public.id
}


# --- Grupos de Seguridad (Firewall) ---

resource "aws_security_group" "alb_sg" {
  name        = "proyecto-alb-sg"
  description = "Permite HTTP/HTTPS desde internet"
  vpc_id      = aws_vpc.main.id

  ingress {
    from_port   = 80
    to_port     = 80
    protocol    = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
  }
  
  egress {
    from_port   = 0
    to_port     = 0
    protocol    = "-1"
    cidr_blocks = ["0.0.0.0/0"]
  }
}

resource "aws_security_group" "ecs_sg" {
  name        = "proyecto-ecs-sg"
  description = "Permite trafico desde el ALB"
  vpc_id      = aws_vpc.main.id

  ingress {
    from_port       = 80
    to_port         = 80
    protocol        = "tcp"
    security_groups = [aws_security_group.alb_sg.id] # Solo permite tráfico del ALB
  }

  egress {
    from_port   = 0
    to_port     = 0
    protocol    = "-1"
    cidr_blocks = ["0.0.0.0/0"] # Permite salida a internet
  }
}

resource "aws_security_group" "rds_sg" {
  name        = "proyecto-rds-sg"
  description = "Permite trafico desde los contenedores ECS"
  vpc_id      = aws_vpc.main.id

  ingress {
    from_port       = 3306 # Puerto de MySQL
    to_port         = 3306
    protocol        = "tcp"
    security_groups = [aws_security_group.ecs_sg.id] # Solo permite tráfico de la app
  }

  egress {
    from_port   = 0
    to_port     = 0
    protocol    = "-1"
    cidr_blocks = ["0.0.0.0/0"]
  }
}


# --- REGISTRO DE CONTENEDORES (ECR) ---
resource "aws_ecr_repository" "app_repo" {
  name = "proyecto-gestion-app" # Nombre para la imagen de la app
}

resource "aws_ecr_repository" "web_repo" {
  name = "proyecto-gestion-web" # Nombre para la imagen de nginx
}


# --- BASE DE DATOS (RDS) ---
resource "aws_db_subnet_group" "rds_subnet_group" {
  name       = "proyecto-rds-subnet-group"
  subnet_ids = [aws_subnet.private_a.id, aws_subnet.private_b.id]
}

resource "aws_db_instance" "main" {
  identifier_prefix     = "proyecto-db"
  engine                = "mysql"
  engine_version        = "8.0"
  instance_class        = "db.t3.micro" 
  allocated_storage     = 20
  
  db_name               = "gestion_db"
  username              = var.db_username
  password              = var.db_password
  
  db_subnet_group_name  = aws_db_subnet_group.rds_subnet_group.name
  vpc_security_group_ids = [aws_security_group.rds_sg.id]
  
  skip_final_snapshot   = true
  publicly_accessible   = false
}


# --- BALANCEADOR DE CARGA (ALB) ---
resource "aws_alb" "main" {
  name               = "proyecto-alb"
  internal           = false
  load_balancer_type = "application"
  security_groups    = [aws_security_group.alb_sg.id]
  subnets            = [aws_subnet.public_a.id, aws_subnet.public_b.id]
}

resource "aws_alb_target_group" "app" {
  name        = "proyecto-alb-tg"
  port        = 80
  protocol    = "HTTP"
  vpc_id      = aws_vpc.main.id
  target_type = "ip" # Requerido para Fargate

  health_check {
    path = "/" 
  }
}

resource "aws_alb_listener" "http" {
  load_balancer_arn = aws_alb.main.arn
  port              = "80"
  protocol          = "HTTP"

  default_action {
    type             = "forward"
    target_group_arn = aws_alb_target_group.app.arn
  }
}


# --- CLÚSTER (ECS) ---
resource "aws_ecs_cluster" "main" {
  name = "proyecto-cluster"
}

# --- Rol IAM para las tareas de ECS ---
resource "aws_iam_role" "ecs_task_execution_role" {
  name = "proyecto-ecs-task-execution-role"
  assume_role_policy = jsonencode({
    Version = "2012-10-17"
    Statement = [
      {
        Action = "sts:AssumeRole"
        Effect = "Allow"
        Principal = {
          Service = "ecs-tasks.amazonaws.com"
        }
      }
    ]
  })
}

# Política para que ECS pueda bajar imágenes de ECR y enviar logs
resource "aws_iam_role_policy_attachment" "ecs_task_execution_policy" {
  role       = aws_iam_role.ecs_task_execution_role.name
  policy_arn = "arn:aws:iam::aws:policy/service-role/AmazonECSTaskExecutionRolePolicy"
}

# --- SALIDA (Output) ---
output "alb_dns_name" {
  value = aws_alb.main.dns_name
  description = "La URL pública de la aplicación"
}

output "db_endpoint" {
  value = aws_db_instance.main.endpoint
  description = "El endpoint de la base de datos RDS"
}

output "ecr_app_repo_url" {
  value = aws_ecr_repository.app_repo.repository_url
}

output "ecr_web_repo_url" {
  value = aws_ecr_repository.web_repo.repository_url
}