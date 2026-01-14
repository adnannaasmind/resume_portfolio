@extends('layouts.app-lite')
@section('content')
<h1 class="text-2xl font-semibold mb-4">Create Resume</h1>
<form method="POST" action="{{ route('resumes.store') }}" class="space-y-4">
    @csrf
    <div>
        <label class="block text-sm font-medium">Title</label>
        <input name="title" class="mt-1 w-full border rounded px-3 py-2" required>
        @error('title') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block text-sm font-medium">Template</label>
        <select name="resume_template_id" class="mt-1 w-full border rounded px-3 py-2">
            <option value="">No template</option>
            @foreach($templates as $template)
                <option value="{{ $template->id }}">{{ $template->name }} @if($template->is_premium) (Premium) @endif</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block text-sm font-medium">Language</label>
        <select name="language" class="mt-1 w-full border rounded px-3 py-2">
            <option value="en">English</option>
            <option value="es">Spanish</option>
        </select>
    </div>
    <div>
        <label class="block text-sm font-medium">Data (JSON)</label>
        <textarea name="data" rows="6" class="mt-1 w-full border rounded px-3 py-2" placeholder='{"summary":"...","experience":[...]}'></textarea>
    </div>
    <button class="px-4 py-2 bg-indigo-600 text-white rounded">Create</button>
</form>
@endsection
