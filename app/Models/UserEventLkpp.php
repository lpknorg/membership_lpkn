<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserEventLkpp extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function userDetail(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
