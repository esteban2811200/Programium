<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumnos extends Model
{
    protected $fillable = ['nombre', 'apellidos', 'edad', 'id_user'];
    protected $primaryKey = 'id_alum';

    function user()
	{
	    return $this->hasOne(User::class, 'alumno_id' , 'id_user');
	}
}