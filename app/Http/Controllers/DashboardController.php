<?php

namespace App\Http\Controllers;

use App\Mail\PostLiked;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller {

    // Definindo o uso de um middleware no construtor

    public function __construct() {
        $this->middleware(['auth']);
    }

    public function index() {
        //dd(auth()->user()->posts); //exibe uma Collection, com todos os posts do usuário logado!
        // data de um post por id
        // dd(Post::find(4)->created_at);
        
        /* // Forma 1
        //Configurando o envio de email
        $user = auth()->user();
        //poderia ser também: to('ehweyand@univates.br')
        // pega o email do usuário automaticamente (objeto $user)
        Mail::to($user)->send(new PostLiked());
        */

        return view('dashboard');
    }
}
