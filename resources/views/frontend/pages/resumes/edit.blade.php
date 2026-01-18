@extends('frontend.layouts.master')
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
    <div class="space-y-4">
        <div>
            <label class="block text-sm font-medium">Summary</label>
            <textarea name="summary" rows="3" class="mt-1 w-full border rounded px-3 py-2">{{ old('summary', data_get($resume->data, 'summary')) }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-medium">Skills (comma separated)</label>
            <input name="skills" class="mt-1 w-full border rounded px-3 py-2"
                   value="{{ old('skills', is_array(data_get($resume->data, 'skills')) ? implode(', ', data_get($resume->data, 'skills')) : data_get($resume->data, 'skills')) }}">
        </div>
    </div>

    @php
        $experiences = old('experiences', $resume->experiences->map(fn($e) => $e->toArray())->toArray());
        if (count($experiences) === 0) {
            $experiences = [[], [], []];
        }
        $educations = old('educations', $resume->educations->map(fn($e) => $e->toArray())->toArray());
        if (count($educations) === 0) {
            $educations = [[], [], []];
        }
        $skillItems = old('skill_items', $resume->skills->map(fn($s) => $s->toArray())->toArray());
        if (count($skillItems) === 0) {
            $skillItems = [[], [], [], [], []];
        }
        $projects = old('projects', $resume->projects->map(fn($p) => $p->toArray())->toArray());
        if (count($projects) === 0) {
            $projects = [[], [], []];
        }
    @endphp

    <div class="border rounded px-4 py-3 space-y-3 mt-4">
        <h2 class="text-lg font-semibold">Experience</h2>
        @foreach($experiences as $index => $exp)
            <div class="grid md:grid-cols-3 gap-3">
                <input name="experiences[{{ $index }}][company]" class="border rounded px-3 py-2" placeholder="Company"
                       value="{{ $exp['company'] ?? '' }}">
                <input name="experiences[{{ $index }}][title]" class="border rounded px-3 py-2" placeholder="Title"
                       value="{{ $exp['title'] ?? '' }}">
                <input name="experiences[{{ $index }}][location]" class="border rounded px-3 py-2" placeholder="Location"
                       value="{{ $exp['location'] ?? '' }}">
            </div>
            <div class="grid md:grid-cols-3 gap-3 mt-2">
                <input type="date" name="experiences[{{ $index }}][start_date]" class="border rounded px-3 py-2"
                       value="{{ $exp['start_date'] ?? '' }}">
                <input type="date" name="experiences[{{ $index }}][end_date]" class="border rounded px-3 py-2"
                       value="{{ $exp['end_date'] ?? '' }}">
                <label class="inline-flex items-center text-sm">
                    <input type="checkbox" name="experiences[{{ $index }}][is_current]" class="mr-2"
                           @checked(!empty($exp['is_current']))>
                    Current
                </label>
            </div>
            <textarea name="experiences[{{ $index }}][description]" rows="2" class="w-full border rounded px-3 py-2 mt-2" placeholder="Description">{{ $exp['description'] ?? '' }}</textarea>
            @if(!$loop->last)
                <hr class="my-2">
            @endif
        @endforeach
    </div>

    <div class="border rounded px-4 py-3 space-y-3 mt-4">
        <h2 class="text-lg font-semibold">Education</h2>
        @foreach($educations as $index => $edu)
            <div class="grid md:grid-cols-3 gap-3">
                <input name="educations[{{ $index }}][institution]" class="border rounded px-3 py-2" placeholder="Institution"
                       value="{{ $edu['institution'] ?? '' }}">
                <input name="educations[{{ $index }}][degree]" class="border rounded px-3 py-2" placeholder="Degree"
                       value="{{ $edu['degree'] ?? '' }}">
                <input name="educations[{{ $index }}][field]" class="border rounded px-3 py-2" placeholder="Field"
                       value="{{ $edu['field'] ?? '' }}">
            </div>
            <div class="grid md:grid-cols-2 gap-3 mt-2">
                <input type="date" name="educations[{{ $index }}][start_date]" class="border rounded px-3 py-2"
                       value="{{ $edu['start_date'] ?? '' }}">
                <input type="date" name="educations[{{ $index }}][end_date]" class="border rounded px-3 py-2"
                       value="{{ $edu['end_date'] ?? '' }}">
            </div>
            <textarea name="educations[{{ $index }}][description]" rows="2" class="w-full border rounded px-3 py-2 mt-2" placeholder="Description">{{ $edu['description'] ?? '' }}</textarea>
            @if(!$loop->last)
                <hr class="my-2">
            @endif
        @endforeach
    </div>

    <div class="border rounded px-4 py-3 space-y-3 mt-4">
        <h2 class="text-lg font-semibold">Detailed Skills</h2>
        @foreach($skillItems as $index => $skill)
            <div class="grid md:grid-cols-3 gap-3">
                <input name="skill_items[{{ $index }}][name]" class="border rounded px-3 py-2" placeholder="Skill name"
                       value="{{ $skill['name'] ?? '' }}">
                <input name="skill_items[{{ $index }}][level]" class="border rounded px-3 py-2" placeholder="Level"
                       value="{{ $skill['level'] ?? '' }}">
                <input name="skill_items[{{ $index }}][category]" class="border rounded px-3 py-2" placeholder="Category"
                       value="{{ $skill['category'] ?? '' }}">
            </div>
        @endforeach
    </div>

    <div class="border rounded px-4 py-3 space-y-3 mt-4">
        <h2 class="text-lg font-semibold">Projects</h2>
        @foreach($projects as $index => $project)
            <div class="grid md:grid-cols-3 gap-3">
                <input name="projects[{{ $index }}][name]" class="border rounded px-3 py-2" placeholder="Project name"
                       value="{{ $project['name'] ?? '' }}">
                <input name="projects[{{ $index }}][role]" class="border rounded px-3 py-2" placeholder="Role"
                       value="{{ $project['role'] ?? '' }}">
                <input name="projects[{{ $index }}][url]" class="border rounded px-3 py-2" placeholder="URL"
                       value="{{ $project['url'] ?? '' }}">
            </div>
            <textarea name="projects[{{ $index }}][description]" rows="2" class="w-full border rounded px-3 py-2 mt-2" placeholder="Description">{{ $project['description'] ?? '' }}</textarea>
            @php
                $stack = $project['tech_stack'] ?? '';
                if (is_array($stack)) {
                    $stack = implode(', ', $stack);
                }
            @endphp
            <input name="projects[{{ $index }}][tech_stack]" class="w-full border rounded px-3 py-2 mt-2" placeholder="Tech stack (comma separated)" value="{{ $stack }}">
            @if(!$loop->last)
                <hr class="my-2">
            @endif
        @endforeach
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
