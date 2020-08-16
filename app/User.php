<?php

namespace App;


use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Model\Question;
use App\Model\Reply;
use App\Model\Like;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;


    protected $fillable = [
        'name', 'email', 'password',
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
 public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
   
}
