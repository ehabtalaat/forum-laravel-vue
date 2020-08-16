<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Model\Category;
use App\Model\Reply;
use Illuminate\Support\Str;
class Question extends Model
{
    protected  $fillable = ['title', 'slug', 'body', 'category_id', 'user_id'];
    protected $with = ['replies'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function replies()
    {
        return $this->hasMany(Reply::class)->latest();
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function getPathAttribute()
    {
        return "question/$this->slug";
    }
    
}

