<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelatorioVenda extends Model
{
    use HasFactory;

    protected $table = 'relatorios_venda';

    protected $fillable = [
        'tipo_relatorio',
        'data_relatorio',
        'dados',
    ];
}
