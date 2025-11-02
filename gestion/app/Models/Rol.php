<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model {
    use HasFactory;
    protected $table = 'roles';
    protected $fillable = ['name'];
    public $timestamps = false; // Coincide con la migración
    public function users() { return $this->hasMany(User::class, 'role_id'); }
}