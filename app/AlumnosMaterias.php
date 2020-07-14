<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlumnosMaterias extends Model
{
    protected $fillable = ['alumno_id','materia_id'];
}
