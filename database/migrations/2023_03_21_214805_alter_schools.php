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
            $table->dropColumn('platform_students_url');
            $table->dropColumn('platform_teachers_url');
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
            $table->string('platform_students_url')->nullable()->after('image_about_us_url');
            $table->string('platform_teachers_url')->nullable()->after('platform_students_url');
        });
    }
};
