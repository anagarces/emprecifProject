<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class BlogPost extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'category',
        'tags',
        'published',
        'published_at',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'published' => 'boolean',
        'published_at' => 'datetime',
        'tags' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            } else {
                $post->slug = Str::slug($post->slug);
            }
            
            if ($post->published && empty($post->published_at)) {
                $post->published_at = now();
            }
        });

        static::updating(function ($post) {
            if ($post->isDirty('title') && empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });
    }

    /**
     * Get the route key name for Laravel's route model binding.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
