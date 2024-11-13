<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCorrectForeignKeyToProdutoIdInItensPedido extends Migration
{
    public function up()
    {
        Schema::table('itens_pedido', function (Blueprint $table) {
            $table->foreign('produto_id')->references('id')->on('produtos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('itens_pedido', function (Blueprint $table) {
            $table->dropForeign(['produto_id']);
        });
    }
}
