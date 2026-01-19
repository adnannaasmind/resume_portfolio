# Troubleshooting Guide for CRUD Errors

## ✅ ALL CODE IS COMPLETE!

The jQuery functions and backend routes are 100% complete. If you're getting errors, here's how to debug:

## Check Browser Console

Open your browser's Developer Tools (F12) and go to the Console tab. Look for:

- JavaScript errors
- AJAX request details
- Response data

## Check Network Tab

1. Open Developer Tools (F12)
2. Go to Network tab
3. Filter by XHR
4. Try to add/edit an item
5. Click on the failed request
6. Check:
    - **Request URL** - Is it correct?
    - **Request Method** - POST/PUT/DELETE?
    - **Status Code** - What error (404, 422, 500)?
    - **Response** - What's the error message?

## Common Issues & Solutions

### 1. 404 Not Found

**Problem**: Route doesn't exist
**Solution**: Run `php artisan route:clear`

### 2. 419 Page Expired

**Problem**: CSRF token mismatch
**Solution**:

```bash
php artisan config:clear
php artisan cache:clear
```

Then refresh the page

### 3. 422 Unprocessable Entity

**Problem**: Validation errors
**Check**: Are all required fields filled?

- Experience: title, company, start_date
- Education: degree, institution, start_date
- Skills: name
- References: name, title

### 4. 403 Forbidden

**Problem**: Authorization/Permission issue
**Check**: Does the resume belong to the logged-in user?

### 5. 500 Internal Server Error

**Problem**: Server-side error
**Check**: `storage/logs/laravel.log` for details

## Test Individual Routes

### Test in Terminal:

```bash
# Test Experience Add
curl -X POST http://localhost/admin/resumes/1/experiences \
  -H "X-CSRF-TOKEN: your-token" \
  -d "title=Test&company=Test Inc&start_date=2024-01-01"

# Test Education Add
curl -X POST http://localhost/admin/resumes/1/educations \
  -H "X-CSRF-TOKEN: your-token" \
  -d "degree=BS&institution=University&start_date=2020-01-01"

# Test Skill Add
curl -X POST http://localhost/admin/resumes/1/skills \
  -H "X-CSRF-TOKEN: your-token" \
  -d "name=PHP&level=Advanced"
```

## Database Issues

Check if tables exist:

```bash
php artisan tinker
```

Then in Tinker:

```php
// Check if resume exists
\App\Models\Resume::find(1);

// Check experiences
\App\Models\ResumeExperience::where('resume_id', 1)->get();

// Check educations
\App\Models\ResumeEducation::where('resume_id', 1)->get();

// Check skills
\App\Models\ResumeSkill::where('resume_id', 1)->get();
```

## Verify Resume ID

Make sure you're editing a valid resume:

1. Go to `/admin/resumes`
2. Click "Edit" on a resume
3. Check the URL - it should be `/admin/resumes/{id}/edit`
4. The {id} must match the resume you own

## Model Relationships

Check that Resume model has relationships defined:

```php
// In app/Models/Resume.php
public function experiences() {
    return $this->hasMany(ResumeExperience::class);
}

public function educations() {
    return $this->hasMany(ResumeEducation::class);
}

public function skills() {
    return $this->hasMany(ResumeSkill::class);
}
```

## Quick Fix Checklist

- [ ] Clear all caches: `php artisan optimize:clear`
- [ ] Refresh browser page (Ctrl+F5)
- [ ] Check browser console for errors
- [ ] Verify you're logged in
- [ ] Verify resume ID exists and belongs to you
- [ ] Check `storage/logs/laravel.log` for errors
- [ ] Check database has all required tables
- [ ] Verify models have fillable fields
- [ ] Test with browser Network tab open

## Still Having Issues?

Add this temporary debug code to your controller method:

```php
public function storeExperience(Request $request, Resume $resume)
{
    \Log::info('Experience Store Called', [
        'resume_id' => $resume->id,
        'data' => $request->all()
    ]);

    // ... rest of your code
}
```

Then check `storage/logs/laravel.log` for the log entry.
