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
            $table->integer('user_id');
            $table->string('no_member')->nullable();
            $table->string('nik')->nullable();
            $table->string('email')->nullable();
            $table->string('nama_lengkap')->nullable();
            $table->string('no_hp')->nullable();
            $table->text('alamat_lengkap')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('tgl_lahir')->nullable();
            $table->string('ref')->nullable();
            $table->string('bank_rek_ref')->nullable();
            $table->string('no_rek_ref')->nullable();
            $table->string('an_rek_ref')->nullable();
            $table->string('pp')->nullable();
            $table->string('fb')->nullable();
            $table->string('instagram')->nullable();
            $table->integer('instansi_id')->nullable();
            $table->integer('lembaga_pemerintahan_id')->nullable();
            $table->integer('kategori_tempat_kerja_id')->nullable();
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
