@extends('templates/main_layout')
@section('content')

    <div>
        <div class="topo">
            <div>
                <h1>Tarefas</h1>
            </div>
            <form action="" method="POST">
                @csrf
                <div class="pesquisar_caixa">
                    <label for="pesquisar">Pesquisar:</label>
                    <input class="pesquisar" type="text" name="pesquisar" id="pesquisar" placeholder="Pesquisar tarefas...">
                    <button class="btn_buscar" type="submit"><img src="images/procurar.png" alt=""></img></button>
                </div>
            </form>
            <div class="nova_tarefa">
                <a class="link_nova_tarefa" href="{{ route('nova_tarefa') }}"><p class="p">Nova tarefa</p><img class="img_nova_tarefa" src="images/novatarefa.png" alt="nova tarefa"></a>
            </div>
        </div>
        <table id="tabela-tarefas">
            <thead>
                <tr>
                    <th>Tarefas</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function(){
            $('#tabela-tarefas').DataTables({
                data: @jason($tarefa),
                columns: [
                    {data: 'nome_tarefa'},
                    {data: 'status_tarefa'},
                    {data: 'acao_tarefa'}
                ]
            });
        });
    </script>
@endsection
