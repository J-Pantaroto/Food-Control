<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategoria extends Model
{
    use HasFactory;

    protected $table = 'sub_categorias';

    protected $filable = [
        'categoria_id',
        'nome',
    ];
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }

}