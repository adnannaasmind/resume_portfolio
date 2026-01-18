@php($data = $resume->data ?? [])
<div class="bg-white shadow rounded-lg p-8 border border-gray-200">
    <div class="flex justify-between items-center border-b pb-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                {{ data_get($data, 'basics.name') ?? $resume->title }}
            </h1>
            <p class="text-sm text-gray-600 mt-1">
                {{ data_get($data, 'basics.label') }}
            </p>
        </div>
        <div class="text-right text-xs text-gray-600 space-y-1">
            @if($email = data_get($data, 'basics.email'))
                <div>{{ $email }}</div>
            @endif
            @if($phone = data_get($data, 'basics.phone'))
                <div>{{ $phone }}</div>
            @endif
            @if($location = data_get($data, 'basics.location.city'))
                <div>{{ $location }}</div>
            @endif
        </div>
    </div>

    @if($summary = data_get($data, 'summary'))
        <div class="mb-6">
            <h2 class="text-xs font-semibold tracking-wide text-gray-500 uppercase mb-2">Summary</h2>
            <p class="text-sm text-gray-800 leading-relaxed">{{ $summary }}</p>
        </div>
    @endif

    @if($experience = data_get($data, 'experience'))
        <div class="mb-6">
            <h2 class="text-xs font-semibold tracking-wide text-gray-500 uppercase mb-2">Experience</h2>
            <div class="space-y-3">
                @foreach($experience as $item)
                    <div>
                        <div class="flex justify-between">
                            <div class="font-semibold text-sm text-gray-900">
                                {{ $item['title'] ?? '' }}
                                @if(!empty($item['company']))
                                    <span class="text-gray-500">· {{ $item['company'] }}</span>
                                @endif
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ $item['start_date'] ?? '' }} – {{ $item['end_date'] ?? __('Present') }}
                            </div>
                        </div>
                        @if(!empty($item['location']))
                            <div class="text-xs text-gray-500">{{ $item['location'] }}</div>
                        @endif
                        @if(!empty($item['description']))
                            <p class="text-sm text-gray-800 mt-1">{{ $item['description'] }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @if($education = data_get($data, 'education'))
        <div class="mb-6">
            <h2 class="text-xs font-semibold tracking-wide text-gray-500 uppercase mb-2">Education</h2>
            <div class="space-y-3">
                @foreach($education as $item)
                    <div>
                        <div class="flex justify-between">
                            <div class="font-semibold text-sm text-gray-900">
                                {{ $item['institution'] ?? '' }}
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ $item['start_date'] ?? '' }} – {{ $item['end_date'] ?? __('Present') }}
                            </div>
                        </div>
                        @if(!empty($item['area']) || !empty($item['study_type']))
                            <div class="text-xs text-gray-600">
                                {{ $item['study_type'] ?? '' }} {{ $item['area'] ?? '' }}
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @if($skills = data_get($data, 'skills'))
        <div class="mb-6">
            <h2 class="text-xs font-semibold tracking-wide text-gray-500 uppercase mb-2">Skills</h2>
            <div class="flex flex-wrap gap-2">
                @foreach($skills as $skill)
                    <span class="px-2 py-1 text-xs bg-gray-100 text-gray-800 rounded">
                        {{ is_array($skill) ? ($skill['name'] ?? '') : $skill }}
                    </span>
                @endforeach
            </div>
        </div>
    @endif

    @if($projects = data_get($data, 'projects'))
        <div>
            <h2 class="text-xs font-semibold tracking-wide text-gray-500 uppercase mb-2">Projects</h2>
            <div class="space-y-3">
                @foreach($projects as $project)
                    <div>
                        <div class="font-semibold text-sm text-gray-900">
                            {{ $project['name'] ?? $project['title'] ?? '' }}
                        </div>
                        @if(!empty($project['url']))
                            <div class="text-xs text-indigo-600">
                                {{ $project['url'] }}
                            </div>
                        @endif
                        @if(!empty($project['description']))
                            <p class="text-sm text-gray-800 mt-1">{{ $project['description'] }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>

