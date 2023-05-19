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
        Schema::table('posts', function (Blueprint $table) {
            $table->string('slug')->nullable()->change();
            $table->string('subtitle')->nullable()->change();
            $table->string('image_feature_url')->nullable()->change();
            $table->string('meta_keywords')->nullable()->change();
            $table->text('content')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('slug')->nullable(false)->change();
            $table->string('subtitle')->nullable(false)->change();
            $table->string('image_feature_url')->nullable(false)->change();
            $table->string('meta_keywords')->nullable(false)->change();
            $table->text('content')->nullable(false)->change();
        });
    }
};
