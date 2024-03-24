<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    public function getAllUsers(Request $request)
    {
        try {
            $usuarios = Usuario::all();
            return response()->json($usuarios);
        } catch (ModelNotFoundException $e)
        {
            return response()->json(['error' => 'User not found'], 404);
        }


    }

    public function criarUsuario(Request $request)
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
