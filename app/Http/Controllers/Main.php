<?php 
namespace App\Http\Controllers;

use App\Models\TaskModel;
use Illuminate\Http\Request;

class Main extends Controller
{
    public function home(){
        $dados = [
            'title' => 'Início',
            'datatables' => true,
        ];

        return view('home',$dados);
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
            'descricao' => 'required|min:3|max:250'
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
        $pegarTarefa = $model->where('id_user', '=', session('id'))
                             ->where('task_name', '=', $textoTitulo)
                             ->whereNull('deleted_at')
                             ->first();
//------------  Informar erro de tarefa já existente     
        if($pegarTarefa){
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
//------------  Pesquisar tarefas  ------------//
    public function buscar_tarefa(){
        
    }






//------------  Pesquisar tarefas  ------------//
    public function pesquisar_tarefa(){

    }
}
?>