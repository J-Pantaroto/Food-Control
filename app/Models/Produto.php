<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    
    protected $table = 'produtos';

    protected $fillable = [
        'nome',
        'descricao',
        'quantidade',
        'valor',
        'sub_categoria_id',
    ];
    public function itensPedido()
    {
        return $this->hasMany(ItemPedido::class);
    }
    public function cardapio()
    {
        return $this->hasOne(Cardapio::class);
    }
    public function subCategoria()
    {
        return $this->belongsTo(SubCategoria::class);
    }
}
