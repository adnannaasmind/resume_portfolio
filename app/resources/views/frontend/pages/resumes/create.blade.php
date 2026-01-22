@extends('frontend.layouts.master')
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
        <label class="block text-sm font-medium">Summary</label>
        <textarea name="summary" rows="3" class="mt-1 w-full border rounded px-3 py-2">{{ old('summary') }}</textarea>
    </div>
    <div>
        <label class="block text-sm font-medium">Skills (comma separated)</label>
        <input name="skills" class="mt-1 w-full border rounded px-3 py-2" value="{{ old('skills') }}">
    </div>

    <div class="border rounded px-4 py-3 space-y-3">
        <h2 class="text-lg font-semibold">Experience</h2>
        @for ($i = 0; $i < 3; $i++)
            <div class="grid md:grid-cols-3 gap-3">
                <input name="experiences[{{ $i }}][company]" class="border rounded px-3 py-2" placeholder="Company">
                <input name="experiences[{{ $i }}][title]" class="border rounded px-3 py-2" placeholder="Title">
                <input name="experiences[{{ $i }}][location]" class="border rounded px-3 py-2" placeholder="Location">
            </div>
            <div class="grid md:grid-cols-3 gap-3 mt-2">
                <input type="date" name="experiences[{{ $i }}][start_date]" class="border rounded px-3 py-2">
                <input type="date" name="experiences[{{ $i }}][end_date]" class="border rounded px-3 py-2">
                <label class="inline-flex items-center text-sm">
                    <input type="checkbox" name="experiences[{{ $i }}][is_current]" class="mr-2">
                    Current
                </label>
            </div>
            <textarea name="experiences[{{ $i }}][description]" rows="2" class="w-full border rounded px-3 py-2 mt-2" placeholder="Description"></textarea>
            @if($i < 2)
                <hr class="my-2">
            @endif
        @endfor
    </div>

    <div class="border rounded px-4 py-3 space-y-3">
        <h2 class="text-lg font-semibold">Education</h2>
        @for ($i = 0; $i < 3; $i++)
            <div class="grid md:grid-cols-3 gap-3">
                <input name="educations[{{ $i }}][institution]" class="border rounded px-3 py-2" placeholder="Institution">
                <input name="educations[{{ $i }}][degree]" class="border rounded px-3 py-2" placeholder="Degree">
                <input name="educations[{{ $i }}][field]" class="border rounded px-3 py-2" placeholder="Field">
            </div>
            <div class="grid md:grid-cols-2 gap-3 mt-2">
                <input type="date" name="educations[{{ $i }}][start_date]" class="border rounded px-3 py-2">
                <input type="date" name="educations[{{ $i }}][end_date]" class="border rounded px-3 py-2">
            </div>
            <textarea name="educations[{{ $i }}][description]" rows="2" class="w-full border rounded px-3 py-2 mt-2" placeholder="Description"></textarea>
            @if($i < 2)
                <hr class="my-2">
            @endif
        @endfor
    </div>

    <div class="border rounded px-4 py-3 space-y-3">
        <h2 class="text-lg font-semibold">Detailed Skills</h2>
        @for ($i = 0; $i < 5; $i++)
            <div class="grid md:grid-cols-3 gap-3">
                <input name="skill_items[{{ $i }}][name]" class="border rounded px-3 py-2" placeholder="Skill name">
                <input name="skill_items[{{ $i }}][level]" class="border rounded px-3 py-2" placeholder="Level">
                <input name="skill_items[{{ $i }}][category]" class="border rounded px-3 py-2" placeholder="Category">
            </div>
        @endfor
    </div>

    <div class="border rounded px-4 py-3 space-y-3">
        <h2 class="text-lg font-semibold">Projects</h2>
        @for ($i = 0; $i < 3; $i++)
            <div class="grid md:grid-cols-3 gap-3">
                <input name="projects[{{ $i }}][name]" class="border rounded px-3 py-2" placeholder="Project name">
                <input name="projects[{{ $i }}][role]" class="border rounded px-3 py-2" placeholder="Role">
                <input name="projects[{{ $i }}][url]" class="border rounded px-3 py-2" placeholder="URL">
            </div>
            <textarea name="projects[{{ $i }}][description]" rows="2" class="w-full border rounded px-3 py-2 mt-2" placeholder="Description"></textarea>
            <input name="projects[{{ $i }}][tech_stack]" class="w-full border rounded px-3 py-2 mt-2" placeholder="Tech stack (comma separated)">
            @if($i < 2)
                <hr class="my-2">
            @endif
        @endfor
    </div>
    <button class="px-4 py-2 bg-indigo-600 text-white rounded">Create</button>
</form>
@endsection
