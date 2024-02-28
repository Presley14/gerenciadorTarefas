<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Cadastro extends Controller
{
    
    // ***** View de cadastro *****
    public function cadastro()
    {
        $dados = [
            'title' => 'Cadastrar'
        ];
        return view('cadastro', $dados);
    }

    // ***** Criar cadastro *****
    public function criarCadastro(Request $request)
    {
        $request->validate([
            'nome' => 'required|min:3|max:25',
            'senha' => 'required|min:3|max:25',
        ],
        [
            'nome.required' => 'O campo é obrigatório.',
            'senha.required' => 'O campo é obrigatorio.',

            'nome.min' => 'O campo deve conter no minímo 3 caracteres.',
            'senha.min' => 'O campo deve conter no minímo 3 caracteres.',

            'nome.max' => 'O campo deve conter no máximo 25 caracteres.',
            'senha.max' => 'O campo deve conter no máximo 25 caracteres.',

        ]);

        $user = UserModel::create([
            'username' => $request->input('nome'),
            'password' => Hash::make($request->input('senha')),
        ]);

        return redirect()->route('home')
                         ->with('success', 'Cadastro realizado com sucesso!');
    }

    
}