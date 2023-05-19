<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner_one_informations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('school_id');
            $table->string('title');
            $table->string('subtitle');
            $table->string('title_quality_one');
            $table->string('subtitle_quality_one');
            $table->string('icon_quality_one');
            $table->string('title_quality_two')->nullable();
            $table->string('subtitle_quality_two')->nullable();
            $table->string('icon_quality_two')->nullable();
            $table->string('title_quality_three')->nullable();
            $table->string('subtitle_quality_three')->nullable();
            $table->string('icon_quality_three')->nullable();
            $table->string('image_url');
            $table->smallInteger('status')->default(1);
            $table->string('created_by');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default( DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP') );

            $table->foreign('school_id', 'fk_banner_one_informations_schools')->references('id')->on('schools');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banner_one_informations');
    }
};
