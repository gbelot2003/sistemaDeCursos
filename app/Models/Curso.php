<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'horario', 'inicio', 'final'];

    // Relacion muchos a muchos con students
    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

}
