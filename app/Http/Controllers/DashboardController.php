<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller {

    // Definindo o uso de um middleware no construtor

    public function __construct() {
        $this->middleware(['auth']);
    }

    public function index() {
        //dd(auth()->user()->posts); //exibe uma Collection, com todos os posts do usuário logado!
        // data de um post por id
        // dd(Post::find(4)->created_at);

        
        return view('dashboard');
    }
}
