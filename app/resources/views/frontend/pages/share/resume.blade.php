@extends('frontend.layouts.master')
@section('content')
<div class="max-w-4xl mx-auto space-y-4">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-semibold">{{ $resume->title }}</h1>
            <p class="text-sm text-gray-600">By {{ $resume->user->name }}</p>
        </div>
        @if($resume->template)
            <div class="text-right">
                <span class="text-xs text-gray-700 bg-gray-100 px-2 py-1 rounded">
                    {{ $resume->template->name }}
                </span>
                @if($resume->template->is_premium)
                    <div class="text-[10px] text-amber-700 mt-1">Premium template</div>
                @else
                    <div class="text-[10px] text-emerald-700 mt-1">Free template</div>
                @endif
            </div>
        @endif
    </div>

    @php
        $layout = $resume->template?->metadata['layout'] ?? 'minimal';
    @endphp

    @includeWhen($layout === 'minimal', 'frontend.pages.resumes.partials.template-minimal', ['resume' => $resume])

    @if($layout !== 'minimal')
        @include('frontend.pages.resumes.partials.template-minimal', ['resume' => $resume])
    @endif
</div>
@endsection
