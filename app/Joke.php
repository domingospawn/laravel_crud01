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


    /**
    * Joke belongs to a user
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
