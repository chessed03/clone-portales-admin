<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carousel_images', function (Blueprint $table) {
            $table->dropForeign('fk_carousel_images_sites');
            $table->dropColumn('site_id');
            $table->json('schools')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Schema::table('carousel_images', function (Blueprint $table) {

            $table->unsignedBigInteger('site_id')->after('id');
            $table->foreign('site_id', 'fk_carousel_images_sites')->references('id')->on('sites');
            $table->dropColumn('schools');

        });

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
};
