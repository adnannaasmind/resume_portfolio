@extends('layouts.app-lite')
@section('content')
<div class="flex justify-between items-center mb-4">
    <div>
        <h1 class="text-2xl font-semibold">Edit Portfolio</h1>
        <p class="text-sm text-gray-600">Slug: {{ $portfolio->slug }}</p>
    </div>
</div>

<form method="POST" action="{{ route('portfolios.update', $portfolio) }}" class="space-y-4">
    @csrf @method('PUT')
    <div>
        <label class="block text-sm font-medium">Title</label>
        <input name="title" value="{{ old('title', $portfolio->title) }}" class="mt-1 w-full border rounded px-3 py-2" required>
    </div>
    <div>
        <label class="block text-sm font-medium">Headline</label>
        <input name="headline" value="{{ old('headline', $portfolio->headline) }}" class="mt-1 w-full border rounded px-3 py-2">
    </div>
    <div>
        <label class="block text-sm font-medium">Summary</label>
        <textarea name="summary" rows="4" class="mt-1 w-full border rounded px-3 py-2">{{ old('summary', $portfolio->summary) }}</textarea>
    </div>
    <div>
        <label class="block text-sm font-medium">Language</label>
        <select name="language" class="mt-1 w-full border rounded px-3 py-2">
            <option value="en" @selected($portfolio->language === 'en')>English</option>
            <option value="es" @selected($portfolio->language === 'es')>Spanish</option>
        </select>
    </div>
    <button class="px-4 py-2 bg-indigo-600 text-white rounded">Save</button>
</form>

<div class="mt-6 flex space-x-3">
    @if(!$portfolio->is_public)
        <form method="POST" action="{{ route('portfolios.publish', $portfolio) }}">
            @csrf
            <button class="px-3 py-2 border rounded text-green-700">Publish</button>
        </form>
    @else
        <form method="POST" action="{{ route('portfolios.unpublish', $portfolio) }}">
            @csrf
            <button class="px-3 py-2 border rounded text-amber-700">Unpublish</button>
        </form>
        <div class="text-sm text-gray-700">Public URL: {{ route('portfolio.public', $portfolio->slug) }}</div>
    @endif
</div>
@endsection
