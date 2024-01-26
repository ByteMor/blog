<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'image',
        'body',
        'published_at',
        'featured',
    ];
    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function Likes()
    {
        return $this->belongsToMany(User::class, 'post_like')->withTimestamps();
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ScopePublished($query)
    {
        return $query->where('published_at', '<=', Carbon::now('Africa/Johannesburg'));
    }

    public function ScopeWithCategory($query, string $category)
    {
        return $query->whereHas('categories', function ($Query) use ($category) {
            $Query->where('slug', $category);
        });
    }

    public function ScopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function GetReadingTime()
    {
        $wordCount = str_word_count(strip_tags($this->body));
        $readingTime = ceil($wordCount / 250);
        return $readingTime;
    }

    public function GetExcerpt()
    {
        return substr(strip_tags($this->body), 0, 100);
    }

    public function GetThumbnailImage()
    {
        return str_contains($this->image, 'https://') ? $this->image : Storage::disk('public')->url($this->image);
    }

}
