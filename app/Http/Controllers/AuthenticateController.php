<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthenticateController extends Controller
{
  public function __construct()
  {
    $this->middleware('jwt.auth', ['except' => ['authenticate']]);
  }

  /**
  *Display a listing of the resource
  *
  *@return \Illuminate\Http\Response
  */
  public function index()
  {
    
  }

}
