<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Admin\Member;
use App\Models\UserSosialMedia;
use Carbon\Carbon;
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
        'exp_token_reset_password',
        'deskripsi_diri',
        'email_verified_at'
    ];
    protected $appends = ['total_event', 'tgl_bergabung'];

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
        $datapost = ['email'=>\Auth::user()->email];
        $my_event = \Helper::getRespApiWithParam(env('API_EVENT').'member/event/my_event', 'post', $datapost);
        return count($my_event['event']);
    }

    public function getTotalSertifikatAttribute(){
        $email = $this->email;
        $datapost = ['email'=>$email];
        $endpoint = env('API_SSERTIFIKAT').'member/list_sertif';
        $my_event = \Helper::getRespApiWithParam($endpoint, 'post', $datapost);
        return count($my_event['list']);
    }

    public function listSosialMedia(){
        return $this->hasMany(UserSosialMedia::class, 'user_id', 'id');
    }
    public function getTglBergabungAttribute(){
        return Carbon::parse($this->created_at)->timezone('Asia/Jakarta')->format('d-M-Y');
    }
}
