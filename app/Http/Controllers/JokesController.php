<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use App\Joke;
use App\User;

class JokesController extends Controller
{
	private function transformCollection($jokes)
	{
		return array_map([$this, 'transform'], $jokes->toArray());
	}

	private function transform($joke)
	{
		return [
			'joke_id' => $joke['id'],
			'joke' => $joke['body']
		];
	}

    public function index()
    {
    	$jokes = Joke::all(); //Not a good idea when database grows up
    	return response()->json([
    		'data' => $this->transformCollection($jokes),
    		'status' => 200
    	]);
    }

    public function show($id)
    {
    	$joke = Joke::find($id);

    	if(!$joke){
    		return response()->json([
    			'error' => ['message'=>'Joke does not exist'],
    			'status' => 404
    		]);
    	}

    	return response()->json([
    		'data' => $this->transform($joke),
    		'status' => 200
    	]);
    }
}
