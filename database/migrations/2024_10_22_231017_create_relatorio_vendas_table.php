<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relatorios_venda', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo_relatorio', ['diario', 'semanal', 'mensal']);
            $table->date('data_relatorio');
            $table->json('dados');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relatorio_vendas');
    }
};
