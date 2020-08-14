<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
     protected $fillable = [
        'id_post','id_user','v_type'
	];

	public function User()
    {
        return $this->hasOne('App\User','id','id_user');
    }
}

