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
        Schema::create('links', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('school_id');
            $table->string('platform_high_school_students_url')->nullable();
            $table->string('platform_high_school_teachers_url')->nullable();
            $table->string('platform_degree_students_url')->nullable();
            $table->string('platform_degree_teachers_url')->nullable();
            $table->smallInteger('status')->default(1);
            $table->string('created_by');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default( DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP') );

            $table->foreign('school_id', 'fk_links_schools')->references('id')->on('schools');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('links');
    }
};
