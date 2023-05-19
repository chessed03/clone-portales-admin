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
        Schema::table('programs', function (Blueprint $table) {
            $table->string('level')->nullable()->change();
            $table->string('area')->nullable()->change();
            $table->string('description')->nullable()->change();
            $table->text('image_url')->nullable()->change();
            $table->text('meta_keywords')->nullable()->change();
            $table->string('duration')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->string('level')->nullable(false)->change();
            $table->string('area')->nullable(false)->change();
            $table->string('description')->nullable(false)->change();
            $table->text('image_url')->nullable(false)->change();
            $table->text('meta_keywords')->nullable(false)->change();
            $table->string('duration')->nullable(false)->change();
        });
    }
};
