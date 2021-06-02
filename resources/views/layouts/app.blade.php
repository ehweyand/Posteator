<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posty</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-gray-200">
    <nav class="p-6 bg-white flex justify-between mb-6">
        <ul class="flex items-center">
            <li >
                <a href="/" class="p-3">Home</a>
            </li>
            <li>
                <a href="{{ route('dashboard') }}" class="p-3">Dashboard</a>
            </li>
            <li>
                <a href="{{ route('posts') }}" class="p-3">Post</a>
            </li>
        </ul>
        {{-- Separando informações vistas por usuários logados ou não --}}
        {{-- 
        <ul class="flex items-center">
            @if(auth()->user())
                <li>
                    <a href="" class="p-3">Evandro H. Weyand</a>
                </li>
                <li>
                    <a href="" class="p-3">Logout</a>
                </li>
            @else
                <li>
                    <a href="" class="p-3">Login</a>
                </li>
                <li>
                    <a href="{{ route('register') }}" class="p-3">Register</a>
                </li>
            @endif            
        </ul>
        --}}

        <ul class="flex items-center">
            @auth
                <li>
                    {{-- Pegando o nome do usuário logado e mostrando na tela --}}
                    <a href="" class="p-3">{{ auth()->user()->name }}</a>
                </li>
                <li>
                     {{-- Aumentando a segurança do usuário com csrf --}}
                    <form action="{{ route('logout') }}" method="post" class="p-3 inline">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                    
                </li>
            @endauth

            @guest
                <li>
                    <a href="{{ route('login') }}" class="p-3">Login</a>
                </li>
                <li>
                    <a href="{{ route('register') }}" class="p-3">Register</a>
                </li>
            @endguest           
        </ul>
    </nav>

    @yield('content')
</body>
</html>