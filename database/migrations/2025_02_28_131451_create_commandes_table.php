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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            // $table->string('destinataire');
            $table->string('numero');
            $table->unsignedBigInteger('article_id');
            $table->decimal('montant', 10,2);
            $table->unsignedBigInteger('devise_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('status', ['approuvée', 'annulée', 'attente'])->default('attente');
            $table->string('note')->nullable();
            $table->timestamps();

            $table->foreign('article_id')->references('id')->on('articles');
            $table->foreign('devise_id')->references('id')->on('devises');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
