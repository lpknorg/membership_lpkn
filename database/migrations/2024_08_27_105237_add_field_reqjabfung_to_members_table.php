<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldReqjabfungToMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->string('tmt_pangkat_pns_terakhir', 12)->nullable();
            $table->string('tmt_sk_jf_pbj_terakhir', 12)->nullable();
            // $table->string('file_sk_pangkat_pns_terakhir')->nullable();
            $table->string('file_penilaian_angka_kredit_terakhir')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn('tmt_pangkat_pns_terakhir');
            $table->dropColumn('tmt_sk_jf_pbj_terakhir');
            // $table->dropColumn('file_sk_pangkat_pns_terakhir');
            $table->dropColumn('file_penilaian_angka_kredit_terakhir');
        });
    }
}
