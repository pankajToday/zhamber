<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostLang extends Model
{
    protected $fillable = [
        'id_post','language','is_active'
	];
}
