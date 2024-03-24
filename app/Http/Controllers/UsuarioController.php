<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function getAllUsers(Request $request)
    {
        $users = Usuario::all();
        return response()->json($users);
    }

    public function createUser(Request $request)
    {
        $dadosValido = $request->validate([
            'nome' => 'required|string',
            'email' => 'required|email|unique:usuarios,email',
            'saldo' => 'required|numeric',
            'tipo_usuario' => 'required|in:PF,PJ',
            'cpf' => 'required_if:tipo_usuario,PF|string',
            'cnpj' => 'required_if:tipo_usuario,PJ|string',
            'empresa' => 'required_if:tipo_usuario,PJ|string',
        ]);

        $usuario = Usuario::create($dadosValido);
        return response()->json(['mensagem' => 'Usuário criado com sucesso', 'usuario_id' => $usuario->id], 201);
    }
}
