@extends('layouts.app')

{{-- Botões que vão aparecer no cabeçalho --}}
@section('header-buttons')
    <div class="auth-section">
        <div class="auth-buttons" id="authButtons">
        <button class="auth-button btn-login" onclick="window.location='{{ route('contato.form') }}'">Entrar</button>
        <button class="auth-button btn-register" onclick="window.location='{{ route('contato.form') }}'">Criar Conta</button>
    </div>
        <div class="user-info" id="userInfo" style="display: none;">
            <div class="user-avatar" id="userAvatar"></div>
            <div class="user-name" id="userName"></div>
            <button class="btn-logout" onclick="logout()">Sair</button>
        </div>
    </div>
@endsection

@section('content')
<div class="curiosidades-container">
    <div class="curiosidades-header">
        <h1>Curiosidades sobre Árvores</h1>
        <p>Em breve, este espaço estará cheio de fatos interessantes sobre o mundo das árvores!</p>
    </div>

    <div class="curiosidades-grid">
        <div class="curiosidade-card">
            <div class="curiosidade-icon">🌳</div>
            <h3>As Maiores Árvores</h3>
            <p>Descubra quais são as maiores árvores do mundo e onde elas estão.</p>
            <span>(Em breve)</span>
        </div>

        <div class="curiosidade-card">
            <div class="curiosidade-icon">🍃</div>
            <h3>Comunicação Secreta</h3>
            <p>Saiba como as árvores se comunicam através de uma rede subterrânea.</p>
            <span>(Em breve)</span>
        </div>

        <div class="curiosidade-card">
            <div class="curiosidade-icon">🕰️</div>
            <h3>As Mais Antigas</h3>
            <p>Conheça as árvores milenares que existem há milhares de anos.</p>
            <span>(Em breve)</span>
        </div>
    </div>
</div>
@endsection