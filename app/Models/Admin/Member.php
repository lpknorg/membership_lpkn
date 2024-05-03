<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\{MemberKantor, Kelurahan, Provinsi, Kecamatan, KodePos, Kota};
use App\Models\User;

class Member extends Model
{
    use HasFactory;
    protected $guarded = [];    

    protected $appends = ['nama_lengkap'];

    public function getNamaLengkapAttribute(){
        return $this->userDetail->name;
    }

    public function userDetail(){
        return $this->hasOne(User::class, 'id', 'user_id');
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
