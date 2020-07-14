<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tareas extends Model
{
    protected $fillable = ['nombre_tarea','descripcion_tarea','fecha_plazo','curso_id','materia_id','profesor_id'];
    protected $primaryKey = 'id_tarea';

    public function curso()
	{
	    return $this->belongsTo(Cursos::class, 'curso_id');
	}

	public function materia()
	{
	    return $this->belongsTo(Materias::class, 'materia_id');
	}
	 function profesor()
	{
	    return $this->belongsTo(Profesores::class, 'profesor_id', 'id_user');
	}
}
