<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sementes no Mapa</title>

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stylefooter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stylesobre.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stylecontato.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stylewpp.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stylecuriosidades.css') }}">

    {{-- Bibliotecas externas --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    {{-- Barra azul do cabeçalho --}}
    <header class="header">
        {{-- Container para centralizar o conteúdo --}}
        <div class="header-container">
    
            <div class="header-logo">
                <h1>Sementes no Mapa</h1>
            </div>
        
            <nav class="header-nav">
                <a href="{{ url('/') }}">Início</a>
                <a href="{{ url('/curiosidades') }}">Curiosidades</a>
                <a href="{{ url('/sobre') }}">Sobre</a>
                <a href="{{ url('/contato') }}">Contato</a>
            </nav>
    
            {{-- Espaço para os botões de Entrar/Cadastrar --}}
            <div class="header-buttons">
                @yield('header-buttons')
            </div>

        </div>
    </header>

    {{-- Conteúdo principal da página --}}
   <main class="@if(request()->is('contato')) contact-page-main @endif">
    @yield('content')
</main>

    {{-- Rodapé --}}
    <footer>
        &copy; 2025 Sementes no Mapa. Todos os direitos reservados.
    </footer>

</body>
</html>