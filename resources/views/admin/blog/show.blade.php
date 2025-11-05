@extends('layouts.admin')

@section('title', $blogPost->title)

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold">{{ $blogPost->title }}</h1>
            <div class="flex items-center mt-2">
                <span class="text-sm text-gray-600 mr-4">
                    <i class="fas fa-calendar-alt mr-1"></i> {{ $blogPost->created_at->format('d/m/Y') }}
                </span>
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                    {{ $blogPost->published ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                    {{ $blogPost->published ? 'Publicado' : 'Borrador' }}
                </span>
            </div>
        </div>
        <div class="flex space-x-2">
            <a href="{{ route('admin.blog.edit', $blogPost) }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Editar
            </a>
            <a href="{{ route('admin.blog.index') }}" 
               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Volver
            </a>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-2">Resumen</h2>
            <p class="text-gray-700">{{ $blogPost->excerpt ?? 'Sin resumen' }}</p>
        </div>

        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-2">Contenido</h2>
            <div class="prose max-w-none">
                {!! $blogPost->content !!}
            </div>
        </div>

        <div class="flex flex-wrap gap-2 text-sm">
            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full">
                {{ $blogPost->category }}
            </span>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4">Información Adicional</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <h3 class="font-medium text-gray-700">URL del Artículo</h3>
                <p class="text-gray-600 break-all">
                    <a href="{{ route('blog.show', $blogPost) }}" target="_blank" class="text-blue-600 hover:underline">
                        {{ route('blog.show', $blogPost) }}
                    </a>
                </p>
            </div>
            <div>
                <h3 class="font-medium text-gray-700">Fecha de Publicación</h3>
                <p class="text-gray-600">
                    {{ $blogPost->published_at ? $blogPost->published_at->format('d/m/Y H:i') : 'No publicado' }}
                </p>
            </div>
            <div>
                <h3 class="font-medium text-gray-700">Creado el</h3>
                <p class="text-gray-600">
                    {{ $blogPost->created_at->format('d/m/Y H:i') }}
                </p>
            </div>
            <div>
                <h3 class="font-medium text-gray-700">Última actualización</h3>
                <p class="text-gray-600">
                    {{ $blogPost->updated_at->format('d/m/Y H:i') }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
