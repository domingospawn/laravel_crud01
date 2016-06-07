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
			'joke' => $joke['body'],
            //'submitted_by' => $joke['user_id'],
            //'submitted_by' => User::find($joke['user_id'])
            //'submitted_by' => $joke['user']['name']
            //'submitted_by' => $joke['user_id']
            'user' => $joke['user']
		];
	}

    public function index()
    {
    	$jokes = Joke::all(); //Not a good idea when database grows up
    	return response()->json([
            'method' => 'index',
    		'data' => $this->transformCollection($jokes),
//          'data' => $jokes,
    		'status' => 200
    	]);
    }

    public function show($id)
    {
        $joke = Joke::with(
            array('User'=>function($query){
                $query->select('id','name');
            })
        )->find($id);        

    	if(!$joke)
        {
    		return response()->json([
    			'error' => ['message'=>'Joke does not exist'],
    			'status' => 404
    		]);
    	}

        //get previous joke id
        $previous = Joke::where('id', '<', $joke->id)->max('id');

        //get next joke id
        $next = Joke::where('id', '>', $joke->id)->min('id');

        return response()->json([
            'previous_joke_id' => $previous,
            'next_joke_id' => $next,
            'data' => $this->transform($joke),
            'status' => 200
        ]);
    }

    public function store(Request $request)
    {
        if(!$request->body or !$request->user_id)
        {
            return response()->json([
                'error' => ['message'=>'Please provide both body and user_id'],
                'status' => 422
            ]);
        }

        $joke = Joke::create($request->all());

        return response()->json([
            'message' => 'Joke created succefully',
            'data' => $this->transform($joke)
        ]);
    }

    public function update(Request $request, $id)
    {
        if(!$request->body or !$request->user_id)
        {
            return response()->json([
                'error' => ['message'=>'Please provide both body and user_id'],
                'status' => 422
            ]);
        }

        $joke = Joke::find($id);
        $joke->body = $request->body;
        $joke->user_id = $request->user_id;
        $joke->save();

        return response()->json([
            'message'=>'Joke updated succefully'
        ]);
    }

    public function destroy($id)
    {
        Joke::destroy($id);
    }
}
