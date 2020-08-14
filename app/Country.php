<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
     protected $fillable = [
        'iso','name','nicename','iso3','numcode','phonecode','is_active'
	];
}


     