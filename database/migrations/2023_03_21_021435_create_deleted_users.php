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
        Schema::create('deleted_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('figure_id')->nullable();
            $table->string('user_name')->nullable();
            $table->string('name');
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->double('status')->default('1');
            $table->timestamp('created_at')->useCurrent();
            $table->string('created_by')->default('Developer');
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
        Schema::dropIfExists('deleted_users');
    }
};
