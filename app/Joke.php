<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Joke extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'body', 'user_id'
    ];
}
