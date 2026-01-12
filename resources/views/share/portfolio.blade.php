@extends('layouts.app-lite')
@section('content')
<div class="max-w-4xl mx-auto bg-white shadow rounded p-6">
    <div class="flex justify-between items-start">
        <div>
            <h1 class="text-2xl font-semibold">{{ $portfolio->title }}</h1>
            <p class="text-sm text-gray-600">By {{ $portfolio->user->name }}</p>
            @if($portfolio->headline)
                <p class="mt-2 text-gray-800">{{ $portfolio->headline }}</p>
            @endif
        </div>
        <span class="text-xs text-gray-700 bg-gray-100 px-2 py-1 rounded">{{ $portfolio->template }}</span>
    </div>
    @if($portfolio->summary)
        <div class="mt-4 text-gray-800">{{ $portfolio->summary }}</div>
    @endif
    @if($portfolio->projects)
        <div class="mt-6">
            <h2 class="text-lg font-semibold mb-2">Projects</h2>
            <ul class="list-disc pl-6 space-y-1">
                @foreach($portfolio->projects as $project)
                    <li>
                        <span class="font-semibold">{{ $project['title'] ?? '' }}</span>
                        <span class="text-gray-700">{{ $project['description'] ?? '' }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
@endsection
