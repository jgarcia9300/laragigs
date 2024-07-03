<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

//la clase ListingController extiende de Controller y se encarga de mostrar la vista de un solo listado
class ListingController extends Controller
{
    // Show all listings
    public function index() {
        return view('listings.index', [ //la vista que se va a mostrar
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->get() //la variable listings que se va a mostrar en la vista y Listing::latest()->get() es la consulta que se hace a la base de datos para obtener los listados mas recientes. filter(request(['tag', 'search'])) es un metodo que se encarga de filtrar los listados por tag y search
          ]);
    }


    // Show  single Listing
    //el metodo show recibe un parametro de tipo Listing llamado $listing
    public function show(Listing $listing) {
      return view('listings.show', [
        'listing' => $listing //este array se va a mostrar en la vista show.blade.php y contiene la variable listing que es el listado que se va a mostrar
      ]);
    }

    // Show Create Form

    public function create() {
      return view('listings.create');
    }

    // Store Listing Data
    public function store(Request $request) {
      $formFields = $request->validate([ //se valida que los campos del formulario sean correctos
        'title' => 'required',
        'company' => ['required', Rule::unique('listings', 'company') ],
        'location' => 'required',
        'website' => 'required',
        'email' => ['required', 'email'],
        'tags' => 'required',
        'description' => 'required'
      ]);

      return redirect('/'); //se redirige a la pagina principal
    }


    }

