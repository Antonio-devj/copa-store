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
        Schema::create('countries', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Brasil, França, Argentina
        $table->text('history'); // Breve história do país
        $table->text('journey'); // A caminhada na Copa
        $table->integer('titles_count')->default(0); // Quantidade de copas vencidas
        $table->string('flag_image')->nullable(); // Caminho da imagem da bandeira
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
