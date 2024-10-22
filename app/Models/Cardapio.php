<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cardapio extends Model
{
    use HasFactory;

    protected $table = 'cardapios';

    protected $fillable = [
        'nome',
        'descricao',
        'foto',
        'preco',
    ];


    public function itensPedido()
    {
        return $this->hasMany(ItemPedido::class);
    }
}
