<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\{Instansi, LembagaPemerintahan, KategoriTempatKerja, MemberKantor, Kelurahan, Provinsi, Kecamatan, KodePos, Kota};

class Member extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'instansi_id', 'id');
    }

    public function lembagapemerintah()
    {
        return $this->belongsTo(LembagaPemerintahan::class, 'lembaga_pemerintahan_id', 'id');
    }

    public function kategoritempatkerja()
    {
        return $this->belongsTo(KategoriTempatKerja::class, 'kategori_tempat_kerja_id', 'id');
    }

    public function memberKantor()
    {
        return $this->belongsTo(MemberKantor::class, 'id', 'member_id');
    }

    public function alamatProvinsi()
    {
        return $this->belongsTo(Provinsi::class, 'prov_id', 'id');
    }

    public function alamatKota()
    {
        return $this->belongsTo(Kota::class, 'kota_id', 'id');
    }

    public function alamatKecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id', 'id');
    }

    public function alamatKelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'kelurahan_id', 'id');
    }
}
