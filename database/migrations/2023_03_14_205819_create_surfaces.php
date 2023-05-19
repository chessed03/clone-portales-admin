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
        Schema::create('surfaces', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->text('comments');
            $table->smallInteger('status')->default(1);
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
        Schema::dropIfExists('surfaces');
    }
};
