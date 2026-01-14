@extends('layouts.app-lite')
@section('content')
<div class="flex justify-between items-center mb-4">
    <div>
        <h1 class="text-2xl font-semibold">Edit Resume</h1>
        <p class="text-sm text-gray-600">Completeness: {{ $resume->completeness_score }}%</p>
    </div>
    <form method="POST" action="{{ route('resumes.export', $resume) }}">
        @csrf
        <button class="px-3 py-2 bg-emerald-600 text-white rounded">Export PDF</button>
    </form>
</div>

<form method="POST" action="{{ route('resumes.update', $resume) }}" class="space-y-4">
    @csrf @method('PUT')
    <div>
        <label class="block text-sm font-medium">Title</label>
        <input name="title" value="{{ old('title', $resume->title) }}" class="mt-1 w-full border rounded px-3 py-2" required>
        @error('title') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block text-sm font-medium">Template</label>
        <select name="resume_template_id" class="mt-1 w-full border rounded px-3 py-2">
            <option value="">No template</option>
            @foreach($templates as $template)
                <option value="{{ $template->id }}" @selected($resume->resume_template_id === $template->id)>
                    {{ $template->name }} @if($template->is_premium) (Premium) @endif
                </option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block text-sm font-medium">Language</label>
        <select name="language" class="mt-1 w-full border rounded px-3 py-2">
            <option value="en" @selected($resume->language === 'en')>English</option>
            <option value="es" @selected($resume->language === 'es')>Spanish</option>
        </select>
    </div>
    <div>
        <label class="block text-sm font-medium">Data (JSON)</label>
        <textarea name="data" rows="8" class="mt-1 w-full border rounded px-3 py-2">{{ old('data', json_encode($resume->data, JSON_PRETTY_PRINT)) }}</textarea>
    </div>
    <button class="px-4 py-2 bg-indigo-600 text-white rounded">Save</button>
</form>

<div class="mt-6 flex space-x-3">
    @if(!$resume->is_public)
        <form method="POST" action="{{ route('resumes.publish', $resume) }}">
            @csrf
            <button class="px-3 py-2 border rounded text-green-700">Publish</button>
        </form>
    @else
        <form method="POST" action="{{ route('resumes.unpublish', $resume) }}">
            @csrf
            <button class="px-3 py-2 border rounded text-amber-700">Unpublish</button>
        </form>
        <div class="text-sm text-gray-700">Share link: {{ route('resume.share', $resume->share_token) }}</div>
    @endif
    <form method="POST" action="{{ route('resumes.duplicate', $resume) }}">
        @csrf
        <button class="px-3 py-2 border rounded">Duplicate</button>
    </form>
</div>
@endsection
