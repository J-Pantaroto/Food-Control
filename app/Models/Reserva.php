<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $table = 'reservas';

    protected $fillable = [
        'cliente_id',
        'data_reserva',
        'quantidade_pessoas',
    ];

 
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
