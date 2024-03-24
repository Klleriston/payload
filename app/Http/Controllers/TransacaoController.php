<?php

namespace App\Http\Controllers;

use App\Models\Transacao;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransacaoController extends Controller
{
    public function fazPix(Request $request)
    {
        $dadosValidos = $request->validate([
            'usuario_id' => 'required|integer',
            'titulo' => 'required|string',
            'valor' => 'required|numeric',
            'descricao' => 'required|string',
        ]);
        try {
            DB::beginTransaction();

            $usuario = Usuario::findOrFail($dadosValidos['usuario_id']);
            $transacao = Transacao::create([
                'usuario_id' => $dadosValidos['usuario_id'],
                'titulo' => $dadosValidos['titulo'],
                'valor' => $dadosValidos['valor'],
                'descricao' => $dadosValidos['descricao'],
            ]);

            $usuario->increment('saldo', $dadosValidos['valor']);

            DB::commit();

            return response()->json(['mensagem' => 'Transação feita com sucesso!!', 'transacao_id' => $transacao->id], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['mensagem' => 'Erro ao processar a transação: ' . $e->getMessage()], 500);
        }
    }
    public function listarTransacoes()
    {
        $transacoes = Transacao::all();
        return response()->json($transacoes);
    }
}
