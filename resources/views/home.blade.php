@extends('templates/home_layout')
@section('content')

    <div class="main_home">
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
        <hr>
        <div>
            @if(count($tarefas) > 0)
                <table id="tabela_tarefas" class="tabela_tarefas">
                    <thead class="cabeca">
                        <tr>
                            <th class="coluna_tarefa">Tarefas</th>
                            <th class="coluna">Status</th>
                            <th class="coluna">Mais</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            @else
                <div class="sem_terefa_caixa">
                    <div class="sem_tarefas_link_caixa">
                        <p class="sem_tarefas">Você ainda não possue tarefas registradas. Criar</p><a class="sem_tarefas_link" href="{{ route('nova_tarefa') }}">nova tarefa.</a> 
                    </div>
                </div>
            @endif  
        </div>
    </div>
    
    <script>
        $(document).ready(function(){
            $('#tabela_tarefas').DataTable({
                data: @json($tarefas),
                columns: [
                    {data: 'nome_tarefa'},
                    {data: 'status_tarefa'},
                    {data: 'actions_tarefa'},
                ], // OBS: não esquecer da vírgula, pois ela serve para separar os elementos abaixo que também fazem parte do objeto
                // Oculta o seletor de número de entradas por página
                "lengthChange": false,
                // Oculta a informação de número de entradas exibidas
                "info": false,
                // Oculta o campo de pesquisa
                "searching": false,
                // Oculta a paginação
                "paging": false,
            });
        });
    </script>
@endsection
