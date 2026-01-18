@extends('frontend.layouts.master')
@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-semibold">Portfolios</h1>
        <p class="text-sm text-gray-600">Create and publish your public portfolio.</p>
    </div>
    <a href="{{ route('portfolios.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded shadow">New Portfolio</a>
</div>

<div class="bg-white shadow rounded divide-y">
    @forelse($portfolios as $portfolio)
        <div class="p-4 flex justify-between items-center">
            <div>
                <div class="font-semibold">{{ $portfolio->title }}</div>
                <div class="text-sm text-gray-600">Template: {{ $portfolio->template }} | Status: {{ $portfolio->is_public ? 'Public' : 'Draft' }}</div>
                @if($portfolio->is_public)
                    <div class="text-xs text-green-700">Public URL: {{ route('portfolio.public', $portfolio->slug) }}</div>
                @endif
            </div>
            <div class="flex items-center space-x-2 text-sm">
                <a href="{{ route('portfolios.edit', $portfolio) }}" class="px-3 py-1 border rounded">Edit</a>
                @if(!$portfolio->is_public)
                    <form method="POST" action="{{ route('portfolios.publish', $portfolio) }}">
                        @csrf
                        <button class="px-3 py-1 border rounded text-green-700">Publish</button>
                    </form>
                @else
                    <form method="POST" action="{{ route('portfolios.unpublish', $portfolio) }}">
                        @csrf
                        <button class="px-3 py-1 border rounded text-amber-700">Unpublish</button>
                    </form>
                @endif
                <form method="POST" action="{{ route('portfolios.destroy', $portfolio) }}">
                    @csrf @method('DELETE')
                    <button class="px-3 py-1 border rounded text-red-700">Delete</button>
                </form>
            </div>
        </div>
    @empty
        <div class="p-4 text-gray-600">No portfolios yet.</div>
    @endforelse
</div>

<div class="mt-4">
    {{ $portfolios->links() }}
</div>
@endsection
