@extends('templates/login_layout')
@section('content')


    <div class="main">
        <h1 class="titulo">Cadastrar-se</h1>
        <p class="rapido">É rápido e fácil.</p>
        <form method="POST" action="{{ route('criarCadastro') }}">
            @csrf
            <div class="nome">
                <label for="nome">Usuário</label>
                <input type="text" id="nome" name="nome" required placeholder="Nome de usuário">
            </div>
            <div class="senha">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" required placeholder="Senha">
            </div>
            <div class="botao-caixa">
                <button class="botao-cadastro" type="submit">Cadastre-se</button>
                <a class="cancelar" href="{{ route('login') }}">Cancelar</a>
            </div>
        </form> 
    </div>

@endsection
