<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

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

// Show Edit Form

Route::get('/listings/{listing}/edit',  [ListingController::class, 'edit']); //esta linea de codigo es la que se encarga de mostrar la vista de edicion de un listado en donde ListingController es el controlador y edit es el metodo que se encarga de mostrar la vista de edicion de un listado. listing aparece entre llaves porque es un parametro que se va a recibir en el metodo edit

//Update Listing
Route::put('/listings/{listing}', [ListingController::class, 'update']); //esta linea de codigo es la que se encarga de actualizar los datos de un listado en la base de datos. ListingController es el controlador y update es el metodo que se encarga de actualizar los datos en la base de datos

//Delete Listing
Route::delete('/listings/{listing}',  [ListingController::class, 'destroy']); //esta linea de codigo es la que se encarga de eliminar un listado de la base de datos. ListingController es el controlador y delete es el metodo que se encarga de eliminar un listado de la base de datos

//Singles Listenig
Route::get('/listings/{listing}',  [ListingController::class, 'show']); //esta linea de codigo es la que se encarga de mostrar la vista de un solo listado en donde ListingController es el controlador y show es el metodo que se encarga de mostrar la vista de un solo listad. listing aparece entre llaves porque es un parametro que se va a recibir en el metodo show

//Show Register/Create Form
Route::get('/register',  [UserController::class, 'create']); //esta linea de codigo es la que se encarga de mostrar la vista de registro de un usuario en donde UserController es el controlador y create es el metodo que se encarga de mostrar la vista de registro de un usuario

//Create new User

Route::post('/users', [UserController::class, 'store']);

//Log User Out

Route::post('/logout', [UserController::class, 'logout']);

//Show Login Form

Route::get('/login', [UserController::class, 'login']);

//Log in user 

Route::post('/users/authenticate', [UserController::class, 'authenticate']);