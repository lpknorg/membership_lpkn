<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Admin\Member;
use App\Http\Controllers\Member\{EventKamuController, SertifikatKamuController};

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nik',
        'nip',
        'updated_at',
        'is_confirm',
        'token_reset_password',
        'exp_token_reset_password'
    ];
    protected $appends = ['total_event'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'id', 'user_id');
    }

    public function getTotalEventAttribute(){
        $email = $this->email;
        $datapost = ['email'=>$email];
        $n = new EventKamuController();
        $my_event = $n->getRespApiWithParam($datapost, 'member/event/my_event');
        return count($my_event['event']);
    }

    public function getTotalSertifikatAttribute(){
        $email = $this->email;
        $datapost = ['email'=>$email];
        $n = new SertifikatKamuController();
        $my_event = $n->getRespApiWithParam($datapost, 'member/list_sertif');
        return count($my_event['list']);
    }
}
