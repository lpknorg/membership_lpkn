<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusIdToArtikels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('artikels', function (Blueprint $table) {
            $table->tinyInteger('status_id')->default(0)->comment('0=Pending, 1=Setuju, 2=Tolak, 3=Pending Edit');
            $table->string('alasan_tolak')->nullable();
            $table->string('sanggah_perbaikan')->nullable();         
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('artikels', function (Blueprint $table) {
            $table->dropColumn('status_id');
            $table->dropColumn('alasan_tolak');
            $table->dropColumn('sanggah_perbaikan');
        });
    }
}
