<!-- Edit Mode Modals and Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<style>
    .edit-mode-btn {
        background: #2196F3;
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
        margin: 5px;
    }

    .edit-mode-btn:hover {
        background: #1976D2;
    }

    .section-actions {
        display: flex;
        gap: 5px;
        margin-top: 10px;
    }

    .timeline-item,
    .skills-list li {
        position: relative;
    }

    .item-actions {
        position: absolute;
        right: 10px;
        top: 10px;
        display: flex;
        gap: 5px;
    }

    .item-actions .btn {
        padding: 2px 8px;
        font-size: 12px;
    }
</style>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Experience Functions
    function addExperience() {
        $('#experienceModal').modal('show');
        $('#experienceForm')[0].reset();
        $('#experienceForm').attr('data-action', 'add');
        $('#experienceForm').removeAttr('data-experience-id');
        $('#experienceModalLabel').text('Add Experience');
    }

    function editExperience(id, title, company, startDate, endDate, isCurrent, description) {
        $('#experienceModal').modal('show');
        $('#experienceForm').attr('data-action', 'edit');
        $('#experienceForm').attr('data-experience-id', id);
        $('#experienceModalLabel').text('Edit Experience');

        $('#exp_title').val(title);
        $('#exp_company').val(company);
        $('#exp_start_date').val(startDate);
        $('#exp_end_date').val(endDate);
        $('#exp_is_current').prop('checked', isCurrent == 1);
        $('#exp_description').val(description);
    }

    function deleteExperience(id) {
        if (confirm('Are you sure you want to delete this experience?')) {
            $.ajax({
                url: `/admin/resumes/{{ $resume->id }}/experiences/${id}`,
                method: 'DELETE',
                success: function (response) {
                    location.reload();
                },
                error: function (xhr) {
                    alert('Error deleting experience');
                }
            });
        }
    }

    $('#experienceForm').submit(function (e) {
        e.preventDefault();
        const action = $(this).attr('data-action');
        const experienceId = $(this).attr('data-experience-id');

        const data = {
            title: $('#exp_title').val(),
            company: $('#exp_company').val(),
            start_date: $('#exp_start_date').val(),
            end_date: $('#exp_end_date').val(),
            is_current: $('#exp_is_current').is(':checked') ? 1 : 0,
            description: $('#exp_description').val()
        };

        if (action === 'add') {
            $.post(`/admin/resumes/{{ $resume->id }}/experiences`, data, function (response) {
                location.reload();
            }).fail(function () {
                alert('Error adding experience');
            });
        } else {
            $.ajax({
                url: `/admin/resumes/{{ $resume->id }}/experiences/${experienceId}`,
                method: 'PUT',
                data: data,
                success: function (response) {
                    location.reload();
                },
                error: function () {
                    alert('Error updating experience');
                }
            });
        }
    });

    // Education Functions
    function addEducation() {
        $('#educationModal').modal('show');
        $('#educationForm')[0].reset();
        $('#educationForm').attr('data-action', 'add');
        $('#educationForm').removeAttr('data-education-id');
        $('#educationModalLabel').text('Add Education');
    }

    function editEducation(id, degree, institution, startDate, endDate, description) {
        $('#educationModal').modal('show');
        $('#educationForm').attr('data-action', 'edit');
        $('#educationForm').attr('data-education-id', id);
        $('#educationModalLabel').text('Edit Education');

        $('#edu_degree').val(degree);
        $('#edu_institution').val(institution);
        $('#edu_start_date').val(startDate);
        $('#edu_end_date').val(endDate);
        $('#edu_description').val(description);
    }

    function deleteEducation(id) {
        if (confirm('Are you sure you want to delete this education?')) {
            $.ajax({
                url: `/admin/resumes/{{ $resume->id }}/educations/${id}`,
                method: 'DELETE',
                success: function (response) {
                    location.reload();
                },
                error: function (xhr) {
                    alert('Error deleting education');
                }
            });
        }
    }

    $('#educationForm').submit(function (e) {
        e.preventDefault();
        const action = $(this).attr('data-action');
        const educationId = $(this).attr('data-education-id');

        const data = {
            degree: $('#edu_degree').val(),
            institution: $('#edu_institution').val(),
            start_date: $('#edu_start_date').val(),
            end_date: $('#edu_end_date').val(),
            description: $('#edu_description').val()
        };

        if (action === 'add') {
            $.post(`/admin/resumes/{{ $resume->id }}/educations`, data, function (response) {
                location.reload();
            }).fail(function () {
                alert('Error adding education');
            });
        } else {
            $.ajax({
                url: `/admin/resumes/{{ $resume->id }}/educations/${educationId}`,
                method: 'PUT',
                data: data,
                success: function (response) {
                    location.reload();
                },
                error: function () {
                    alert('Error updating education');
                }
            });
        }
    });

    // Skill Functions
    function addSkill() {
        $('#skillModal').modal('show');
        $('#skillForm')[0].reset();
        $('#skillForm').attr('data-action', 'add');
        $('#skillForm').removeAttr('data-skill-id');
        $('#skillModalLabel').text('Add Skill');
    }

    function editSkill(id, name, level) {
        $('#skillModal').modal('show');
        $('#skillForm').attr('data-action', 'edit');
        $('#skillForm').attr('data-skill-id', id);
        $('#skillModalLabel').text('Edit Skill');

        $('#skill_name').val(name);
        $('#skill_level').val(level);
    }

    function deleteSkill(id) {
        if (confirm('Are you sure you want to delete this skill?')) {
            $.ajax({
                url: `/admin/resumes/{{ $resume->id }}/skills/${id}`,
                method: 'DELETE',
                success: function (response) {
                    location.reload();
                },
                error: function (xhr) {
                    alert('Error deleting skill');
                }
            });
        }
    }

    $('#skillForm').submit(function (e) {
        e.preventDefault();
        const action = $(this).attr('data-action');
        const skillId = $(this).attr('data-skill-id');

        const data = {
            name: $('#skill_name').val(),
            level: $('#skill_level').val()
        };

        if (action === 'add') {
            $.post(`/admin/resumes/{{ $resume->id }}/skills`, data, function (response) {
                location.reload();
            }).fail(function () {
                alert('Error adding skill');
            });
        } else {
            $.ajax({
                url: `/admin/resumes/{{ $resume->id }}/skills/${skillId}`,
                method: 'PUT',
                data: data,
                success: function (response) {
                    location.reload();
                },
                error: function () {
                    alert('Error updating skill');
                }
            });
        }
    });

    // Project Functions
    function addProject() {
        $('#projectModal').modal('show');
        $('#projectForm')[0].reset();
        $('#projectForm').attr('data-action', 'add');
        $('#projectForm').removeAttr('data-project-id');
        $('#projectModalLabel').text('Add Project');
    }

    function editProject(id, name, description, url, role) {
        $('#projectModal').modal('show');
        $('#projectForm').attr('data-action', 'edit');
        $('#projectForm').attr('data-project-id', id);
        $('#projectModalLabel').text('Edit Project');

        $('#project_name').val(name);
        $('#project_description').val(description);
        $('#project_url').val(url);
        $('#project_role').val(role);
    }

    function deleteProject(id) {
        if (confirm('Are you sure you want to delete this project?')) {
            $.ajax({
                url: `/admin/resumes/{{ $resume->id }}/projects/${id}`,
                method: 'DELETE',
                success: function (response) {
                    location.reload();
                },
                error: function (xhr) {
                    alert('Error deleting project');
                }
            });
        }
    }

    $('#projectForm').submit(function (e) {
        e.preventDefault();
        const action = $(this).attr('data-action');
        const projectId = $(this).attr('data-project-id');

        const data = {
            name: $('#project_name').val(),
            description: $('#project_description').val(),
            url: $('#project_url').val(),
            role: $('#project_role').val()
        };

        if (action === 'add') {
            $.post(`/admin/resumes/{{ $resume->id }}/projects`, data, function (response) {
                location.reload();
            }).fail(function () {
                alert('Error adding project');
            });
        } else {
            $.ajax({
                url: `/admin/resumes/{{ $resume->id }}/projects/${projectId}`,
                method: 'PUT',
                data: data,
                success: function (response) {
                    location.reload();
                },
                error: function () {
                    alert('Error updating project');
                }
            });
        }
    });
</script>

<!-- Experience Modal -->
<div class="modal fade" id="experienceModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="experienceModalLabel">Add Experience</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="experienceForm">
                    <div class="mb-3">
                        <label class="form-label">Title *</label>
                        <input type="text" class="form-control" id="exp_title" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Company *</label>
                        <input type="text" class="form-control" id="exp_company" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Start Date *</label>
                            <input type="date" class="form-control" id="exp_start_date" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">End Date</label>
                            <input type="date" class="form-control" id="exp_end_date">
                        </div>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exp_is_current">
                        <label class="form-check-label">Currently Working</label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" id="exp_description" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Education Modal -->
<div class="modal fade" id="educationModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="educationModalLabel">Add Education</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="educationForm">
                    <div class="mb-3">
                        <label class="form-label">Degree *</label>
                        <input type="text" class="form-control" id="edu_degree" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Institution *</label>
                        <input type="text" class="form-control" id="edu_institution" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Start Date *</label>
                            <input type="date" class="form-control" id="edu_start_date" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">End Date</label>
                            <input type="date" class="form-control" id="edu_end_date">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" id="edu_description" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Skill Modal -->
<div class="modal fade" id="skillModal" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="skillModalLabel">Add Skill</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="skillForm">
                    <div class="mb-3">
                        <label class="form-label">Skill Name *</label>
                        <input type="text" class="form-control" id="skill_name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Level</label>
                        <select class="form-select" id="skill_level">
                            <option value="">Select Level</option>
                            <option value="Beginner">Beginner</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Advanced">Advanced</option>
                            <option value="Expert">Expert</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Project Modal -->
<div class="modal fade" id="projectModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="projectModalLabel">Add Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="projectForm">
                    <div class="mb-3">
                        <label class="form-label">Project Name *</label>
                        <input type="text" class="form-control" id="project_name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" id="project_description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Project URL</label>
                        <input type="url" class="form-control" id="project_url">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Your Role</label>
                        <input type="text" class="form-control" id="project_role">
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>