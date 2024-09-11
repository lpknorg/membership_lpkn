<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserEventHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_event_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('user_event_id');
            $table->integer('createdBy');
            $table->tinyInteger('status_id')->default(0)->comment('0=Dipulihkan, 1=Dihapus, 2=Dipindahkan');
            $table->integer('event_id_tujuan')->nullable();
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
        Schema::dropIfExists('user_event_histories');
    }
}
