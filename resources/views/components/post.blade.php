@props(['post' => $post])
{{-- Agora tem a variável para poder usar --}}

<div class="mb-4">
   {{-- Obs 1: user e não user() por que não queremos fazer nada com o relacionamento mas sim apenas ACESSAR --}}
   {{-- Obs 2: como $post->created_at retorna um objeto do tipo Carbon (datas), podemos manipular isso 
   diffForHumans retorna o valor de tempo decorido da postagem até o momento atual --}}
   <a href="{{ route('users.posts', $post->user) }}" class="font-bold">{{ $post->user->name }}</a> <span class="text-gray-600 text-sm"> {{ $post->created_at->diffForHumans() }}</span>
   <p class="mb-2">{{ $post->body }}</p>
   {{-- Delete posts, apenas se o usuário for dono do post através de uma Policy 
   Tem que definir em AuthServiceProvider --}}                      
   @can('delete', $post)
   <form action="{{ route('posts.destroy', $post) }}" method="post">
      @csrf
      @method('DELETE')
      <button type="submit" class="text-blue-500">Delete</button>                      
   </form>
   @endcan                                
   {{-- Like ou Unlike no post --}}
   <div class="flex items-center">
      {{-- Posts NÃO likeados pelo usuario logado --}}
      {{-- Primeiro verifica se está LOGADO algum usuário --}}
      @auth
      @if(!$post->likedBy(auth()->user()))
      {{-- Envia um parâmetro na rota para personalizar e definir qual post terá like --}}
      <form action="{{ route('posts.likes', $post)}}" method="post" class="mr-1">
         @csrf
         <button type="submit" class="text-blue-500">Like</button>
      </form>
      {{-- Posts likeado pelo usuario logado --}}
      @else
      <form action="{{ route('posts.likes', $post)}}" method="post" class="mr-1">
         @csrf
         @method('DELETE')
         <button type="submit" class="text-blue-500">Unlike</button>
      </form>
      @endif
      @endauth
      {{-- Retorna um objeto do tipo collection e usa a função count para retornar quantos registros existem na collection --}}
      {{-- Para trabalhar com string, helper Str --}}
      <span>{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }} </span>    
   </div>
</div>