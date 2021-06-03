<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    // Recebe por padrão o usuário atualmente autenticado
    // E também o modelo que vai ser analisado a ação
    public function delete(User $user, Post $post) {

        // Da para praticamente usar a mesma verificação implementada no model para testar se um post é de algum user
        return $user->id === $post->user_id;
        // Retorna true se tiver permissão

    }
}
