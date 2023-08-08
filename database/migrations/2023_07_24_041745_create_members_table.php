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
            $table->string('no_hp')->nullable();
            $table->string('no_member')->nullable();            
            $table->string('pendidikan_terakhir')->nullable();
            $table->string('nama_lengkap_gelar')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->string('tempat_dan_tgl_lahir')->nullable();
            $table->text('alamat_lengkap')->nullable();
            $table->string('prov_id', 5)->nullable();
            $table->string('nama_prov', 5)->nullable();
            $table->string('kota_id', 5)->nullable();
            $table->string('nama_kota', 5)->nullable();
            $table->string('kecamatan_id', 5)->nullable();
            $table->string('kelurahan_id', 5)->nullable();
            $table->string('foto_profile')->nullable();
            
            $table->string('pas_foto3x4')->nullable();
            $table->string('foto_ktp')->nullable();
            $table->string('file_sk_pengangkatan_asn')->nullable();

            $table->string('fb')->nullable();
            $table->string('instagram')->nullable();

            $table->string('ref')->nullable();
            $table->string('bank_rek_ref')->nullable();
            $table->string('no_rek_ref')->nullable();
            $table->string('an_rek_ref')->nullable();
            
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
