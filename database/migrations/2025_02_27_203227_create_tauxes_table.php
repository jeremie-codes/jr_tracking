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
        Schema::create('taux', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('devise_id');
            $table->decimal('achat', 10,2)->default(0);
            $table->decimal('vente', 10,2)->default(0);
            $table->timestamps();

            $table->foreign('devise_id')->references('id')->on('devises')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taux');
    }
};
