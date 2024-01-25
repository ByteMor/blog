<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function author(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function ScopePublished($query)
    {
        return $query->where('published_at','<=',Carbon::now());
    }

    public function ScopeFeatured($query)
    {
        return $query->where('featured',true);
    }

    public function GetReadingTime()
    {
        $wordCount = str_word_count(strip_tags($this->body));
        $readingTime = ceil($wordCount/250);
        return $readingTime;
    }

    public function GetExcerpt()
    {
        return substr(strip_tags($this->body),0,100);
    }
}
