<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {
        return view('posts.index');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'body' => 'required'
        ]);
        
        /*
        // Cria um posto no banco com o usuário autenticado.
        Post::create([
            'user_id' => auth()->id(), //ou:  auth()->user()->id
            'body' => $request->body
        ]);*/

        //Outra forma de pegar o usuário autenticado atual:
        // $request->user()->id

        // Forma ideal:
        //auth()->user()->posts()->create();

        //Criando um post pelo user
        /*$request->user()->posts()->create([
            // automaticamente irá preencher o user_id
            'body' => $request->body
        ]);*/
        
        $request->user()->posts()->create($request->only('body'));


        return back(); // retorna para a página anterior

    }
}
