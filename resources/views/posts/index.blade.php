@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <form action="{{ route('posts') }}" method="post" class="mb-4">
                @csrf
                <div class="mb-4">
                    <label for="body" class="sr-only">Body</label>
                    <textarea name="body" id="body" cols="30" rows="4" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror" placeholder="Post something!"></textarea>
                
                    @error('body')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Post</button>
                </div>
            </form>

            {{--  Iterar sobre os posts --}}
            {{-- Trabalhar com a Collection do Laravel --}}
            @if($posts->count())
                @foreach($posts as $post)
                    <div class="mb-4">
                    {{-- Obs 1: user e não user() por que não queremos fazer nada com o relacionamento mas sim apenas ACESSAR --}}
                    {{-- Obs 2: como $post->created_at retorna um objeto do tipo Carbon (datas), podemos manipular isso 
                    diffForHumans retorna o valor de tempo decorido da postagem até o momento atual --}}
                        <a href="" class="font-bold">{{$post->user->name}}</a> <span class="text-gray-600 text-sm">Date: {{ $post->created_at->diffForHumans() }}</span>

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
                @endforeach
                {{-- Tailwind tem um pagination pronto e formatado para uso, que automaticamente vai estilizar os elementos
                adicionados pelo paginate no método links --}}
                {{ $posts->links()}}
            @else
                <p>There are no posts</p>
            @endif

        </div>
    </div>
@endsection