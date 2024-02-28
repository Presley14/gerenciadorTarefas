@extends('templates/home_layout')

@section('content')

    <div class="main_novaTarefa">
        <div class="formulario">
            <h4>Nova tarefa</h4>
            <hr>
            <form action="{{ route('submeter_nova_tarefa') }}" method="POST">
                @csrf
                <div class="caixa">
                    <label for="titulo">Título</label>
                    <input class="titulo" type="text" name="titulo" placeholder="Nome da tarefa" required value="{{ old('titulo')}}">
                    @error('titulo')
                        <div class="texto-erro">{{ $errors->get('titulo')[0] }}</div>
                    @enderror
                </div>
                <div class="caixa">
                    <label for="descricao">Descrição</label>
                        <textarea class="descricao" name="descricao" placeholder="Descrição da tarefa" required >{{ old('descricao')}}</textarea>
                    @error('descricao')
                        <div class="texto-erro">{{ $errors->get('descricao')[0] }}</div>
                    @enderror
                </div>
                <div class="botao_caixa">
                    <button class="btn_criar" type="submit">Criar</button>
                    <a class="btn_cancelar" href="{{ route('home') }}">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@endsection
