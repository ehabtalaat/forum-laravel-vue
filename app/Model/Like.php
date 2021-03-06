<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Model\Reply;

class Like extends Model
{
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function reply()
    {
        return $this->belongsTo(Reply::class);
    }
}
