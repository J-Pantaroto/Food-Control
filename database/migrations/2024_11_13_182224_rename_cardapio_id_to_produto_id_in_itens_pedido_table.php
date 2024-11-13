<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropIncorrectForeignKeyFromItensPedido extends Migration
{
    public function up()
    {
        Schema::table('itens_pedido', function (Blueprint $table) {
            // Remover a chave estrangeira incorreta associada a `produto_id`
            $table->dropForeign('itens_pedido_cardapio_id_foreign');
        });
    }

    public function down()
    {
        Schema::table('itens_pedido', function (Blueprint $table) {
            // Recriar a chave estrangeira incorreta para reverter, caso necessário
            $table->foreign('produto_id')->references('id')->on('cardapios')->onDelete('cascade');
        });
    }
}

