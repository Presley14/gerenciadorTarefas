<?php 

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;

class Login extends Controller
{

    // ***** View login *****
    public function login(){
        $dados = [
            'title' => 'Login',
        ];

        return view('login', $dados);
    }

    // ***** Submissão do login *****
    public function submeter_login(Request $request){
        //--- Validar os campos de login
        $request->validate([
            'nome' => 'required|min:3',
            'senha' => 'required|min:3'
        ],[
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.min' => 'O nome deve possuir no mínimo 3 caracteres.',

            'senha.required' => 'O campo senha é obrigatório.',
            'senha.min' => 'O nome deve possuir no mínimo 3 caracteres.'
        ]);

        //--- Capturar os dados dos inputs
        $name = $request->input('nome');
        $senha = $request->input('senha');
        //--- Buscar o usuário
        $modelo = new UserModel();
        $usuario = $modelo->where('username', '=', $name )
                          ->whereNull('deleted_at')
                          ->first();

        //--- Incluir um usuário numa sessão
        if($usuario){
            if(password_verify($senha, $usuario->password)){
                $sessao_dados = [
                    'id' => $usuario->id,
                    'username'=> $usuario->username
                ];

                session()->put($sessao_dados);

                return redirect()->route('home');
            }
        }
        
        //--- Informar erro de login
        return redirect()->route('login')
                         ->withInput()
                         ->with('login_error', 'Login inválido !');
            
    }

    public function logout(){
        session()->forget('username');
        return redirect()->route('login');
    }
}

?>