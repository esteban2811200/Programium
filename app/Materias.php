<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materias extends Model
{
    protected $fillable = ['nombre','descripcion','estado'];
    protected $primaryKey = 'id_mater';

	public function tareas()
	{
	    return $this->hasMany(Tareas::class, 'tarea_id');
	}

}
