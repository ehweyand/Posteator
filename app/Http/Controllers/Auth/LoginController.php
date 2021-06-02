<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function index() {

        return view('auth.login');
    }

    public function store(Request $request) {

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        // Para lembrar o usuário, passamos mais um parâmetro
        /*if(!auth()->attempt($request->only('email', 'password'))) {
            return back()->with('status', 'Invalid Login details');
        }*/
        // Torna-se:
        if(!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('status', 'Invalid Login details');
        }
        // o remember traz o valor da checkbox do html, se estiver marcada, fica como "on", se não estiver fica null

        return redirect()->route('dashboard');
    }
}
