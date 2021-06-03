<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index() {

        //$posts = Post::get(); // get all

        // Melhor desempenho:
        // Utilizar Eager loading (ansioso) para reduzir o número de queries desnecessárias (ver laraveldebugbar)
        // passa no array as relações do model Post (user e likes)
        $posts = Post::latest()->with(['user','likes'])->paginate(10); //pega todos posts, 2 por página. Retorna em $posts agora um objeto LengthAwarePaginator
        // para ordenar poderia ser também orderBy('created_at', 'desc')
        // salva bastante processamento puxando aos poucos (apenas 2 agora)

        return view('posts.index', ['posts' => $posts]);
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


        // Criando um post acessando o relacionamento do user com posts
        $request->user()->posts()->create($request->only('body'));


        return back(); // retorna para a página anterior

    }

    public function destroy(Post $post) {

        //segurança adicionar para deletar um post
        
        // throw a exception
        $this->authorize('delete', $post); //nome do método: delete, definido na Policy.
        //o $user será recebido automaticamente pelo Laravel puxando ele da sessão
        
        $post->delete();

        return back();
    }
}
