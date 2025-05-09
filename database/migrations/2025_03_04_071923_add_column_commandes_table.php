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
        Schema::table('commandes', function (Blueprint $table) {
            $table->enum('type', ['demande approvisionnement','approvisionnement','retrait', 'depot'])->default('demande approvisionnement');
            $table->unsignedBigInteger('person_id');
            $table->foreign('person_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('commandes', function (Blueprint $table) {
            $table->removeColumn('destinataire');
        });
    }
};
