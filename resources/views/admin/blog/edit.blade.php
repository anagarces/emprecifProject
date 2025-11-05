@extends('layouts.admin')

@section('title', 'Editar Artículo')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Editar Artículo</h1>

    <form action="{{ route('admin.blog.update', $blogPost) }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        @method('PUT')
        
        <div class="mb-6">
            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Título *</label>
            <input type="text" name="title" id="title" value="{{ old('title', $blogPost->title) }}" required
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('title')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="category" class="block text-gray-700 text-sm font-bold mb-2">Categoría *</label>
            <select name="category" id="category" required
                    class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">Selecciona una categoría</option>
                @foreach($categories as $value => $label)
                    <option value="{{ $value }}" {{ old('category', $blogPost->category) == $value ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
            @error('category')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="excerpt" class="block text-gray-700 text-sm font-bold mb-2">Resumen</label>
            <textarea name="excerpt" id="excerpt" rows="3"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('excerpt', $blogPost->excerpt) }}</textarea>
            <p class="text-gray-600 text-xs italic">Un breve resumen que aparecerá en el listado de artículos.</p>
            @error('excerpt')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="content" class="block text-gray-700 text-sm font-bold mb-2">Contenido *</label>
            <textarea name="content" id="content" rows="10" required
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('content', $blogPost->content) }}</textarea>
            @error('content')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="flex items-center">
                <input type="checkbox" name="published" value="1" class="form-checkbox" 
                    {{ old('published', $blogPost->published) ? 'checked' : '' }}>
                <span class="ml-2 text-gray-700 text-sm font-bold">Publicar ahora</span>
            </label>
        </div>

        <div class="flex items-center justify-between">
            <a href="{{ route('admin.blog.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Cancelar
            </a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Actualizar Artículo
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#content'))
        .catch(error => {
            console.error(error);
        });
</script>
@endpush
@endsection
