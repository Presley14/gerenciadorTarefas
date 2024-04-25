<div class="navbar">
    <div class="nav">
        <div class="nav-caixa"> 
            <div class="nav-titulo">
                <h1 class="titulo_pagina">Gestor de Tarefas<img class="img_titulo" src="{{ asset('images/tarefas.png') }}" alt="Tarefas" ></h1>
            </div>
            <div class="nav-sair">
                <h4 class="usuario_nav"><img src="{{ asset('images/usuario.png') }}" alt="Usuario"></h4>
                <div class="nome_caixa">
                    <span class="nome">{{ session()->get('username') }}</span>
                </div>
                <div class="logout">
                    @if(Route::currentRouteName() == 'home')
                        <a href="{{ route('logout') }}"><img src="{{ asset('images/sair.png')}}" alt=""></a>
                    @else
                        <a href="{{ route('home') }}"><img src="{{ asset('images/casa.png')}}" alt=""></a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
