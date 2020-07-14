<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profesores extends Model
{
    protected $fillable = ['nombre','titulo','id_user'];
    protected $primaryKey = 'id_profe';

   	function user()
	{
	    return $this->hasOne(User::class, 'profesor_id' , 'id_user');
	}
		 function tareas()
	{
	    return $this->hasMany(Tareas::class, 'profesor_id', 'id_user');
	}
}
