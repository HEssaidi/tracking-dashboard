<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ligne extends Model
{
    protected $fillable = [
		'origin',
		'destination',
		'color'
	];
}
