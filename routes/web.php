<?php

use App\Http\Controllers\ListingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Listing;

//All listings
Route::get('/', [ListingController::class, 'index']);

//Singles Listenig

Route::get('/listings/{listing}',  [ListingController::class, 'show']);


// #uso de rutas -> acceder a propiedades o metodos del objeto
// #:: acceder a metodos estaticos. No requieren estancia del objeto
// Route::get('/hello', function() {
//   return response (view('hello'),400)
//   ->header('Content-Type', 'text/plain')
//   ->header('foo', 'bar');
// });

// Route::get('/posts/{id}', function($id){
//   return response('Post '. $id);
// })->where('id', '[0-9]+');

// Route::get('/search',function(Request $request){
//   return($request->name . ' ' . $request->city);
// });