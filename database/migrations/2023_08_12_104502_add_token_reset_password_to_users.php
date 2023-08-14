<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTokenResetPasswordToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('newuser_has_updated_data')->default(0);
            $table->string('token_reset_password')->nullable();
            $table->string('exp_token_reset_password')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('newuser_has_updated_data');
            $table->dropColumn('token_reset_password');
            $table->dropColumn('exp_token_reset_password');
        });
    }
}
