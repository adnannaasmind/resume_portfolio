# Resume Editor - Common CRUD System Documentation

## Overview

This document explains the **centralized Resume Editor system** that provides reusable CRUD (Create, Read, Update, Delete) operations for all resume templates.

## 📁 File Structure

```
public/
└── backend/
    └── js/
        └── resume-editor.js  (Common script for all templates)

resources/
└── views/
    └── admin/
        └── resume_templates/
            ├── template_free.blade.php     (Uses common script)
            ├── template_premium.blade.php  (Uses common script)
            └── ... (any future templates)
```

## 🎯 Key Features

### 1. **Single Source of Truth**

All CRUD logic is centralized in `resume-editor.js`, eliminating code duplication across templates.

### 2. **Reusable Functions**

The same functions work across all templates - no need to write separate scripts for each template.

### 3. **Object-Oriented Design**

Uses ES6 class-based architecture for clean, maintainable code.

### 4. **Data Attributes**

Templates use `data-*` attributes to store information, making the system flexible and template-agnostic.

## 🔧 How It Works

### Step 1: Include the Common Script

In your Blade template, include the common script:

```blade
@if ($isEditMode ?? false)
    <!-- Include jQuery (if needed) -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <!-- Include Common Resume Editor Script -->
    <script src="{{ asset('backend/js/resume-editor.js') }}"></script>
@endif
```

### Step 2: Add Resume ID Data Attribute

Add `data-resume-id` to your template wrapper:

```blade
<div class="resume-template-wrapper" data-resume-id="{{ $resume->id }}">
    <!-- Your template content -->
</div>
```

### Step 3: Add Data Attributes to Elements

For each editable section, add appropriate data attributes:

#### Experience Section

```blade
<div data-experience-id="{{ $experience->id }}"
     data-title="{{ $experience->title }}"
     data-company="{{ $experience->company }}"
     data-location="{{ $experience->location ?? '' }}"
     data-start-date="{{ $experience->start_date }}"
     data-end-date="{{ $experience->end_date ?? '' }}"
     data-is-current="{{ $experience->is_current ? 'true' : 'false' }}"
     data-description="{{ $experience->description ?? '' }}">

    @if ($isEditMode ?? false)
        <button onclick="resumeEditor.editExperience({{ $experience->id }})">Edit</button>
        <button onclick="resumeEditor.deleteExperience({{ $experience->id }})">Delete</button>
    @endif

    <!-- Display content -->
    <h3>{{ $experience->title }}</h3>
    <p>{{ $experience->company }}</p>
</div>
```

#### Education Section

```blade
<div data-education-id="{{ $education->id }}"
     data-degree="{{ $education->degree }}"
     data-institution="{{ $education->institution }}"
     data-start-date="{{ $education->start_date }}"
     data-end-date="{{ $education->end_date ?? '' }}"
     data-description="{{ $education->description ?? '' }}">

    @if ($isEditMode ?? false)
        <button onclick="resumeEditor.editEducation({{ $education->id }})">Edit</button>
        <button onclick="resumeEditor.deleteEducation({{ $education->id }})">Delete</button>
    @endif
</div>
```

#### Skills Section

```blade
<div data-skill-id="{{ $skill->id }}"
     data-name="{{ $skill->name }}"
     data-level="{{ $skill->level ?? '' }}">

    @if ($isEditMode ?? false)
        <button onclick="resumeEditor.editSkill({{ $skill->id }})">Edit</button>
        <button onclick="resumeEditor.deleteSkill({{ $skill->id }})">Delete</button>
    @endif

    <span>{{ $skill->name }}</span>
</div>
```

#### Profile Section

```blade
<h1 data-profile-name="{{ $resume->user->name }}">{{ $resume->user->name }}</h1>
<p data-profile-title="{{ $resume->title }}">{{ $resume->title }}</p>

@if ($isEditMode ?? false)
    <button onclick="resumeEditor.editProfile()">Edit Profile</button>
    <button onclick="resumeEditor.editProfileImage()">Edit Image</button>
@endif
```

#### Contact Section

```blade
<span data-contact-email="{{ $resume->user->email }}">{{ $resume->user->email }}</span>
<span data-contact-phone="{{ $resume->user->userProfile->phone ?? '' }}">{{ $resume->user->userProfile->phone ?? 'N/A' }}</span>
<span data-contact-address="{{ $resume->user->userProfile->location ?? '' }}">{{ $resume->user->userProfile->location ?? 'N/A' }}</span>

@if ($isEditMode ?? false)
    <button onclick="resumeEditor.editContact()">Edit Contact</button>
@endif
```

#### About/Summary Section

```blade
<p data-about-summary="{{ $resume->data['summary'] ?? '' }}">
    {{ $resume->data['summary'] ?? 'N/A' }}
</p>

@if ($isEditMode ?? false)
    <button onclick="resumeEditor.editAbout()">Edit About</button>
@endif
```

#### References Section

```blade
<div data-reference-id="{{ $reference['id'] }}"
     data-name="{{ $reference['name'] }}"
     data-position="{{ $reference['title'] }}"
     data-company="{{ $reference['company'] ?? '' }}"
     data-phone="{{ $reference['phone'] ?? '' }}"
     data-email="{{ $reference['email'] ?? '' }}">

    @if ($isEditMode ?? false)
        <button onclick="resumeEditor.editReference({{ $reference['id'] }})">Edit</button>
        <button onclick="resumeEditor.deleteReference({{ $reference['id'] }})">Delete</button>
    @endif
</div>
```

### Step 4: Add "Add New" Buttons

```blade
@if ($isEditMode ?? false)
    <button onclick="resumeEditor.addExperience()">+ Add Experience</button>
    <button onclick="resumeEditor.addEducation()">+ Add Education</button>
    <button onclick="resumeEditor.addSkill()">+ Add Skill</button>
    <button onclick="resumeEditor.addProject()">+ Add Project</button>
    <button onclick="resumeEditor.addReference()">+ Add Reference</button>
@endif
```

## 📚 Available Functions

### Experience Management

- `resumeEditor.addExperience()` - Opens form to add new experience
- `resumeEditor.editExperience(id)` - Opens form to edit experience
- `resumeEditor.deleteExperience(id)` - Deletes an experience
- `resumeEditor.saveExperience(formData, id)` - Saves (internal use)

### Education Management

- `resumeEditor.addEducation()` - Opens form to add new education
- `resumeEditor.editEducation(id)` - Opens form to edit education
- `resumeEditor.deleteEducation(id)` - Deletes an education
- `resumeEditor.saveEducation(formData, id)` - Saves (internal use)

### Skills Management

- `resumeEditor.addSkill()` - Opens form to add new skill
- `resumeEditor.editSkill(id)` - Opens form to edit skill
- `resumeEditor.deleteSkill(id)` - Deletes a skill
- `resumeEditor.saveSkill(formData, id)` - Saves (internal use)

### Projects Management

- `resumeEditor.addProject()` - Opens form to add new project
- `resumeEditor.editProject(id)` - Opens form to edit project
- `resumeEditor.deleteProject(id)` - Deletes a project
- `resumeEditor.saveProject(formData, id)` - Saves (internal use)

### Profile Management

- `resumeEditor.editProfile()` - Opens form to edit name and job title
- `resumeEditor.editProfileImage()` - Opens form to upload/remove profile image
- `resumeEditor.saveProfile(formData)` - Saves profile (internal use)
- `resumeEditor.saveProfileImage(formData)` - Saves image (internal use)

### Contact Management

- `resumeEditor.editContact()` - Opens form to edit contact info
- `resumeEditor.saveContact(formData)` - Saves contact (internal use)

### About/Summary Management

- `resumeEditor.editAbout()` - Opens form to edit professional summary
- `resumeEditor.saveAbout(formData)` - Saves summary (internal use)

### References Management

- `resumeEditor.addReference()` - Opens form to add new reference
- `resumeEditor.editReference(id)` - Opens form to edit reference
- `resumeEditor.deleteReference(id)` - Deletes a reference
- `resumeEditor.saveReference(formData, id)` - Saves (internal use)

### Utility Functions

- `resumeEditor.openSidebar(title, content)` - Opens edit sidebar
- `resumeEditor.closeSidebar()` - Closes edit sidebar
- `resumeEditor.showNotification(message, type)` - Shows notification
- `resumeEditor.makeRequest(url, method, data)` - Makes AJAX request

## 🔄 How Data Flows

### Creating New Item

1. User clicks "Add" button → `resumeEditor.addExperience()`
2. System opens sidebar with empty form
3. User fills form and submits
4. `saveExperience()` sends POST request to `/admin/resumes/{id}/experiences`
5. Page reloads to show new item

### Editing Existing Item

1. User clicks "Edit" button → `resumeEditor.editExperience(id)`
2. System reads data from `data-*` attributes
3. Sidebar opens with pre-filled form
4. User modifies and submits
5. `saveExperience(formData, id)` sends PUT request to `/admin/resumes/{id}/experiences/{exp_id}`
6. Page reloads to show changes

### Deleting Item

1. User clicks "Delete" button → `resumeEditor.deleteExperience(id)`
2. Confirmation dialog appears
3. If confirmed, sends DELETE request to `/admin/resumes/{id}/experiences/{exp_id}`
4. Page reloads to reflect deletion

## 🎨 Edit Sidebar Structure

The common script requires a sidebar structure in your template:

```blade
@if ($isEditMode ?? false)
    <!-- Overlay -->
    <div class="edit-sidebar-overlay" id="editSidebarOverlay"></div>

    <!-- Sidebar -->
    <div class="edit-sidebar" id="editSidebar">
        <div class="edit-sidebar-header">
            <h3 id="editSidebarTitle">Add Item</h3>
            <button class="edit-sidebar-close" onclick="resumeEditor.closeSidebar()">&times;</button>
        </div>
        <div class="edit-sidebar-body" id="editSidebarBody">
            <!-- Dynamic content loaded here -->
        </div>
    </div>
@endif
```

## 🚀 Creating a New Template

To create a new template that uses the common system:

1. **Create your template Blade file**
2. **Add the wrapper with data-resume-id:**

    ```blade
    <div class="my-template-wrapper" data-resume-id="{{ $resume->id }}">
    ```

3. **Include the common script:**

    ```blade
    <script src="{{ asset('backend/js/resume-editor.js') }}"></script>
    ```

4. **Add data attributes to all editable sections** (see examples above)

5. **Add the edit sidebar structure** (see sidebar example above)

6. **Use the common functions:**
    ```blade
    <button onclick="resumeEditor.addExperience()">Add Experience</button>
    <button onclick="resumeEditor.editEducation({{ $edu->id }})">Edit</button>
    ```

That's it! Your template now has full CRUD functionality without writing any JavaScript.

## ✅ Benefits

### Before (Old System)

- ❌ Separate scripts for each template
- ❌ 1000+ lines of duplicate code per template
- ❌ Hard to maintain (changes needed in multiple files)
- ❌ Inconsistent behavior across templates
- ❌ Difficult to add new features

### After (New System)

- ✅ Single common script (~1400 lines total)
- ✅ Zero code duplication
- ✅ Easy maintenance (update one file)
- ✅ Consistent behavior everywhere
- ✅ Easy to add new templates

## 🐛 Troubleshooting

### Function not working

- Check if `data-resume-id` is present on wrapper
- Verify data attributes are correctly set
- Check browser console for errors
- Ensure jQuery is loaded before resume-editor.js

### Sidebar not opening

- Verify sidebar HTML structure is present
- Check if `editSidebar` and `editSidebarBody` IDs exist
- Ensure CSS styles are loaded

### Data not saving

- Check network tab for failed requests
- Verify CSRF token is present
- Check Laravel routes are correctly defined
- Verify controller methods exist

## 📝 Best Practices

1. **Always use data attributes** - Don't pass data through onclick parameters
2. **Keep template markup clean** - Logic is in JavaScript, not Blade
3. **Use consistent naming** - Follow the established data attribute naming
4. **Test on different templates** - Ensure changes work everywhere
5. **Document custom functions** - If you add template-specific code

## 🔮 Future Enhancements

- Auto-save functionality
- Inline editing without sidebar
- Drag-and-drop reordering
- Real-time preview
- Undo/redo functionality
- Form validation improvements
- Loading indicators
- Better error handling

## 📞 Support

For questions or issues with the Resume Editor system, contact the development team or refer to this documentation.

---

**Last Updated:** January 20, 2026  
**Version:** 1.0.0  
**Maintainer:** Resume Portfolio Development Team
