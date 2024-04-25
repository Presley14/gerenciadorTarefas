@extends('templates/home_layout')
@section('content')

    <div class="main_home">
        <div class="topo">
            <div>
                <h1 class="titulo_pesquisa">Tarefas </h1>
            </div>
            <form class="form_topo" action="{{ route('pesquisar_tarefa') }}" method="POST">
                @csrf
                <div class="pesquisar_caixa">
                    <label for="pesquisar">Pesquisar:</label>
                    <div class="pesq_btn">
                        <input class="pesquisar_" type="text" name="pesquisar" id="pesquisar" placeholder="Pesquisar tarefas...">
                        <button class="btn_buscar" type="submit"><img class="lupa" src="images/lupa.png" alt=""></img></button>                        
                    </div>
                </div>
                <div class="filter_caixa">
                    <label>Estado:</label>
                    <select name="filtro" id="status_filtro" class="pesquisar">
                        <option value="{{ Crypt::encrypt('all')}}" @php echo (!empty($filtro) && $filtro == 'all') ? 'selected' : ''@endphp>Todas</option>
                        <option value="{{ Crypt::encrypt('new')}}" @php echo (!empty($filtro) && $filtro == 'new') ? 'selected' : ''@endphp>Nova</option>
                        <option value="{{ Crypt::encrypt('in_progress')}}" @php echo (!empty($filtro) && $filtro == 'in_progress') ? 'selected' : ''@endphp>Em progresso</option>
                        <option value="{{ Crypt::encrypt('cancelled')}}" @php echo (!empty($filtro) && $filtro == 'cancelled') ? 'selected' : ''@endphp>Cancelada</option>
                        <option value="{{ Crypt::encrypt('completed')}}" @php echo (!empty($filtro) && $filtro == 'completed') ? 'selected' : ''@endphp>Concluída</option>
                    </select>
                </div>
            </form>
            <div class="nova_tarefa">
                <a class="link_nova_tarefa" href="{{ route('nova_tarefa') }}"><p class="p">Nova tarefa</p><img class="img_nova_tarefa" src="images/novatarefa.png" alt="nova tarefa"></a>
            </div>
        </div>
        <hr>
        <div class="caixa_tabela">
            @if(!is_null($tarefas))
                <div class="centralizar">
                    <div class="scrollable-content">
                        <table id="tabela_tarefas" class="tabela_tarefas">
                            <thead class="cabeca">
                                <tr>
                                    <th class="coluna_tarefa">Tarefas</th>
                                    <th class="coluna_status">Status</th>
                                    <th class="coluna_mais">Mais</th>
                                </tr>
                            </thead>
                            <tbody class="corpo_body">
                                <td class="corpo_td"></td>
                            </tbody>
                        </table> 
                    </div>
                </div>
            @endif  
        </div>
    </div>
    <script>
        //********  Pesquisar  ********
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
        //******** Criar link para cada esdado selecionado  ********
        let status_filtro = document.querySelector('#status_filtro')
        status_filtro.addEventListener('change', () => {
            let valor_status = status_filtro.value
            window.location.href = "{{url('/filtrar_tarefa')}}" + "/" + valor_status
        })

        //******** rolagem da tabela no cel  ********
    </script>
@endsection
