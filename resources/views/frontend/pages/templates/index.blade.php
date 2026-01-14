@extends('layouts.app-lite')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-semibold">Resume Templates</h1>
    <p class="text-sm text-gray-600">Browse free and premium templates.</p>
</div>

<div class="grid md:grid-cols-3 gap-4">
    @foreach($templates as $template)
        <div class="bg-white shadow rounded p-4 border {{ $template->is_premium ? 'border-amber-400' : 'border-gray-200' }}">
            <div class="flex justify-between items-center">
                <div class="text-lg font-semibold">{{ $template->name }}</div>
                @if($template->is_premium)
                    <span class="text-xs text-amber-800 bg-amber-100 px-2 py-1 rounded">Premium</span>
                @endif
            </div>
            <p class="text-sm text-gray-700 mt-2">{{ $template->description }}</p>
            @if($template->preview_url)
                <a href="{{ $template->preview_url }}" target="_blank" class="text-indigo-600 text-sm mt-2 inline-block">Preview</a>
            @endif
        </div>
    @endforeach
</div>
@endsection
