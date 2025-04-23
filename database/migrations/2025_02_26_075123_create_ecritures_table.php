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
        Schema::create('ecritures', function (Blueprint $table) {
            $table->id();
            $table->string('auteur');
            $table->string('nature');
            $table->string('type');
            $table->decimal('montant', 15, 2);
            $table->unsignedBigInteger('devise_id')->nullable();
            $table->string('motif')->nullable();
            $table->string('note')->nullable();
            $table->date('date_ref')->nullable();
            $table->timestamps();

            $table->foreign('devise_id')->references('id')->on('devises');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ecritures');
    }
};
