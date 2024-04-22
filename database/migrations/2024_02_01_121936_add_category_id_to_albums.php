<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryIdToAlbums extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // database/migrations/{timestamp}_add_category_id_to_albums.php

    public function up()
    {
        Schema::table('albums', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->constrained();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('albums', function (Blueprint $table) {
            //
        });
    }
}
