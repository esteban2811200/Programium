<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfesoresCursos extends Model
{
    protected $fillable = ['profesor_id','curso_id'];
}
