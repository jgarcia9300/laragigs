<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

//la clase ListingController extiende de Controller y se encarga de mostrar la vista de un solo listado
class ListingController extends Controller
{
  // Show all listings
  public function index()
  {
    return view('listings.index', [ //la vista que se va a mostrar
      'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6) //la variable listings que se va a mostrar en la vista y Listing::latest()->get() es la consulta que se hace a la base de datos para obtener los listados mas recientes. filter(request(['tag', 'search'])) es un metodo que se encarga de filtrar los listados por tag y search
    ]);
  }


  // Show  single Listing
  //el metodo show recibe un parametro de tipo Listing llamado $listing
  public function show(Listing $listing)
  {
    return view('listings.show', [
      'listing' => $listing //este array se va a mostrar en la vista show.blade.php y contiene la variable listing que es el listado que se va a mostrar
    ]);
  }

  // Show Create Form

  public function create()
  {
    return view('listings.create');
  }

  // Store Listing Data
  public function store(Request $request)
  {
    $formFields = $request->validate([ //se valida que los campos del formulario sean correctos
      'title' => 'required',
      'company' => ['required', Rule::unique('listings', 'company')],
      'location' => 'required',
      'website' => 'required',
      'email' => ['required', 'email'],
      'tags' => 'required',
      'description' => 'required'
    ]);

    if($request->hasFile('logo')){ //si la peticion tiene un archivo llamado logo
      $formFields['logo'] = $request->file('logo')->store('logos', 'public'); //se guarda el archivo en la carpeta logos del disco public (configurado en config/filesystems.php)
    }

    $formFields['user_id'] = auth()->id(); //se agrega el id del usuario autenticado al array de campos del formulario

    Listing::create($formFields);


    return redirect('/')->with('message', 'Listing created successfully!'); //se redirige a la pagina principal ->with es un metodo que se encarga de enviar un mensaje a la vista


  }


  //Edit Listing
  public function edit(Listing $listing){
    return view('listings.edit', [
      'listing' => $listing
    ]);
  }

  // Update Listing Data
  public function update(Request $request, Listing $listing)
  {
    //make sure logged in user is the owner of the listing

    if($listing->user_id != auth()->id()){
      abort(403, 'Unauthorized Action');
    }

    $formFields = $request->validate([ //se valida que los campos del formulario sean correctos
      'title' => 'required',
      'company' => 'required',
      'location' => 'required',
      'website' => 'required',
      'email' => ['required', 'email'],
      'tags' => 'required',
      'description' => 'required'
    ]);

    if($request->hasFile('logo')){ //si la peticion tiene un archivo llamado logo
      $formFields['logo'] = $request->file('logo')->store('logos', 'public'); //se guarda el archivo en la carpeta logos del disco public (configurado en config/filesystems.php)
    }

  $listing->update($formFields);

    return back()->with('message', 'Listing update successfully!'); //se redirige a la pagina anterior ->with es un metodo que se encarga de enviar un mensaje a la vista

  }

  // Delete Listing

  public function destroy(Listing $listing){
        //make sure logged in user is the owner of the listing

        if($listing->user_id != auth()->id()){
          abort(403, 'Unauthorized Action');
        }
    $listing->delete();
    return redirect('/')->with('message', 'Listing deleted successfully!'); //se redirige a la pagina principal ->with es un metodo que se encarga de enviar un mensaje a la vista
  }

  // Manage Listings

  public function manage(){
    return view('listings.manage', [
      'listings' => auth()->user()->listings()->get()]);//se obtienen los listados del usuario autenticado

}
}