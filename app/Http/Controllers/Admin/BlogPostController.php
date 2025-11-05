<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = BlogPost::latest()->paginate(10);
        return view('admin.blog.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->getCategories();
        return view('admin.blog.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'category' => 'required|string|max:255',
            'published' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        $post = BlogPost::create([
            'title' => $validated['title'],
            'excerpt' => $validated['excerpt'] ?? null,
            'content' => $validated['content'],
            'category' => $validated['category'],
            'published' => $validated['published'] ?? false,
            'published_at' => $validated['published'] ? now() : null,
        ]);

        return redirect()->route('admin.blog.index')
            ->with('success', 'Artículo creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(BlogPost $blogPost)
    {
        return view('admin.blog.show', compact('blogPost'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogPost $blogPost)
    {
        $categories = $this->getCategories();
        return view('admin.blog.edit', compact('blogPost', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BlogPost $blogPost)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'category' => 'required|string|max:255',
            'published' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        $blogPost->update([
            'title' => $validated['title'],
            'excerpt' => $validated['excerpt'] ?? null,
            'content' => $validated['content'],
            'category' => $validated['category'],
            'published' => $validated['published'] ?? false,
            'published_at' => $validated['published'] ? ($blogPost->published_at ?? now()) : null,
        ]);

        return redirect()->route('admin.blog.index')
            ->with('success', 'Artículo actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogPost $blogPost)
    {
        $blogPost->delete();
        
        return redirect()->route('admin.blog.index')
            ->with('success', 'Artículo eliminado exitosamente');
    }
    
    /**
     * Get available categories
     */
    protected function getCategories()
    {
        return [
            'BORME' => 'BORME',
            'Análisis Financiero' => 'Análisis Financiero',
            'Due Diligence' => 'Due Diligence',
            'Noticias' => 'Noticias',
            'Guías' => 'Guías',
            'Tutoriales' => 'Tutoriales',
        ];
    }
}
