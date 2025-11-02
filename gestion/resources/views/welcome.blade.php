<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a Gestión de Turnos</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600&display=swap" rel="stylesheet" />

    <style>
        /* --- Estilos inspirados en el nuevo welcome de Laravel --- */
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Instrument Sans', sans-serif;
            background-color: #C4F5FC; /* Fondo gris claro */
            color: #111827; /* Texto oscuro */
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .main-container {
            display: grid;
            grid-template-rows: auto 1fr auto;
            min-height: 100vh;
            padding: 1.5rem;
        }

        /* --- Barra de Navegación Superior --- */
        .header-nav {
            display: flex;
            justify-content: flex-end;
            gap: 0.5rem;
        }

        .nav-link {
            display: inline-block;
            padding: 0.375rem 1.25rem;
            border: 1px solid #e5e7eb;
            border-radius: 0.25rem;
            text-decoration: none;
            color: #111827;
            font-size: 0.875rem;
            transition: all 0.2s ease-in-out;
        }

        .nav-link:hover {
            border-color: #d1d5db;
            background-color: #f3f4f6;
        }

        /* --- Contenido Central (Hero) --- */
        .hero-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .logo-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 4rem;
            height: 4rem;
            border-radius: 0.75rem;

        }

        .logo-wrapper svg {
            width: 2rem;
            height: 2rem;
            color: #f9fafb; /* Ícono claro */
        }

        h1 {
            font-size: 1.875rem;
            font-weight: 600;
            letter-spacing: -0.025em;
            margin-bottom: 0.5rem;
        }

        p.subtitle {
            color: #6b7280; /* Texto secundario gris */
        }

        /* --- Botones de Acción --- */
        .actions {
            margin-top: 2rem;
            display: flex;
            gap: 1rem;
        }

        .btn {
            padding: 0.625rem 1.5rem;
            border-radius: 0.375rem;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.875rem;
            transition: all 0.2s ease-in-out;
        }

        .btn-primary {
            background-color: #011627;
            color: white;
        }
        
        .btn-primary:hover {
            background-color: white;
            color: black;
        }

        .btn-secondary {
            background-color: #f3f4f6;
            color: #111827;
            border: 1px solid #e5e7eb;
        }

        .btn-secondary:hover {
            background-color: #011627;
            color: white;
        }

    </style>
</head>
<body>

    <div class="main-container">
        <header>
            
        </header>

        <main class="hero-section">
            <div class="logo-wrapper">
            

                <img src="{{ asset('images/GestiONsolologo.png') }}" alt="Logo del Proyecto" width="1000">
                
            </div>
            <br><br><br><br><br><br><br><br><br>
            <p class="subtitle">La plataforma central para el Istituto Adventista Superior de Misiones.</p>
            
            <div class="actions">
                <a href="{{ route('login') }}" class="btn btn-primary">Iniciar Sesión</a>
                <a href="{{ route('register') }}" class="btn btn-secondary">Registrarse</a>
            </div>
        </main>

        <footer>
            </footer>
    </div>

</body>
</html>