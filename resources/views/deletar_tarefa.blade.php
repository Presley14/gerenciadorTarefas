@extends('templates/home_layout')
@section('content')
    <div >
        <div class="caixa_titulo_excluirTarefa">
            <h4 class="titulo_excluirTarefa">Excluir tarefa</h4>
        </div>
        <hr>
        <div class="main_excluir">
            <p class="titulo_deletar">Deseja excluir a tarefa:</p><h3>{{ $tarefa->task_name }}</h3><p>?</p>
        </div>
        <div class="caixa_link_">
            <a class="btn_cancelar" href="{{ route('home') }}">Cancelar</a>
            <a class="btn_excluir" href="{{ route('deletar_tarefa_selecionada', ['id' => Crypt::encrypt($tarefa->id)]) }}">Excluir</a>    
        </div>    
    </div>   
@endsection