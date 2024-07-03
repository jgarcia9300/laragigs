<?php

use App\Http\Controllers\ListingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Listing;

//All listings
Route::get('/', [ListingController::class, 'index']);


//Show Create Form

Route::get('/listings/create',  [ListingController::class, 'create']);

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


//store listing date
Route::post('/listings/',  [ListingController::class, 'store']); //la siguiente instruccion es la que se encarga de almacenar los datos de un listado en la base de datos. ListingController es el controlador y store es el metodo que se encarga de almacenar los datos en la base de datos

//Singles Listenig
Route::get('/listings/{listing}',  [ListingController::class, 'show']); //esta linea de codigo es la que se encarga de mostrar la vista de un solo listado en donde ListingController es el controlador y show es el metodo que se encarga de mostrar la vista de un solo listad. listing aparece entre llaves porque es un parametro que se va a recibir en el metodo show