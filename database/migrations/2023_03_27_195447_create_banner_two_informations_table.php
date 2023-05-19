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
        Schema::create('banner_two_informations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('school_id');
            $table->string('title');
            $table->string('subtitle');
            $table->string('image_url');
            $table->smallInteger('status')->default(1);
            $table->string('created_by');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default( DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP') );

            $table->foreign('school_id', 'fk_banner_two_informations_schools')->references('id')->on('schools');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banner_two_informations');
    }
};
