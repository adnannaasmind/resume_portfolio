<!DOCTYPE html>
<html lang="{{ $resume->language ?? 'en' }}">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; margin: 32px; }
        .section { margin-bottom: 18px; }
        .section h2 { border-bottom: 1px solid #ddd; padding-bottom: 4px; text-transform: uppercase; font-size: 14px; letter-spacing: 1px; }
        .watermark {
            position: fixed;
            top: 40%;
            left: 20%;
            opacity: 0.1;
            font-size: 72px;
            transform: rotate(-30deg);
            color: #000;
        }
    </style>
</head>
<body>
@if($watermark)
    <div class="watermark">{{ $watermarkText }}</div>
@endif

<h1>{{ data_get($data, 'basics.name') ?? $resume->title }}</h1>
<p>{{ data_get($data, 'summary') }}</p>

@if($experience = data_get($data, 'experience'))
    <div class="section">
        <h2>{{ __('Experience') }}</h2>
        @foreach($experience as $item)
            <p>
                <strong>{{ $item['title'] ?? '' }}</strong> - {{ $item['company'] ?? '' }}<br>
                <small>{{ $item['start_date'] ?? '' }} - {{ $item['end_date'] ?? __('Present') }}</small><br>
                {{ $item['description'] ?? '' }}
            </p>
        @endforeach
    </div>
@endif

@if($skills = data_get($data, 'skills'))
    <div class="section">
        <h2>{{ __('Skills') }}</h2>
        <p>{{ implode(', ', $skills) }}</p>
    </div>
@endif

@if($projects = data_get($data, 'projects'))
    <div class="section">
        <h2>{{ __('Projects') }}</h2>
        @foreach($projects as $project)
            <p>
                <strong>{{ $project['name'] ?? '' }}</strong><br>
                {{ $project['description'] ?? '' }}
            </p>
        @endforeach
    </div>
@endif
</body>
</html>
