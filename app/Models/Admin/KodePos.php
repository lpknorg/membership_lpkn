<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodePos extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode_pos','id_kecamatan'
    ];

    public function kelurahan()
    {
        return $this->belongsTo('App\Models\Admin\Kelurahan', 'id_kode_pos', 'id');
    }

    public function kecamatan()
    {
        return $this->hasOne('App\Models\Admin\Kecamatan', 'id', 'id_kecamatan');
    }
}
