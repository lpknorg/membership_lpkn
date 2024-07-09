<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_events', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->integer('event_id');
            $table->string('paket_kontribusi')->nullable();
            $table->integer('createdBy')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('marketing')->nullable();
            $table->string('bg_color')->nullable();
            $table->string('font_color')->nullable();
            $table->boolean('is_deleted')->default(0);
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
        Schema::dropIfExists('user_events');
    }
}
