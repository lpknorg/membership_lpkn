<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberKantorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_kantors', function (Blueprint $table) {
            $table->id();
            $table->integer('member_id');
            // $table->integer('kategori_pekerjaan_id')->nullable();
            $table->string('kategori_pekerjaan_lainnya')->nullable();
            $table->integer('instansi_id')->nullable();
            $table->integer('lembaga_pemerintahan_id')->nullable();
            $table->string('status_kepegawaian')->nullable();
            $table->string('posisi_pelaku_pengadaan')->nullable();
            $table->string('jenis_jabatan')->nullable();
            $table->string('nama_jabatan')->nullable();
            $table->string('golongan_terakhir')->nullable();
            $table->string('nama_instansi')->nullable();
            $table->string('pemerintah_instansi')->nullable();
            $table->text('alamat_kantor_lengkap')->nullable();
            $table->integer('kantor_prov_id')->nullable();
            $table->integer('kantor_kota_id')->nullable();
            $table->integer('kantor_kecamatan_id')->nullable();
            $table->integer('kantor_kelurahan_id')->nullable();
            $table->string('nama_kantor_prov', 5)->nullable();
            $table->string('nama_kantor_kota', 5)->nullable();
            // $table->string('kantor_kecamatan_id', 5)->nullable();
            // $table->string('kantor_kelurahan_id', 5)->nullable();
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
        Schema::dropIfExists('member_kantors');
    }
}
