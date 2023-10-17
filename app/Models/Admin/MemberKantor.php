<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\{Instansi, LembagaPemerintahan};

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
}
