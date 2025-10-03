@extends('layouts.app')

{{-- Botões que vão aparecer no cabeçalho --}}
@section('header-buttons')
    <div class="auth-section">
        <div class="auth-buttons" id="authButtons">
            <button class="auth-button btn-login" onclick="openModal('loginModal')">Entrar</button>
            <button class="auth-button btn-register" onclick="openModal('registerModal')">Criar Conta</button>
        </div>
        <div class="user-info" id="userInfo" style="display: none;">
            <div class="user-avatar" id="userAvatar"></div>
            <div class="user-name" id="userName"></div>
            <button class="btn-logout" onclick="logout()">Sair</button>
        </div>
    </div>
@endsection

{{-- Conteúdo principal da página --}}
@section('content')
    <div class="form-container">
        <h1>Entre em Contato</h1>
        
        <form action="{{ route('contato.store') }}" method="POST">
            @csrf
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" placeholder="Seu nome" required>

            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" placeholder="seu@email.com" required>

            <label for="mensagem">Mensagem</label>
            <textarea id="mensagem" name="mensagem" rows="5" placeholder="Digite sua mensagem..." required></textarea>

            <button type="submit">Enviar</button>
        </form>
    </div>

    <a href="https://wa.me/5521967044188?text=Olá,%20rei%20do%20Python!" 
     class="whatsapp-float" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>
@endsection