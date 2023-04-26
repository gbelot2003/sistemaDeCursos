<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'apellido', 'edad', 'email'];

    // Relacion muchos a muchos Cursos
    public function cursos()
    {
        return $this->belongsToMany(Curso::class);
    }
}
