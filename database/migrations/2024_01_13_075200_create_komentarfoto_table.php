<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKomentarfotoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // Migration untuk tabel 'komentarfoto'
    public function up()
    {
        Schema::create('komentarfoto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('FotoID');
            $table->foreign('FotoID')->references('id')->on('fotos')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->text('isikomentar');
            $table->dateTime('TanggalKomentar');
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
        Schema::dropIfExists('komentarfoto');
    }
}
