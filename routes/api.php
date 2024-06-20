<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/posts', function() {
  return response()->json([
    'posts' => [
      [
        'title' => 'Post One'
      ] 
    ]
  ]);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request){
  return $request->user();
});

Route::get('/hello', function() {
  return response (view('hello'),400)
  ->header('Content-Type', 'text/plain')
  ->header('foo', 'bar');
});