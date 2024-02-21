<div class="navbar">
    <div class="nav">
        <div class="nav-caixa"> 
            <div class="nav-titulo">
                <h1>Gestor de Tarefas</h1>
            </div>
            <div class="nav-sair">
                <h4 class="usuario">Usuário:</h4>
                <div class="nome-caixa">
                    <span class="nome">{{ session()->get('username') }}</span>
                </div>
                <div class="logout">
                    <a href="{{ route('logout') }}"><img src="{{ asset('images/sair.png')}}" alt=""></a>
                </div>
            </div>
        </div>
    </div>
</div>