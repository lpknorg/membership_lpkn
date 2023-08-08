<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\{Instansi, LembagaPemerintahan, KategoriTempatKerja, MemberKantor};

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
}
