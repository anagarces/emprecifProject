<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the published blog posts.
     */
    public function index()
    {
        $posts = BlogPost::where('published', true)
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        return view('blog.index', compact('posts'));
    }

    /**
     * Display the specified blog post.
     */
    public function show(BlogPost $blogPost)
    {
        // Verificar si el post está publicado
        if (!$blogPost->published || $blogPost->published_at > now()) {
            abort(404);
        }

        // Incrementar el contador de vistas
        $blogPost->increment('views');

        // Obtener posts relacionados (misma categoría, excluyendo el actual)
        $relatedPosts = BlogPost::where('published', true)
            ->where('id', '!=', $blogPost->id)
            ->where('category', $blogPost->category)
            ->where('published_at', '<=', now())
            ->take(3)
            ->get();

        return view('blog.show', [
            'post' => $blogPost,
            'relatedPosts' => $relatedPosts
        ]);
    }

    // Los demás métodos no son necesarios en el controlador público
    // ya que la gestión se realiza desde el panel de administración
}
