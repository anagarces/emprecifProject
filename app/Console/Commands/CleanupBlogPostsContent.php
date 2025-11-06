<?php

namespace App\Console\Commands;

use App\Models\BlogPost;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CleanupBlogPostsContent extends Command
{
    protected $signature = 'blog:cleanup-content';
    protected $description = 'Clean up blog posts content by converting line breaks to <br> tags while preserving HTML';

    public function handle()
    {
        $this->info('Starting blog posts content cleanup...');
        $count = 0;

        BlogPost::chunk(100, function($posts) use (&$count) {
            foreach ($posts as $post) {
                $originalContent = $post->content;
                $originalExcerpt = $post->excerpt;
                
                // Process content
                if (!empty($post->content)) {
                    $post->content = $this->processContent($post->content);
                }
                
                // Process excerpt
                if (!empty($post->excerpt)) {
                    $post->excerpt = $this->processContent($post->excerpt);
                }
                
                // Only save if content changed
                if ($post->content !== $originalContent || $post->excerpt !== $originalExcerpt) {
                    $post->save();
                    $count++;
                }
            }
        });

        $this->info("Completed! Updated {$count} blog posts.");
        return 0;
    }

    protected function processContent($content)
    {
        // If content already contains HTML tags, only normalize line breaks
        if ($this->hasHtmlTags($content)) {
            // Normalize line breaks to \n
            $content = str_replace(["\r\n", "\r"], "\n", $content);
            
            // Replace multiple consecutive line breaks with a single one
            $content = preg_replace('/\n{3,}/', "\n\n", $content);
            
            // Preserve line breaks after block-level elements
            $blockElements = ['</p>', '</h1>', '</h2>', '</h3>', '</h4>', '</h5>', '</h6>', '</li>', '</ul>', '</ol>', '</div>', '</blockquote>'];
            foreach ($blockElements as $tag) {
                $content = str_replace($tag . "\n", $tag . "\n\n", $content);
            }
            
            return trim($content);
        }
        
        // For plain text, convert line breaks to <br> tags
        return nl2br(trim($content), false);
    }
    
    protected function hasHtmlTags($content)
    {
        return $content !== strip_tags($content);
    }
}
