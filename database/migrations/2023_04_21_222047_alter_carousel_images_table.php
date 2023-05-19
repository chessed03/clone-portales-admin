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
            $table->dropColumn('text_color');
            $table->dropColumn('description');
            $table->dropColumn('link_url');
            $table->dropColumn('title');
            $table->text('content_movil')->nullable()->after('image_url');
            $table->string('image_movil_url')->nullable()->after('content_movil');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carousel_images', function (Blueprint $table) {
            $table->string('description')->nullable();
            $table->string('link_url')->nullable();
            $table->string('text_color')->nullable();
            $table->string('title')->nullable();
            $table->dropColumn('content_movil');
            $table->dropColumn('image_movil_url');
        });
    }
};
