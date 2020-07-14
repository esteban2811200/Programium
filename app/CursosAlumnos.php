<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CursosAlumnos extends Model
{
    protected $fillable = ['curso_id','alumno_id'];
}
