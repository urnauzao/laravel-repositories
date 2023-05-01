<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('marca_id')->constrained();
            $table->string('nome', 60);
            $table->string('sku', 60);
            $table->text('descricao');
            $table->unsignedFloat('preco')->default(0);
            $table->unsignedFloat('desconto')->default(0);
            $table->unsignedFloat('preco_com_desconto')->default(0);
            $table->unsignedInteger('estoque')->default(0);
            $table->string('referencia', 60)->nullable();
            $table->string('codigo_de_barras', 15)->nullable();
            $table->unsignedInteger('altura')->default(0);
            $table->unsignedInteger('largura')->default(0);
            $table->unsignedInteger('comprimento')->default(0);
            $table->unsignedInteger('peso')->default(0);
            $table->string('tipo',20)->default('normal');
            $table->json('atributos');
            $table->json('tags');
            $table->string('imagem_principal', 300)->nullable();
            $table->json('imagens');
            $table->string('url', 300)->nullable();
            $table->string('fornecedor')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
