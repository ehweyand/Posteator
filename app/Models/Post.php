<?php

namespace App\Models;

use App\Models\Like;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'user_id'
    ];

    public function likedBy(User $user) {
        // Acessando o relacionamento com likes
        // Verificar se o usuário já deu like em algo
        // $this->likes retorna uma Collection
        // ai não precisa criar outra query
        return $this->likes->contains('user_id', $user->id);
    }

    
    // Removido, foi colocado em uma Policy
    /*public function ownedBy(User $user) {

        // Checa se o usuário tem um post
        return $user->id === $this->user_id;
        // Verifica o id do usuario passado e o post atual
    }*/


    // Para acessar também o usuário que postou o post, precisa ter a relação com o usuario

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }
}
