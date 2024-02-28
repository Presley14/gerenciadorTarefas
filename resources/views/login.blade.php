@extends('templates/login_layout')
@section('content')
    

    <div class="main">
        <h1 class="titulo">Gestor de tarefas</h1>
        <form action="{{ route( 'submeter_login' )}}" method="POST">
            @csrf
            <div class="nome">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" required placeholder="Nome" value="{{old('nome')}}">
                
                @error('nome')
                    <div class="texto-erro">{{ $errors->get('nome')[0] }}</div>
                @enderror
            </div>
            <div class="senha">
                <label for="senha">Senha</label>
                <div class="input-com-botao">
                    <input type="password" id="senha" name="senha" required placeholder="Senha" value="{{old('senha')}}">
                    <img src="{{ 'images/fechado.png' }}" id="btn_mostrar" class="olho" alt=""><button type="button"></button></img>
                </div>
                @error('senha')
                    <div class="texto-erro">{{ $errors->get('senha')[0] }}</div>
                @enderror
            </div>
            <div>
                <button class="button-entrar" type="submit">Entrar</button>
            </div>

            @if(session()->has('login_error'))
                <div class="texto-erro">
                    {{session()->get('login_error')}}
                </div>
            @endif
        </form>
        <div class="hr">
           <hr> 
        </div>
        <div class="botao-cadastro-caixa">
            <a class="botao-criar" href="{{ route('cadastro') }}">Criar conta</a>
        </div>
    </div>
    <p class="inf-adicional">Crie uma conta e gerencie suas tarefas do dia-a-dia.</p>
    <script>

        const btn = document.querySelector('#btn_mostrar')
        const sehna = document.querySelector('#senha')

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
