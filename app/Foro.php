<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foro extends Model
{
	protected $primaryKey = 'id_foro';
    protected $fillable = ['contenido','archivo','curso_id','profesor_id'];

	public function respuestas()
	{
	    return $this->hasMany(ForoRespuestas::class, 'foro_id');
	}

}
