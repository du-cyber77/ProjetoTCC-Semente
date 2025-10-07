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

{{-- Conteúdo principal da página --}}
@section('content')
<div class="sobre-body">
  <div class="sobre-container">

    <section class="sobre-hero">
      <span class="badge">História & Missão</span>
      <h1>Árvores de Paracambi</h1>
      <p>
        Nossa iniciativa nasceu às margens do Rio dos Macacos, em Paracambi (RJ), a partir de uma pergunta simples:
        <em>e se cada morador pudesse apadrinhar uma árvore do seu bairro e acompanhar seus cuidados no mapa?</em>
        Hoje, conectamos pessoas, escolas e áreas verdes para que a cidade floresça de forma colaborativa.
      </p>
    </section>

    <section class="missao-grid">
      <div class="missao-card">
        <h3>Missão</h3>
        <p>Mobilizar a comunidade de Paracambi para mapear, plantar e cuidar de árvores urbanas, unindo tecnologia e educação ambiental.</p>
      </div>
      <div class="missao-card">
        <h3>Visão</h3>
        <p>Transformar Paracambi em referência fluminense de corredores verdes urbanos, com sombra, biodiversidade e rios mais saudáveis.</p>
      </div>
      <div class="missao-card">
        <h3>Valores</h3>
        <p>Cuidado com o território, ciência cidadã, transparência de dados e afeto pelas pessoas e pela natureza.</p>
      </div>
    </section>

    <section class="historia-section">
      <h3>A nossa jornada em Paracambi</h3>
      <div class="historia-grid">
        
        <div>
          <div class="timeline">
            <div class="step">
              <strong>2021 – A semente</strong>
              <p>Após uma cheia do Rio dos Macacos, um grupo de professores organizou mutirões de limpeza e percebeu o potencial de plantar árvores.</p>
            </div>
            <div class="step">
              <strong>2022 – O protótipo</strong>
              <p>Nasce um mapa colaborativo para registrar árvores. Alunos do bairro Lages fizeram as primeiras marcações, batizando ipês e jequitibás.</p>
            </div>
            <div class="step">
              <strong>2023 – A virada</strong>
              <p>Com apoio de comerciantes locais, criamos o “Adote uma Árvore”. Cada adoção libera dicas de rega e um diário de cuidados.</p>
            </div>
            <div class="step">
              <strong>2024 – Corredores verdes</strong>
              <p>Ligamos praças ao longo da RJ-127 com pequenas ilhas verdes. Polinizadores voltaram a aparecer com força no nosso ecossistema.</p>
            </div>
            <div class="step">
              <strong>2025 – Hoje</strong>
              <p>Árvores de Paracambi integra escolas, associações de moradores e trilhas de educação ambiental. Cada ponto é uma história de cuidado.</p>
            </div>
          </div>
        </div>

        <div class="atuamos-card">
          <h3>Como atuamos</h3>
          <ul>
            <li><b>Mapeamos</b> árvores existentes e áreas aptas a plantio.</li>
            <li><b>Conectamos</b> voluntários a microprojetos de rega e manutenção.</li>
            <li><b>Educamos</b> com materiais didáticos e trilhas urbanas guiadas.</li>
            <li><b>Monitoramos</b> sombra, sobrevivência e biodiversidade no tempo.</li>
          </ul>
          <p>Tudo aberto e colaborativo — seus registros aparecem no mapa para inspirar novos cuidados.</p>
        </div>
      </div>
    </section>

    <section class="cta-card">
      <h3>Plante uma história com a gente</h3>
      <p>Adote uma árvore no seu quarteirão, registre no mapa e acompanhe o crescimento. Paracambi fica mais fresca, bonita e viva quando cada pessoa cuida de um pedacinho.</p>
      <a class="btn-cta" href="{{ url('/contato') }}">Quero participar</a>
    </section>

  </div>
</div>
@endsection