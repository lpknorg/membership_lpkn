<?php

namespace App\Models\Artikel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
class Artikel extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function artikelFoto(){
        return $this->hasMany(ArtikelFoto::class, 'artikel_id', 'id');
    }

    public function artikelTags(){
        return $this->hasMany(ArtikelTag::class, 'artikel_id', 'id');
    }
    public function artikelKomens(){
        return $this->hasMany(ArtikelKomentar::class, 'artikel_id', 'id');
    }
}
