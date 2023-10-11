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
            $table->tinyInteger('status_id')->default(0)->comment('0=Pending, 1=Setuju, 2=Tolak, 3=Pengajuan Edit, 4=Pending Edit, 5=Tolak Edit, 6=Setuju Edit, 7=Pengajuan Ulang');
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
