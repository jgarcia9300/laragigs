<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\User;
use function Laravel\Prompts\password;

class UserController extends Controller
{
  //Show Register/Create Form
  public function create()
  {
    return view('users.register');
  }


  //Create New User

  public function store(Request $request)
  {
    $formFields = $request->validate([
      'name' => ['required', 'min:3'],
      'email' => ['required', 'email', Rule::unique('users', 'email')], //validacion de que el correo no este duplicado
      'password' => 'required|confirmed|min:6',

    ]);

    //Hash Password

    $formFields['password'] = bcrypt($formFields['password']); //encriptacion de la contraseña usando la funcion bcrypt

    //Create User
    $user = User::create($formFields);

    // Login

    auth()->login($user);

    return redirect('/')->with('message', 'User created and logged in');
  }

  // Logout user

  public function logout(Request $request)
  {

    auth()->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/')->with('message', 'You have been logged out!');
  }

  //Login Form

  public function login()
  {
    return view('users.login');
  }

  //Authenticate User

  public function authenticate(Request $request)
  {
    $formFields = $request->validate([
      'email' => ['required', 'email'], //validacion de que el correo no este duplicado
      'password' => 'required'
    ]);

    if(auth()->attempt($formFields)){
      $request->session()->regenerate();

      return redirect('/')->with('message', 'You are now logged in¡');

    }

    return back()->withErrors();
  }
}
