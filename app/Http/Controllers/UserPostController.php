<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserPostController extends Controller
{
    public function index(User $user) {
        //Eager Loading
        // Puxa o relacionamento novamente
        // Configurando o eager loading para carregar os relacionamentos que vamos usar!
        $posts = $user->posts()->with(['user', 'likes'])->paginate(10);



        // Renderizar a view e mostrar todas as informações desejadas
        return view('users.posts.index', [
            'user' => $user,
            'posts' => $posts

        ]);
    }
}
