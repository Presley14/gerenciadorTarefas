<?php 
namespace App\Http\Controllers;

use App\Models\TaskModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class Main extends Controller
{
    public function home(){
       
        $dados = [
            'title' => 'Início',
            'datatables' => true,
        ];

        if(session('pesquisa')){
            
            $dados['pesquisa'] = session('pesquisa');
            $dados['tarefas'] = $this->buscar_tarefa(session('tarefas'));

            session()->forget('pesquisa');
            session()->forget('tarefas');
        }else if(session('filtro')){
            
            $dados['filtro'] = session('filtro');
            $dados['tarefas'] = $this->buscar_tarefa(session('tarefas'));

            session()->forget('filtro');
            session()->forget('tarefas');
        }else{
            $model = new TaskModel();
            $tarefas = $model->where('id_user', '=', session('id'))
                             ->whereNull('deleted_at')
                             ->get();

            $dados['tarefas'] = $this->buscar_tarefa($tarefas);
            $dados['filtro'] = null;
        }
            
        return view('home', $dados);
    }
//------------  View: Criar nova tarefa  ------------//   
    public function nova_tarefa(){
        $dados = [
            'title' => 'Nova tarefa'
        ];

        return view('nova_tarefa', $dados);
    }
//------------  Criar nova tarefa  ------------//
    public function submeter_nova_tarefa(Request $request){
//------------ Validar input
        $request->validate([
            'titulo' => 'required|min:3|max:50',
            'descricao' => 'required|min:3|max:250',
        ],[
            'titulo.required' => 'O campo de título é obrigatório.',
            'titulo.min' => 'O campo de título deve conter no mínimo 3 caracteres.',
            'titulo.max' => 'O campo de título deve conter no máximo 50 caracteres.',
            
            'descricao.required' => 'O campo de descrição é obrigatório.',
            'descricao.min' => 'O campo de descrição deve conter no mínimo 3 caracteres.',
            'descricao.max' => 'O campo de descrição deve conter no máximo 250 caracteres.',
        ]);
//------------ Pegar dados do input
        $textoTitulo = $request->input('titulo');
        $textoDescricao = $request->input('descricao');
//------------ Selecionar tarefa com mesmo nome
        $model = new TaskModel();
        $selecionarTarefa = $model->where('id_user', '=', session('id'))
                             ->where('task_name', '=', $textoTitulo)
                             ->whereNull('deleted_at')
                             ->first();
//------------  Informar erro de tarefa já existente     
        if($selecionarTarefa){
            return redirect()->route('nova_tarefa')
                             ->withInput()
                             ->with('task_error', 'Já existe uma terefa com esse nome.');
        }
//------------  Salvar dados
        $model->id_user = session('id');
        $model->task_name = $textoTitulo;
        $model->task_description = $textoDescricao;
        $model->task_status = 'new';
        $model->created_at = date('Y-m-d H:i:s');
        $model->save();

        return redirect()->route('home');
    }
//------------  Buscar tarefas  ------------//
    private function buscar_tarefa($tarefas){
//------------  Selecionar tarefas do usuário da sessão
        
//------------  Incluir para cada tarefa: link Editar e Deletar
        $colecao = [];
        foreach($tarefas as $tarefa){
            $link_editar = '<a href=" '.route('editar_tarefa', ['id' => Crypt::encrypt($tarefa->id)]).' "><img src="images/editar.png" alt="Editar" class="link_editar"></img></a> ';
            $link_deletar = '<a href=" '.route('deletar_tarefa', ['id' => Crypt::encrypt($tarefa->id)]).' "><img src="images/excluir.png" alt="Excluir" class="link_excluir"></img></a>';
//------------  Guardar os dados da tabela no array coleção
            $colecao[] = [
                'nome_tarefa' => '<p class="tarefa_nome"> '. $tarefa->task_name .':</p>' . '<p class="tarefa_description">'. $tarefa->task_description. '</p>',
                'status_tarefa' => '<div class="tarefa_status_mais">' . $this->status($tarefa->task_status) . '</div>',
                'actions_tarefa' => '<div class="tarefa_status_mais">' . $link_editar.$link_deletar . '</div>',
            ];
        }

        return $colecao;
    }
//------------  Status da tarefas  ------------//
    private function status($status){
//------------  Array status
        $colecao_selecionar = [
            'new' => 'Nova',
            'in_progress' => 'Em progresso',
            'completed' => 'Concluída',
            'cancelled' => 'Cancelada'
        ];
//------------  Verificar se existe chave selecionada
        if(key_exists($status, $colecao_selecionar))
            return $colecao_selecionar[$status];
        else
            return 'desconhecido';
    }
//------------  Editar tarefas  ------------//
    public function editar_tarefa($id){
//------------  Desencriptar id da tarefa
        try {
            $id_decrypt = Crypt::decrypt($id);
        }catch (\Exception $e){
            return redirect()->route('home');
        }
//------------  Selecionar tarefa
        $model = new TaskModel();
        $tarefa_selecionada = $model->where('id', '=', $id_decrypt)
                                    ->first();
//------------  Retornar ao home caso não tenha tarefa selecionada
        if(empty($tarefa_selecionada)){
            return redirect()->route('home');
        }
//------------  Configuração da página
        $dados = [
            'title' => 'Editar tarefa',
            'tarefa' => $tarefa_selecionada
        ];

        return view('editar_tarefa', $dados);
    }
//------------  Formulário editar tarefas  ------------//
    public function formulario_editar_tarefa(Request $request){
//------------  Validar o formulário
        $request->validate([
            'titulo' => 'required|min:3|max:50',
            'descricao' => 'required|min:3|max:250',
        ],[
            'titulo.required' => 'O campo de título é obrigatório.',
            'titulo.min' => 'O campo de título deve conter no mínimo 3 caracteres.',
            'titulo.max' => 'O campo de título deve conter no máximo 50 caracteres.',
            
            'descricao.required' => 'O campo de descrição é obrigatório.',
            'descricao.min' => 'O campo de descrição deve conter no mínimo 3 caracteres.',
            'descricao.max' => 'O campo de descrição deve conter no máximo 250 caracteres.',
        ]);
//------------  Desencriptar id
        $id_decrypt = null;
        try{
            $id_decrypt = Crypt::decrypt($request->input('tarefa_id'));
        } catch(\Exception $e){
            return redirect()->route('home');
        }
//------------  Pegar dados input
        $titulo = $request->input('titulo');
        $descricao = $request->input('descricao');
        $task_status = $request->input('status_selecionado');
//------------  Verificar tarefa igual
        $model = new TaskModel();
        $tarefa_igual = $model->where('id_user', '=', session('id'))
                              ->where('task_name', '=', $titulo)
                              ->where('id', '!=', $id_decrypt)
                              ->whereNull('deleted_at')
                              ->first();

        if($tarefa_igual){
            return redirect()->route('editar_tarefa', ['id' => Crypt::encrypt($id_decrypt)])
                      ->with('task_error', 'Já existe uma terefa com esse nome.');
        }             
//------------  Salvar alteração
        $model->where('id', '=', $id_decrypt)
              ->update([
                'task_name' => $titulo,
                'task_description' => $descricao,
                'task_status' => $task_status,
                'updated_at' => date('Y-m-d H:i:s') 
              ]);

        return redirect()->route('home');
    }
//------------  Excluir tarefas  ------------//
public function deletar_tarefa($id){
//------------  Desencriptar id da tarefa
    try{
        $id_decrypt = Crypt::decrypt($id);
    } catch(\Exception $e){
        return redirect()->route('home');
    }
//------------  Buscar todas as tarefas
    $model = new TaskModel();
    $selecionarTarefa = $model->where('id' ,'=', $id_decrypt)
                              ->first();
//------------  Retornar a pagina inicial se não existir tarefa
    if(!$selecionarTarefa){
        return redirect()->route('home');
    }
//------------  Dados para a view
    $dados = [
        'title' => 'Excluir tarefa',
        'tarefa' => $selecionarTarefa
    ];

    return view('deletar_tarefa', $dados);
}
//------------  Excluir tarefas Selecionada  ------------//
public function deletar_tarefa_selecionada($id){
//------------  Desencriptar id da tarefa  
    try{
        $id_decrypt = Crypt::decrypt($id);
    } catch(\Exception $e){
        return redirect()->route('home');
    }
//------------  Excluir a tarefa selecionada    
    $model = new TaskModel();
    $model->where('id' ,'=', $id_decrypt)
          ->update(['deleted_at' => date('Y-m-d H:i:s')]);
    
    return redirect()->route('home'); 

}
//------------  Pesquisar tarefas  ------------//
    public function pesquisar_tarefa(Request $request){
        $pesquisarTarefa = $request->input('pesquisar');
//------------  Selecionar as tarefas de acordo com a pesquisa
        $model = new TaskModel();
        if($pesquisarTarefa == ''){
            $tarefas = $model->where('id_user','=', session('id'))
                             ->whereNull('deleted_at')
                             ->get();
        }else{
            $tarefas = $model->where('id_user','=', session('id'))
                             ->where(function($query) use ($pesquisarTarefa){
                                $query->where('task_name', 'like', '%' . $pesquisarTarefa . '%');
                             })
                             ->whereNull('deleted_at')
                             ->get();
        }
//------------  Criar uma sessão para os dados de busca
        session()->put('pesquisa', $pesquisarTarefa);
        session()->put('tarefas', $tarefas);

        return redirect()->route('home');
    }
//------------  Filtrar tarefas  ------------//
    public function filtrar_tarefa($valor_status){
        try{
            $status = Crypt::decrypt($valor_status);
        }catch(\Exception $e){
            return redirect()->route('home');
        }
//------------  Buscar as tarefas de acordo com o estado
        $model = new TaskModel();
        if($status == 'all'){
          $tarefas = $model->where('id_user', '=', session('id'))
                          ->whereNull('deleted_at')
                          ->get();
        }else{
            $tarefas = $model->where('id_user', '=', session('id'))
                             ->where('task_status','=', $status)
                             ->whereNull('deleted_at')
                             ->get();
            }
//------------  Criar uma sessão para os dados de busca
        session()->put('filtro', $status);
        session()->put('tarefas', $tarefas);

        return redirect()->route('home');
    }
}
?>