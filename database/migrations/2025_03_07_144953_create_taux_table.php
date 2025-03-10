<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTauxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taux', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('devise_source_id');
            $table->unsignedBigInteger('devise_cible_id');
            $table->decimal('taux_vente', 10, 6);
            $table->decimal('taux_achat', 10, 6);
            $table->timestamps();

            $table->foreign('devise_source_id')->references('id')->on('devises')->onDelete('cascade');
            $table->foreign('devise_cible_id')->references('id')->on('devises')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taux');
    }
}
