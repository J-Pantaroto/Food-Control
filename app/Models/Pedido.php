<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';

    protected $fillable = [
        'cliente_id',
        'valor_total',
    ];

  
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function itensPedido()
    {
        return $this->hasMany(ItemPedido::class);
    }
}