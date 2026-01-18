@extends('frontend.layouts.master')
@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-semibold">Resumes</h1>
        <p class="text-sm text-gray-600">Manage, duplicate, publish, and export.</p>
    </div>
    <a href="{{ route('resumes.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded shadow">New Resume</a>
</div>

<div class="bg-white shadow rounded divide-y">
    @forelse($resumes as $resume)
        <div class="p-4 flex justify-between items-center">
            <div>
                <div class="font-semibold">{{ $resume->title }}</div>
                <div class="text-sm text-gray-600">
                    Template: {{ $resume->template?->name ?? 'None' }} |
                    Completeness: {{ $resume->completeness_score }}% |
                    Status: {{ $resume->status }}
                </div>
                @if($resume->is_public)
                    <div class="text-xs text-green-700">Published: {{ route('resume.share', $resume->share_token) }}</div>
                @endif
            </div>
            <div class="flex items-center space-x-2 text-sm">
                <a href="{{ route('resumes.edit', $resume) }}" class="px-3 py-1 border rounded">Edit</a>
                <form method="POST" action="{{ route('resumes.duplicate', $resume) }}">
                    @csrf
                    <button class="px-3 py-1 border rounded">Duplicate</button>
                </form>
                <form method="POST" action="{{ route('resumes.export', $resume) }}">
                    @csrf
                    <button class="px-3 py-1 border rounded">PDF</button>
                </form>
                @if(!$resume->is_public)
                    <form method="POST" action="{{ route('resumes.publish', $resume) }}">
                        @csrf
                        <button class="px-3 py-1 border rounded text-green-700">Publish</button>
                    </form>
                @else
                    <form method="POST" action="{{ route('resumes.unpublish', $resume) }}">
                        @csrf
                        <button class="px-3 py-1 border rounded text-amber-700">Unpublish</button>
                    </form>
                @endif
                <form method="POST" action="{{ route('resumes.destroy', $resume) }}">
                    @csrf @method('DELETE')
                    <button class="px-3 py-1 border rounded text-red-700">Delete</button>
                </form>
            </div>
        </div>
    @empty
        <div class="p-4 text-gray-600">No resumes yet.</div>
    @endforelse
</div>

<div class="mt-4">
    {{ $resumes->links() }}
</div>
@endsection
