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
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('contact');
            $table->string('phone_main');
            $table->string('phone_secondary');
            $table->string('email_main');
            $table->string('email_secondary');
            $table->string('facebook');
            $table->string('instagram');
            $table->string('twitter');
            $table->string('youtube');
            $table->text('description');
            $table->string('title_about_us');
            $table->text('description_about_us');
            $table->string('meta_keywords');
            $table->string('meta_description');
            $table->string('logo_url');
            $table->string('image_about_us_url');
            $table->smallInteger('status')->default(1);
            $table->timestamp('created_at')->useCurrent();
            $table->string('created_by');
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
        Schema::dropIfExists('schools');
    }
};
