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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('description');
            $table->dateTime('start_date');
            $table->dateTime('finish_date');
            $table->string('location');
            $table->string('image_url');
            $table->smallInteger('status')->default(1);
            $table->string('created_by');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default( DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP') );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
};
