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
        Schema::table('schools', function (Blueprint $table) {
            $table->text('mission_about_us')->after('description_about_us');
            $table->text('vision_about_us')->after('mission_about_us');
            $table->string('background_color_about_us')->after('vision_about_us');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schools', function (Blueprint $table) {
            $table->dropColumn('mission_about_us');
            $table->dropColumn('vision_about_us');
            $table->dropColumn('background_color_about_us');
        });
    }
};
