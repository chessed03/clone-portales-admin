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
        Schema::table('schools', function (Blueprint $table) {
            $table->string('phone_secondary')->nullable()->change();
            $table->string('email_secondary')->nullable()->change();
            $table->string('years_experience')->nullable()->after('youtube');
            $table->string('mail_recipients')->nullable()->after('years_experience');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schools', function (Blueprint $table) {
            $table->dropColumn('years_experience');
            $table->dropColumn('mail_recipients');
        });
    }
};
