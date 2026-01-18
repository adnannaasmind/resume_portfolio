# Resume Template ID Mapping System

## Overview

আপনার resume portfolio system-এ **10টি fixed template** আছে যেগুলো database-এ fixed ID (1-10) দিয়ে stored থাকবে। প্রতিটি template-এর নিজস্ব **blade view file** আছে।

---

## Database Structure

### Templates Table (`resume_templates`)

```
id               (1-10 fixed IDs)
name             (Template name)
slug             (URL-friendly identifier)
blade_file       (Blade view path, e.g., 'resume.templates.template1')
preview_image    (Preview image path)
category         (modern, corporate, creative, etc.)
is_premium       (true/false)
description      (Template description)
```

---

## Template ID Mapping

| ID  | Template Name    | Blade File                  | Category  | Premium |
| --- | ---------------- | --------------------------- | --------- | ------- |
| 1   | Minimal Pro      | resume.templates.template1  | modern    | No      |
| 2   | Corporate Clean  | resume.templates.template2  | corporate | No      |
| 3   | Creative Splash  | resume.templates.template3  | creative  | Yes     |
| 4   | Technical Grid   | resume.templates.template4  | tech      | Yes     |
| 5   | Elegant Serif    | resume.templates.template5  | modern    | No      |
| 6   | Bold Blocks      | resume.templates.template6  | creative  | Yes     |
| 7   | Executive Dark   | resume.templates.template7  | corporate | Yes     |
| 8   | Crisp Columns    | resume.templates.template8  | minimal   | No      |
| 9   | Classic Timeline | resume.templates.template9  | classic   | No      |
| 10  | Modern Sidebar   | resume.templates.template10 | modern    | Yes     |

---

## File Structure

```
resources/views/
  └── resume/
      └── templates/
          ├── template1.blade.php  (ID: 1)
          ├── template2.blade.php  (ID: 2)
          ├── template3.blade.php  (ID: 3)
          ├── template4.blade.php  (ID: 4)
          ├── template5.blade.php  (ID: 5)
          ├── template6.blade.php  (ID: 6)
          ├── template7.blade.php  (ID: 7)
          ├── template8.blade.php  (ID: 8)
          ├── template9.blade.php  (ID: 9)
          └── template10.blade.php (ID: 10)
```

---

## How It Works

### 1. Seeding Templates

```bash
php artisan db:seed --class=ResumeTemplateSeeder
```

এটি **10টি fixed template** database-এ insert করবে fixed ID সহ।

### 2. Creating Resume with Template

```php
$resume = Resume::create([
    'user_id' => auth()->id(),
    'template_id' => 1, // Template ID: 1 (Minimal Pro)
    'title' => 'My Resume',
    // ... other fields
]);
```

### 3. Viewing Resume

যখন resume view করবেন:

```php
// ResumeController@show
public function show(Resume $resume)
{
    $resume->load(['user', 'template', 'experiences', 'educations', 'skills', 'projects']);

    // Template's blade_file থেকে dynamic view render
    if ($resume->template && $resume->template->blade_file) {
        return view($resume->template->blade_file, compact('resume'));
    }

    // Fallback
    return view('admin.resumes.show', compact('resume'));
}
```

### 4. Dynamic Template Rendering

- User যখন **Template ID: 3** select করবে
- System automatically `resume.templates.template3` blade file load করবে
- Resume data সেই template-এ render হবে

---

## Adding New Templates

### Step 1: Create Blade File

```bash
# Create new template file
resources/views/resume/templates/template11.blade.php
```

### Step 2: Add to Seeder

```php
// In ResumeTemplateSeeder.php
[
    'id' => 11,
    'name' => 'New Template',
    'slug' => 'new-template',
    'blade_file' => 'resume.templates.template11',
    'category' => 'modern',
    'is_premium' => false,
    'preview_image' => 'templates/previews/template11.jpg',
    'description' => 'New template description',
]
```

### Step 3: Re-seed

```bash
php artisan db:seed --class=ResumeTemplateSeeder
```

---

## Template Variables

প্রতিটি template blade file-এ এই variables available থাকবে:

```php
$resume->id
$resume->title
$resume->summary
$resume->user->name
$resume->user->email
$resume->user->userProfile->phone
$resume->user->userProfile->address
$resume->template->name
$resume->experiences (collection)
$resume->educations (collection)
$resume->skills (collection)
$resume->projects (collection)
```

---

## Example Template Usage

```blade
<!-- resources/views/resume/templates/template1.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>{{ $resume->title }}</title>
</head>
<body>
    <h1>{{ $resume->user->name }}</h1>
    <p>{{ $resume->user->email }}</p>

    @foreach($resume->experiences as $exp)
        <div>
            <h3>{{ $exp->job_title }}</h3>
            <p>{{ $exp->company }}</p>
        </div>
    @endforeach
</body>
</html>
```

---

## Benefits

✅ **Fixed IDs** - Template IDs কখনো change হবে না  
✅ **Scalable** - সহজে নতুন template add করা যায়  
✅ **Dynamic Rendering** - প্রতিটি template আলাদা design থাকতে পারে  
✅ **Database Driven** - Template info database-এ centralized  
✅ **Preview Images** - Admin panel-এ visual preview

---

## Migration & Setup Commands

```bash
# 1. Run migration
php artisan migrate

# 2. Seed templates
php artisan db:seed --class=ResumeTemplateSeeder

# 3. Check templates
php artisan tinker
>>> ResumeTemplate::all()
```

---

## Summary

এখন আপনার system:

1. ✅ **10টি fixed template** database-এ আছে (ID: 1-10)
2. ✅ প্রতিটি template-এর **dedicated blade file** আছে
3. ✅ **Dynamic rendering** - template_id based on blade file load হয়
4. ✅ **Admin panel** grid view with preview images
5. ✅ সহজে নতুন template **add/modify** করা যায়
