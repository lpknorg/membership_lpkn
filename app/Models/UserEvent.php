<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserEvent extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['learning_lpkn'];

    public function userDetail(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function getLearningLpknAttribute(){
        $idkelas = $this->idkelas_diklatonline;
        $cont = '-';
        if ($idkelas == 4) {
            $cont = 'CPSP';
        }elseif ($idkelas == 5) {
            $cont = 'CCMS';
        }elseif ($idkelas == 6) {
            $cont = 'CPST';
        }elseif ($idkelas == 7) {
            $cont = 'CPOF';
        }elseif ($idkelas == 151) {
            $cont = 'PBJ';
        }
        return $cont;
    }
}
