<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\{Instansi, LembagaPemerintahan, Kelurahan, Provinsi, Kecamatan, KodePos, Kota};

class MemberKantor extends Model
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

    public function alamatKantorProvinsi()
    {
        return $this->belongsTo(Provinsi::class, 'kantor_prov_id', 'id');
    }

    public function alamatKantorKota()
    {
        return $this->belongsTo(Kota::class, 'kantor_kota_id', 'id');
    }

    public function alamatKantorKecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kantor_kecamatan_id', 'id');
    }

    public function alamatKantorKelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'kantor_kelurahan_id', 'id');
    }
}
