<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cursos extends Model
{
    protected $fillable = ['nombre', 'descripcion', 'nivel', 'estado'];
	protected $primaryKey = 'id_curso';
 //   	public function cliente()
	// {
	//     return $this->belongsTo(Clientes::class, 'cliente_id');
	// }
	public function tareas()
	{
	    return $this->hasMany(Tareas::class, 'curso_id');
	}
	 function evaluaciones()
	{
	    return $this->hasMany(Evaluaciones::class, 'curso_id');
	}

    public function foro()
	{
	    return $this->hasOne(Foro::class, 'curso_id');
	}

}