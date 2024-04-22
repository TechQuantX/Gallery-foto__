<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikefotoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('likefoto', function (Blueprint $table) {
            $table->id(); // Ini sudah cukup, tidak perlu menuliskan 'LikeID' karena secara default dia akan menggunakan tipe data bigInteger dan auto-increment
            $table->foreignId('FotoID')->constrained('fotos'); // Sesuaikan dengan nama tabel yang benar di tabel 'fotos'
            $table->foreignId('UserID')->constrained('users');
            $table->dateTime('TanggalLike');
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
        Schema::dropIfExists('likefoto');
    }
}
// public function up()
//     {

//         Schema::create('likefoto', function (Blueprint $table) {
//             $table->id(); // Ini sudah cukup, tidak perlu menuliskan 'LikeID' karena secara default dia akan menggunakan tipe data bigInteger dan auto-increment
//             $table->foreignId('FotoID')->constrained('fotos'); // Sesuaikan dengan nama tabel yang benar di tabel 'fotos'
//             $table->foreignId('UserID')->constrained('users');
//             $table->dateTime('TanggalLike');
//             $table->timestamps();
//         });

//         // Create trigger
//         DB::unprepared('
//          CREATE TRIGGER after_likefoto_insert
//          AFTER INSERT ON likefoto
//          FOR EACH ROW
//          BEGIN
//              UPDATE fotos
//              SET JumlahLikes = JumlahLikes + 1
//              WHERE id = NEW.FotoID;
//          END
//      ');
//     }
