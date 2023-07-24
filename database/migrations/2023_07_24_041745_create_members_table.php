<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('no_member');
            $table->string('nik');
            $table->string('email');
            $table->string('nama_lengkap');
            $table->string('no_hp');
            $table->text('alamat_lengkap');
            $table->string('tempat_lahir');
            $table->string('tgl_lahir');
            $table->string('ref');
            $table->string('bank_rek_ref');
            $table->string('no_rek_ref');
            $table->string('an_rek_ref');
            $table->string('pp')->nullable();
            $table->string('fb');
            $table->string('instagram');
            $table->integer('instansi_id');
            $table->integer('lembaga_pemerintahan_id');
            $table->integer('kategori_tempat_kerja_id');
            $table->string('expired_date')->nullable();
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
        Schema::dropIfExists('members');
    }
}
