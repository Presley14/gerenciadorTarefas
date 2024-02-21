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
            'nome' => 'required|min:3',
            'senha' => 'required|min:3',
        ]);

        $user = UserModel::create([
            'username' => $request->nome,
            'password' => Hash::make($request->senha),
        ]);

        // Log the user in or redirect to login page
        // Implement your logic here

        return redirect()->route('home')
                         ->with('success', 'Registration successful!');
    }

    
}