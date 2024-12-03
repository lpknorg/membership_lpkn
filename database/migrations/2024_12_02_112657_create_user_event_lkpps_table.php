<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserEventLkppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_event_lkpps', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->integer('event_id');
            $table->string('no_ujian');
            $table->string('nama');
            $table->string('nik');
            $table->string('nip');
            $table->string('email');
            $table->string('asal_instansi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_event_lkpps');
    }
}
