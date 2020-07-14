<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvidenciasTareas extends Model
{
    protected $fillable = ['evidencia','tarea_id','alumno_id'];
}
