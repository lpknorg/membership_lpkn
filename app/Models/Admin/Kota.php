<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Provinsi;

class Kota extends Model
{
    use HasFactory;
    protected $fillable = [
        'kota','id_provinsi','updated_by', 'kabupaten'
    ];

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'id_provinsi', 'id');
    }
}
