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
        'preco',
        'subcategoria_id',
        'categoria_id',
        'desconto',
        'foto',
    ];
    public function itensPedido()
    {
        return $this->hasMany(ItemPedido::class);
    }
    public function cardapio()
    {
        return $this->hasOne(Cardapio::class);
    }
    public function subcategoria()
    {
        return $this->belongsTo(SubCategoria::class, 'subcategoria_id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
