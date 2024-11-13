<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterDescontoColumnInProdutosTable extends Migration
{
    public function up()
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->boolean('desconto')->change();
        });
    }

    public function down()
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->tinyInteger('desconto')->change();
        });
    }
}
