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
    
    /**
     * Get the content with proper line breaks for HTML display.
     */
    public function getFormattedContentAttribute()
    {
        $content = $this->content;
        
        if (empty($content)) {
            return '';
        }

        // If content has HTML, normalize line breaks
        if ($this->hasHtmlTags($content)) {
            $content = $this->normalizeHtmlContent($content);
        } else {
            // For plain text, convert line breaks to <br> tags and escape HTML
            $content = nl2br(e($content), false);
        }
        
        // Ensure we don't have any literal \n or \r\n in the output
        $content = str_replace(["\\n", "\\r\\n", "\\r"], '', $content);
        
        return $content;
    }
    
    /**
     * Get the excerpt with proper line breaks for HTML display.
     */
    public function getFormattedExcerptAttribute()
    {
        $excerpt = $this->excerpt;
        
        if (empty($excerpt)) {
            return '';
        }

        // If excerpt has HTML, normalize line breaks
        if ($this->hasHtmlTags($excerpt)) {
            $excerpt = $this->normalizeHtmlContent($excerpt);
        } else {
            // For plain text, convert line breaks to <br> tags and escape HTML
            $excerpt = nl2br(e($excerpt), false);
        }
        
        // Ensure we don't have any literal \n or \r\n in the output
        $excerpt = str_replace(["\\n", "\\r\\n", "\\r"], '', $excerpt);
        
        return $excerpt;
    }
    
    /**
     * Normalize line breaks in HTML content.
     */
    protected function normalizeHtmlContent($content)
    {
        // Normalize line breaks
        $content = str_replace(["\r\n", "\r"], "\n", $content);
        
        // Replace multiple consecutive line breaks with a single one
        $content = preg_replace('/\n{3,}/', "\n\n", $content);
        
        // Preserve line breaks after block-level elements
        $blockElements = ['</p>', '</h1>', '</h2>', '</h3>', '</h4>', '</h5>', '</h6>', '</li>', '</ul>', '</ol>', '</div>', '</blockquote>'];
        foreach ($blockElements as $tag) {
            $content = str_replace($tag . "\n", $tag . "\n\n", $content);
        }
        
        return $content;
    }
    
    /**
     * Check if content contains HTML tags.
     */
    protected function hasHtmlTags($content)
    {
        return $content !== strip_tags($content);
    }

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
