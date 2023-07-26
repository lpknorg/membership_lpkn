<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\{Instansi, LembagaPemerintahan, KategoriTempatKerja};

class Member extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'no_member', 'nik', 'email', 'nama_lengkap', 'no_hp', 'alamat_lengkap', 'tempat_lahir', 'tgl_lahir', 'ref', 'bank_rek_ref', 'no_rek_ref', 'an_rek_ref', 'pp', 'fb', 'instagram', 'instansi_id', 'lembaga_pemerintahan_id', 'kategori_tempat_kerja_id', 'expired_date'
    ];

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
}
