@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">

        @guest
            <p>To create a post, you must first login.</p>
        @endguest

        @auth
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
        @endauth

            {{--  Iterar sobre os posts --}}
            {{-- Trabalhar com a Collection do Laravel --}}
            @if($posts->count())
                @foreach($posts as $post)

                {{-- Chamando o componente criado --}}
                {{-- x-nomedocomponente e passando o objeto $post para usar lá--}}
                    <x-post :post="$post" />
                
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