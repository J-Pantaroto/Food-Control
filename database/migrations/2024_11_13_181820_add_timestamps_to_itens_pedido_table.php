<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampsToItensPedidoTable extends Migration
{
    public function up()
    {
        Schema::table('itens_pedido', function (Blueprint $table) {
            $table->timestamps(); // Adiciona created_at e updated_at
        });
    }

    public function down()
    {
        Schema::table('itens_pedido', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
}
