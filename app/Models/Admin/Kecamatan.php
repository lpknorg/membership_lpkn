<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;
    protected $fillable = [
        'kecamatan','id_kota'
    ];

    public function kelurahan()
    {
        return $this->hasMany('App\Models\Admin\Kelurahan', 'id_kelurahan', 'id');
    }

    public function kota()
    {
        return $this->belongsTo('App\Models\Admin\Kota', 'id_kota', 'id');
    }
}
