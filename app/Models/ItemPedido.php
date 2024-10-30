<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPedido extends Model
{
    use HasFactory;

    protected $table = 'itens_pedido';

    protected $fillable = [
        'pedido_id',
        'cardapio_id',
        'quantidade',
        'preco',
    ];

 
    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }


    public function cardapio()
    {
        return $this->belongsTo(Cardapio::class);
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

}
