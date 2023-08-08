<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    use HasFactory;
    protected $fillable = [
        'kelurahan','id_kecamatan','id_kode_pos'
    ];

    public function kecamatan()
    {
        return $this->belongsTo('App\Models\Admin\Kecamatan', 'id_kecamatan', 'id');
    }

    public function kodePos()
    {
        return $this->hasOne('App\Models\Admin\Kodepos', 'id', 'id_kode_pos');
    }
}
