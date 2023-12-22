<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = ['title', 'user_id', 'slug', 'image', 'content', 'likes'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    protected $attributes = [
        'likes' => 0,
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getShortContentAttribute()
    {
        return str()->words($this->content, 120, '...'); // Truncate content to 120 words
    }
    public function getUrlFriendlyTitleAttribute()
    {
        return str_replace(' ', '-', $this->title);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
