@extends('templates/login_layout')
@section('content')


    <div class="main">
        <h1 class="titulo">Cadastrar-se</h1>
        <p class="rapido">É rápido e fácil.</p>
        <form method="POST" action="{{ route('criarCadastro') }}">
            @csrf
            <div class="nome">
                <label for="nome">Usuário</label>
                <input type="text" id="nome" name="nome" value="{{ old('nome') }}" required placeholder="Nome de usuário">
                @error('nome')
                    <div class="texto-erro">{{ $errors->get('nome')[0] }}</div>
                @enderror
            </div>
            <div class="senha">
                <label for="senha">Senha</label>
                <div class="input-com-botao">
                    <input type="password" id="senha" name="senha" value="{{ old('senha') }}" required placeholder="Senha">
                    <img class="olho" id="botao_mostrar" src="{{ asset('images/fechado.png') }}" alt=""><button type="button" ></button></img> 
                </div>
                @error('senha')
                    <div class="texto-erro">{{ $errors->get('senha')[0] }}</div>
                @enderror
            </div>
            <div class="botao-caixa">
                <button class="botao-cadastro" type="submit">Cadastre-se</button>
                <a class="cancelar" href="{{ route('login') }}">Cancelar</a>
            </div>
        </form> 
    </div>
    <script>
        
        const senha = document.querySelector('#senha')
        const btn = document.querySelector('#botao_mostrar')

        btn.addEventListener('click', ()=>{
            if(senha.type === 'password'){
                senha.type = 'text'
                btn.src = 'images/aberto.png'
            }else{
                senha.type = 'password'
                btn.src = 'images/fechado.png'
            }
        })

    </script>

@endsection
