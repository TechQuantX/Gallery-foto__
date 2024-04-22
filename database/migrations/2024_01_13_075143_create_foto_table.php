<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFotoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // Migration untuk tabel 'foto'
    public function up()
    {
        Schema::create('fotos', function (Blueprint $table) {
            $table->id();
            $table->string('JudulFoto');
            $table->text('DeskripsiFoto');
            $table->datetime('TanggalUnggah'); // Menggunakan datetime untuk menyimpan tanggal dan waktu
            $table->string('LokasiFile');
            $table->unsignedBigInteger('album_id');
            $table->foreign('album_id')->references('id')->on('albums')->onDelete('cascade');
            $table->unsignedBigInteger('user_id'); // Menggunakan tipe data yang sesuai dengan kunci utama di tabel 'users'
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('foto');
    }
}
