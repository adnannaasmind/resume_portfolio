@extends('frontend.layouts.master')
@section('content')
<h1 class="text-2xl font-semibold mb-4">Create Portfolio</h1>
<form method="POST" action="{{ route('portfolios.store') }}" class="space-y-4">
    @csrf
    <div>
        <label class="block text-sm font-medium">Title</label>
        <input name="title" class="mt-1 w-full border rounded px-3 py-2" required>
    </div>
    <div>
        <label class="block text-sm font-medium">Headline</label>
        <input name="headline" class="mt-1 w-full border rounded px-3 py-2">
    </div>
    <div>
        <label class="block text-sm font-medium">Summary</label>
        <textarea name="summary" rows="4" class="mt-1 w-full border rounded px-3 py-2"></textarea>
    </div>
    <div>
        <label class="block text-sm font-medium">Language</label>
        <select name="language" class="mt-1 w-full border rounded px-3 py-2">
            <option value="en">English</option>
            <option value="es">Spanish</option>
        </select>
    </div>
    <button class="px-4 py-2 bg-indigo-600 text-white rounded">Create</button>
</form>
@endsection
