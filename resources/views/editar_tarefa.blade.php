@extends('templates/home_layout')

@section('content')
    <div class="main_novaTarefa">
        <div class="formulario">
            <h4>Editar tarefa</h4>
            <hr>
            <form action="{{ route('formulario_editar_tarefa') }}" method="POST">
                @csrf
                <input type="hidden" name="tarefa_id" value="{{ Crypt::encrypt($tarefa->id) }}">
                <div class="caixa_status_selecionado">
                    <label for="titulo">Título</label>
                    <input class="titulo" type="text" name="titulo" placeholder="Nome da tarefa" required value="{{ old('titulo', $tarefa->task_name)}}">
                    @error('titulo')
                        <div class="texto-erro">{{ $errors->get('titulo')[0] }}</div>
                    @enderror
                </div>
                <div class="caixa_status_selecionado">
                    <label for="descricao">Descrição</label>
                        <textarea class="descricao" name="descricao" placeholder="Descrição da tarefa" required >{{ old('descricao', $tarefa->task_description)}}</textarea>
                    @error('descricao')
                        <div class="texto-erro">{{ $errors->get('descricao')[0] }}</div>
                    @enderror
                </div>
                <div class="caixa_status_selecionado">
                    <label for="status_selecionado">Status da tarefa:</label>
                    <select name="status_selecionado" id="status_selecionado" class="status_selecionado" required>
                        <option value="new" {{ old('status_selecionado', $tarefa->task_status) == 'new' ? "selected" : "" }}>Nova</option>
                        <option value="in_progress" {{ old('status_selecionado', $tarefa->task_status) == 'in_progress' ? "selected" : "" }}>Em progresso</option>
                        <option value="completed" {{ old('status_selecionado', $tarefa->task_status) == 'completed' ? "selected" : "" }}>Concluída</option>
                        <option value="cancelled" {{ old('status_selecionado', $tarefa->task_status) == 'cancelled' ? "selected" : "" }}>Cancelada</option>
                    </select>
                    @error('status_selecionado')
                        <div class="">{{$errors->get('status_selecionado')[0]}}</div>
                    @enderror
                </div>
                <div class="botao_caixa">
                    <button class="btn_criar" type="submit">Salvar</button>
                    <a class="btn_cancelar" href="{{ route('home') }}">Cancelar</a>
                </div>
            </form>
            @if(session()->has('task_error'))
                <div class="alert alert-danger text-center p-1">
                    {{session()->get('task_error')}}
                </div>
            @endif
        </div>
    </div>
@endsection