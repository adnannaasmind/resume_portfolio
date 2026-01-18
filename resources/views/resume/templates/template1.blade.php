<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $resume->title ?? 'Resume' }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            background: #fff;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #2c3e50;
        }
        .header h1 {
            font-size: 36px;
            color: #2c3e50;
            margin-bottom: 5px;
        }
        .header p {
            color: #7f8c8d;
            font-size: 14px;
        }
        .section {
            margin-bottom: 30px;
        }
        .section-title {
            font-size: 20px;
            color: #2c3e50;
            margin-bottom: 15px;
            padding-bottom: 5px;
            border-bottom: 2px solid #3498db;
        }
        .item {
            margin-bottom: 15px;
        }
        .item h3 {
            font-size: 16px;
            color: #2c3e50;
            margin-bottom: 5px;
        }
        .item .meta {
            color: #7f8c8d;
            font-size: 14px;
            margin-bottom: 8px;
        }
        .item p {
            font-size: 14px;
            line-height: 1.5;
        }
        .skills-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }
        .skill-item {
            background: #ecf0f1;
            padding: 8px 12px;
            border-radius: 4px;
            font-size: 14px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>{{ $resume->user->name ?? 'Your Name' }}</h1>
            <p>{{ $resume->user->email ?? 'email@example.com' }} | {{ $resume->user->userProfile->phone ?? 'Phone' }}</p>
            <p>{{ $resume->user->userProfile->address ?? 'Address' }}</p>
        </div>

        <!-- About / Summary -->
        @if($resume->summary)
        <div class="section">
            <h2 class="section-title">Professional Summary</h2>
            <p>{{ $resume->summary }}</p>
        </div>
        @endif

        <!-- Experience -->
        @if($resume->experiences && $resume->experiences->count() > 0)
        <div class="section">
            <h2 class="section-title">Work Experience</h2>
            @foreach($resume->experiences as $experience)
            <div class="item">
                <h3>{{ $experience->job_title }}</h3>
                <div class="meta">
                    {{ $experience->company }} |
                    {{ \Carbon\Carbon::parse($experience->start_date)->format('M Y') }} -
                    {{ $experience->end_date ? \Carbon\Carbon::parse($experience->end_date)->format('M Y') : 'Present' }}
                </div>
                <p>{{ $experience->description }}</p>
            </div>
            @endforeach
        </div>
        @endif

        <!-- Education -->
        @if($resume->educations && $resume->educations->count() > 0)
        <div class="section">
            <h2 class="section-title">Education</h2>
            @foreach($resume->educations as $education)
            <div class="item">
                <h3>{{ $education->degree }}</h3>
                <div class="meta">
                    {{ $education->institution }} |
                    {{ \Carbon\Carbon::parse($education->start_date)->format('Y') }} -
                    {{ $education->end_date ? \Carbon\Carbon::parse($education->end_date)->format('Y') : 'Present' }}
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <!-- Skills -->
        @if($resume->skills && $resume->skills->count() > 0)
        <div class="section">
            <h2 class="section-title">Skills</h2>
            <div class="skills-grid">
                @foreach($resume->skills as $skill)
                <div class="skill-item">{{ $skill->name }}</div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Projects -->
        @if($resume->projects && $resume->projects->count() > 0)
        <div class="section">
            <h2 class="section-title">Projects</h2>
            @foreach($resume->projects as $project)
            <div class="item">
                <h3>{{ $project->title }}</h3>
                <p>{{ $project->description }}</p>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</body>
</html>
