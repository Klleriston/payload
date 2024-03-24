<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transacao extends Model
{
    use HasFactory;

    protected $table = "transacoes";

    protected $fillable = [
        'usuario_id',
        'titulo',
        'descricao'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
