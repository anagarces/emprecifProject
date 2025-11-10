@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col justify-center items-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8">
        <div class="text-center">
            <a href="/">
                <img class="mx-auto h-16 w-auto" src="{{ asset('images/logo_emprecif_wordmark.png') }}" alt="EmpreciF">
            </a>
            <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                @yield('auth_title')
            </h2>
        </div>

        <div class="mt-8 bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            @if(session('status'))
                <div class="mb-4 text-sm font-medium text-green-600">
                    {{ session('status') }}
                </div>
            @endif
            
            @if($errors->any())
                <div class="mb-4 p-4 bg-red-50 rounded-md">
                    <div class="text-sm text-red-700">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            @endif

            @yield('auth_content')
        </div>
    </div>
</div>
@endsection
