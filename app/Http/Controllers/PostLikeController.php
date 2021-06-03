<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostLikeController extends Controller
{
    // Adicionar middleware para autenticação
    // - Para garantir que um usuário não autenticado não possa postar nada
    public function __construct() {
        $this->middleware(['auth']);
    }

    // Salvar o like
    public function store(Post $post, Request $request) {
        // Post $post de parametro captura o post inteiro do banco
        
        // Verifica se o post já foi "Likeado" pelo usuário
        if($post->likedBy($request->user())) {
            return response(null, 409); //resposta vazia. 409 : Conflict Http (mata a página)
            //poderia redirecionar com uma mensagem também para a tela de posts
        }


        // Chama o relacionamento no model Post e cria (create) um novo like para o post passado
        $post->likes()->create([
           'user_id' => $request->user()->id,

        ]);
        
        // voltar
        return back();
    }

    public function destroy(Post $post, Request $request) {
        //dd($post);

        //Resumindo procura na tabela de likes (pois tem a relação com o usuário) pois o join será feito sozinho
        // Procura pelo post_id no id passado via parâmetro
        // Digamos que chama o relacionamento e tem acesso as informações pois o relacioanemnto foi mapeado no modelo.
        $request->user()->likes()->where('post_id', $post->id)->delete();
        
        return back();
    }
}
