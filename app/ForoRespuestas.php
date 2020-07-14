<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForoRespuestas extends Model
{
    protected $fillable = ['contenido_r', 'user_id', 'foro_id'];

	public function foro()
	{
	    return $this->belongsTo(Foro::class, 'foro_id');
	}

		public function user()
	{
	    return $this->belongsTo(User::class, 'user_id');
	}
}
