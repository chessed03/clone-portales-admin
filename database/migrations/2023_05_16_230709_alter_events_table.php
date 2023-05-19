<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::table('events', function (Blueprint $table) {
            $table->smallInteger('has_cost')->nullable()->after('image_url')->default(0);
            $table->double('price')->nullable()->after('has_cost');
            $table->double('discount')->nullable()->after('price');
            $table->uuid('uuid')->nullable()->after('discount');
            $table->string('slug')->nullable()->change();
            $table->string('description')->nullable()->change();
            $table->string('description')->nullable()->change();
            $table->dateTime('start_date')->nullable()->change();
            $table->dateTime('finish_date')->nullable()->change();
            $table->string('location')->nullable()->change();
            $table->string('image_url')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('has_cost');
            $table->dropColumn('price');
            $table->dropColumn('discount');
            $table->dropColumn('uuid');
            $table->string('slug')->nullable(false);
            $table->string('description')->nullable(false);
            $table->string('description')->nullable(false);
            $table->dateTime('start_date')->nullable(false);
            $table->dateTime('finish_date')->nullable(false);
            $table->string('location')->nullable(false);
            $table->string('image_url')->nullable(false);
        });
    }
};
