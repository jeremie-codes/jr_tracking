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
        Schema::create('indicateurs', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->enum('type', ['manquant', 'dette', 'paiement', 'excédent']);
            $table->decimal('montant', 10,2)->default(0);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('devise_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('devise_id')->references('id')->on('devises');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indicateurs');
    }
};
