@extends('layouts.app-lite')
@section('content')
<div class="max-w-3xl mx-auto bg-white shadow rounded p-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-semibold">{{ $resume->title }}</h1>
            <p class="text-sm text-gray-600">By {{ $resume->user->name }}</p>
        </div>
        @if($resume->template)
            <span class="text-xs text-gray-700 bg-gray-100 px-2 py-1 rounded">{{ $resume->template->name }}</span>
        @endif
    </div>
    <div class="mt-4 text-sm text-gray-800 whitespace-pre-wrap">
        {{ json_encode($resume->data, JSON_PRETTY_PRINT) }}
    </div>
</div>
@endsection
