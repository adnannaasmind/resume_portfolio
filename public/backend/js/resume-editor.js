/**
 * Resume Editor - Common CRUD Operations for All Resume Templates
 *
 * This script provides reusable functions for managing resume sections
 * across all templates. It follows DRY principles and provides a centralized
 * way to handle Create, Read, Update, Delete operations.
 *
 * @author Resume Portfolio System
 * @version 1.0.0
 */

class ResumeEditor {
    constructor(resumeId) {
        this.resumeId = resumeId;
        this.csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        this.baseUrl = '/admin/resumes';
        this.initializeEventListeners();
    }

    /**
     * Initialize global event listeners
     */
    initializeEventListeners() {
        // Close sidebar when clicking overlay
        const overlay = document.getElementById('editSidebarOverlay');
        if (overlay) {
            overlay.addEventListener('click', () => this.closeSidebar());
        }
    }

    /**
     * Generic AJAX Request Handler
     */
    async makeRequest(url, method = 'GET', data = null) {
        const options = {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': this.csrfToken,
                'Accept': 'application/json'
            }
        };

        if (data && (method === 'POST' || method === 'PUT' || method === 'DELETE')) {
            options.body = JSON.stringify(data);
        }

        try {
            const response = await fetch(url, options);
            const result = await response.json();

            if (!response.ok) {
                throw new Error(result.message || 'Request failed');
            }

            return result;
        } catch (error) {
            console.error('Request error:', error);
            this.showNotification('Error: ' + error.message, 'error');
            throw error;
        }
    }

    /**
     * Show notification message
     */
    showNotification(message, type = 'success') {
        // Check if Bootstrap Notify is available
        if (typeof $.notify !== 'undefined') {
            // Map type to Bootstrap Notify types
            const typeMap = {
                'success': 'success',
                'error': 'danger',
                'warning': 'warning',
                'info': 'info'
            };

            const notifyType = typeMap[type] || 'info';

            // Icon mapping
            const iconMap = {
                'success': 'icon-check',
                'error': 'icon-close',
                'warning': 'icon-bell',
                'info': 'icon-info'
            };

            $.notify({
                icon: iconMap[type] || 'icon-bell',
                message: message
            }, {
                type: notifyType,
                placement: {
                    from: "top",
                    align: "right"
                },
                time: 3000,
                delay: 100
            });
        } else {
            // Fallback to alert
            alert(message);
        }
    }

    /**
     * Escape HTML to prevent XSS attacks
     */
    escapeHtml(text) {
        if (!text) return '';
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.toString().replace(/[&<>"']/g, m => map[m]);
    }

    /**
     * Open sidebar with content
     */
    openSidebar(title, content) {
        const sidebar = document.getElementById('editSidebar');
        const overlay = document.getElementById('editSidebarOverlay');
        const sidebarTitle = document.getElementById('editSidebarTitle');
        const sidebarBody = document.getElementById('editSidebarBody');

        if (sidebar && overlay && sidebarTitle && sidebarBody) {
            sidebarTitle.textContent = title;
            sidebarBody.innerHTML = content;
            sidebar.classList.add('active');
            overlay.classList.add('active');
        }
    }

    /**
     * Close sidebar
     */
    closeSidebar() {
        const sidebar = document.getElementById('editSidebar');
        const overlay = document.getElementById('editSidebarOverlay');

        if (sidebar && overlay) {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        }
    }

    /**
     * Format date for display
     */
    formatDate(date) {
        if (!date) return '';
        const d = new Date(date);
        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        return `${months[d.getMonth()]} ${d.getFullYear()}`;
    }

    /**
     * ========================================
     * EXPERIENCE CRUD OPERATIONS
     * ========================================
     */

    /**
     * Add new experience
     */
    addExperience() {
        const formHtml = `
            <form id="experienceForm" class="edit-form">
                <div class="edit-form-group">
                    <label class="edit-form-label">Job Title *</label>
                    <input type="text" name="title" class="edit-form-input" required>
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">Company *</label>
                    <input type="text" name="company" class="edit-form-input" required>
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">Location</label>
                    <input type="text" name="location" class="edit-form-input">
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">Start Date *</label>
                    <input type="date" name="start_date" class="edit-form-input" required>
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">End Date</label>
                    <input type="date" name="end_date" class="edit-form-input">
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-checkbox">
                        <input type="checkbox" name="is_current">
                        <span>Currently working here</span>
                    </label>
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">Description</label>
                    <textarea name="description" class="edit-form-textarea" rows="5"></textarea>
                </div>
                <div class="edit-form-actions">
                    <button type="submit" class="edit-btn-primary">Save Experience</button>
                    <button type="button" class="edit-btn-secondary" onclick="resumeEditor.closeSidebar()">Cancel</button>
                </div>
            </form>
        `;

        this.openSidebar('Add Experience', formHtml);

        // Handle form submission
        document.getElementById('experienceForm').addEventListener('submit', (e) => {
            e.preventDefault();
            this.saveExperience(new FormData(e.target));
        });

        // Handle current job checkbox
        document.querySelector('[name="is_current"]').addEventListener('change', function() {
            document.querySelector('[name="end_date"]').disabled = this.checked;
            if (this.checked) {
                document.querySelector('[name="end_date"]').value = '';
            }
        });
    }

    /**
     * Edit existing experience
     */
    editExperience(experienceId) {
        // Find experience data from DOM
        const experienceElement = document.querySelector(`[data-experience-id="${experienceId}"]`);
        if (!experienceElement) {
            this.showNotification('Experience not found', 'error');
            return;
        }

        const experience = {
            id: experienceId,
            title: experienceElement.dataset.title || '',
            company: experienceElement.dataset.company || '',
            location: experienceElement.dataset.location || '',
            start_date: experienceElement.dataset.startDate || '',
            end_date: experienceElement.dataset.endDate || '',
            is_current: experienceElement.dataset.isCurrent === 'true',
            description: experienceElement.dataset.description || ''
        };

        const formHtml = `
            <form id="experienceForm" class="edit-form">
                <input type="hidden" name="id" value="${experience.id}">
                <div class="edit-form-group">
                    <label class="edit-form-label">Job Title *</label>
                    <input type="text" name="title" class="edit-form-input" value="${experience.title}" required>
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">Company *</label>
                    <input type="text" name="company" class="edit-form-input" value="${experience.company}" required>
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">Location</label>
                    <input type="text" name="location" class="edit-form-input" value="${experience.location}">
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">Start Date *</label>
                    <input type="date" name="start_date" class="edit-form-input" value="${experience.start_date}" required>
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">End Date</label>
                    <input type="date" name="end_date" class="edit-form-input" value="${experience.end_date}" ${experience.is_current ? 'disabled' : ''}>
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-checkbox">
                        <input type="checkbox" name="is_current" ${experience.is_current ? 'checked' : ''}>
                        <span>Currently working here</span>
                    </label>
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">Description</label>
                    <textarea name="description" class="edit-form-textarea" rows="5">${experience.description}</textarea>
                </div>
                <div class="edit-form-actions">
                    <button type="submit" class="edit-btn-primary">Update Experience</button>
                    <button type="button" class="edit-btn-secondary" onclick="resumeEditor.closeSidebar()">Cancel</button>
                </div>
            </form>
        `;

        this.openSidebar('Edit Experience', formHtml);

        // Handle form submission
        document.getElementById('experienceForm').addEventListener('submit', (e) => {
            e.preventDefault();
            this.saveExperience(new FormData(e.target), experienceId);
        });

        // Handle current job checkbox
        document.querySelector('[name="is_current"]').addEventListener('change', function() {
            document.querySelector('[name="end_date"]').disabled = this.checked;
            if (this.checked) {
                document.querySelector('[name="end_date"]').value = '';
            }
        });
    }

    /**
     * Save experience (create or update)
     */
    async saveExperience(formData, experienceId = null) {
        const data = {};
        for (let [key, value] of formData.entries()) {
            if (key === 'is_current') {
                data[key] = formData.get(key) ? true : false;
            } else {
                data[key] = value;
            }
        }

        try {
            let url, method;
            if (experienceId) {
                url = `${this.baseUrl}/${this.resumeId}/experiences/${experienceId}`;
                method = 'PUT';
            } else {
                url = `${this.baseUrl}/${this.resumeId}/experiences`;
                method = 'POST';
            }

            const result = await this.makeRequest(url, method, data);
            this.showNotification(result.message || 'Experience saved successfully', 'success');
            this.closeSidebar();

            // Reload page to show changes
            setTimeout(() => window.location.reload(), 1000);
        } catch (error) {
            console.error('Error saving experience:', error);
        }
    }

    /**
     * Delete experience
     */
    async deleteExperience(experienceId) {
        if (!confirm('Are you sure you want to delete this experience?')) {
            return;
        }

        try {
            const url = `${this.baseUrl}/${this.resumeId}/experiences/${experienceId}`;
            const result = await this.makeRequest(url, 'DELETE');
            this.showNotification(result.message || 'Experience deleted successfully', 'success');

            // Reload page to show changes
            setTimeout(() => window.location.reload(), 1000);
        } catch (error) {
            console.error('Error deleting experience:', error);
        }
    }

    /**
     * ========================================
     * EDUCATION CRUD OPERATIONS
     * ========================================
     */

    /**
     * Add new education
     */
    addEducation() {
        const formHtml = `
            <form id="educationForm" class="edit-form">
                <div class="edit-form-group">
                    <label class="edit-form-label">Degree/Certificate *</label>
                    <input type="text" name="degree" class="edit-form-input" required>
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">Institution *</label>
                    <input type="text" name="institution" class="edit-form-input" required>
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">Start Date *</label>
                    <input type="date" name="start_date" class="edit-form-input" required>
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">End Date</label>
                    <input type="date" name="end_date" class="edit-form-input">
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">Description</label>
                    <textarea name="description" class="edit-form-textarea" rows="4"></textarea>
                </div>
                <div class="edit-form-actions">
                    <button type="submit" class="edit-btn-primary">Save Education</button>
                    <button type="button" class="edit-btn-secondary" onclick="resumeEditor.closeSidebar()">Cancel</button>
                </div>
            </form>
        `;

        this.openSidebar('Add Education', formHtml);

        document.getElementById('educationForm').addEventListener('submit', (e) => {
            e.preventDefault();
            this.saveEducation(new FormData(e.target));
        });
    }

    /**
     * Edit existing education
     */
    editEducation(educationId) {
        const educationElement = document.querySelector(`[data-education-id="${educationId}"]`);
        if (!educationElement) {
            this.showNotification('Education not found', 'error');
            return;
        }

        const education = {
            id: educationId,
            degree: educationElement.dataset.degree || '',
            institution: educationElement.dataset.institution || '',
            start_date: educationElement.dataset.startDate || '',
            end_date: educationElement.dataset.endDate || '',
            description: educationElement.dataset.description || ''
        };

        const formHtml = `
            <form id="educationForm" class="edit-form">
                <input type="hidden" name="id" value="${education.id}">
                <div class="edit-form-group">
                    <label class="edit-form-label">Degree/Certificate *</label>
                    <input type="text" name="degree" class="edit-form-input" value="${education.degree}" required>
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">Institution *</label>
                    <input type="text" name="institution" class="edit-form-input" value="${education.institution}" required>
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">Start Date *</label>
                    <input type="date" name="start_date" class="edit-form-input" value="${education.start_date}" required>
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">End Date</label>
                    <input type="date" name="end_date" class="edit-form-input" value="${education.end_date}">
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">Description</label>
                    <textarea name="description" class="edit-form-textarea" rows="4">${education.description}</textarea>
                </div>
                <div class="edit-form-actions">
                    <button type="submit" class="edit-btn-primary">Update Education</button>
                    <button type="button" class="edit-btn-secondary" onclick="resumeEditor.closeSidebar()">Cancel</button>
                </div>
            </form>
        `;

        this.openSidebar('Edit Education', formHtml);

        document.getElementById('educationForm').addEventListener('submit', (e) => {
            e.preventDefault();
            this.saveEducation(new FormData(e.target), educationId);
        });
    }

    /**
     * Save education (create or update)
     */
    async saveEducation(formData, educationId = null) {
        const data = Object.fromEntries(formData.entries());

        try {
            let url, method;
            if (educationId) {
                url = `${this.baseUrl}/${this.resumeId}/educations/${educationId}`;
                method = 'PUT';
            } else {
                url = `${this.baseUrl}/${this.resumeId}/educations`;
                method = 'POST';
            }

            const result = await this.makeRequest(url, method, data);
            this.showNotification(result.message || 'Education saved successfully', 'success');
            this.closeSidebar();
            setTimeout(() => window.location.reload(), 1000);
        } catch (error) {
            console.error('Error saving education:', error);
        }
    }

    /**
     * Delete education
     */
    async deleteEducation(educationId) {
        if (!confirm('Are you sure you want to delete this education?')) {
            return;
        }

        try {
            const url = `${this.baseUrl}/${this.resumeId}/educations/${educationId}`;
            const result = await this.makeRequest(url, 'DELETE');
            this.showNotification(result.message || 'Education deleted successfully', 'success');
            setTimeout(() => window.location.reload(), 1000);
        } catch (error) {
            console.error('Error deleting education:', error);
        }
    }

    /**
     * ========================================
     * SKILL CRUD OPERATIONS
     * ========================================
     */

    /**
     * Add new skill
     */
    addSkill() {
        const formHtml = `
            <form id="skillForm" class="edit-form">
                <div class="edit-form-group">
                    <label class="edit-form-label">Skill Name *</label>
                    <input type="text" name="name" class="edit-form-input" required>
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">Proficiency Level</label>
                    <select name="level" class="edit-form-select">
                        <option value="">Select Level</option>
                        <option value="Beginner">Beginner</option>
                        <option value="Intermediate">Intermediate</option>
                        <option value="Advanced">Advanced</option>
                        <option value="Expert">Expert</option>
                    </select>
                </div>
                <div class="edit-form-actions">
                    <button type="submit" class="edit-btn-primary">Save Skill</button>
                    <button type="button" class="edit-btn-secondary" onclick="resumeEditor.closeSidebar()">Cancel</button>
                </div>
            </form>
        `;

        this.openSidebar('Add Skill', formHtml);

        document.getElementById('skillForm').addEventListener('submit', (e) => {
            e.preventDefault();
            this.saveSkill(new FormData(e.target));
        });
    }

    /**
     * Edit existing skill
     */
    editSkill(skillId) {
        const skillElement = document.querySelector(`[data-skill-id="${skillId}"]`);
        if (!skillElement) {
            this.showNotification('Skill not found', 'error');
            return;
        }

        const skill = {
            id: skillId,
            name: skillElement.dataset.name || '',
            level: skillElement.dataset.level || ''
        };

        const formHtml = `
            <form id="skillForm" class="edit-form">
                <input type="hidden" name="id" value="${skill.id}">
                <div class="edit-form-group">
                    <label class="edit-form-label">Skill Name *</label>
                    <input type="text" name="name" class="edit-form-input" value="${skill.name}" required>
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">Proficiency Level</label>
                    <select name="level" class="edit-form-select">
                        <option value="">Select Level</option>
                        <option value="Beginner" ${skill.level === 'Beginner' ? 'selected' : ''}>Beginner</option>
                        <option value="Intermediate" ${skill.level === 'Intermediate' ? 'selected' : ''}>Intermediate</option>
                        <option value="Advanced" ${skill.level === 'Advanced' ? 'selected' : ''}>Advanced</option>
                        <option value="Expert" ${skill.level === 'Expert' ? 'selected' : ''}>Expert</option>
                    </select>
                </div>
                <div class="edit-form-actions">
                    <button type="submit" class="edit-btn-primary">Update Skill</button>
                    <button type="button" class="edit-btn-secondary" onclick="resumeEditor.closeSidebar()">Cancel</button>
                </div>
            </form>
        `;

        this.openSidebar('Edit Skill', formHtml);

        document.getElementById('skillForm').addEventListener('submit', (e) => {
            e.preventDefault();
            this.saveSkill(new FormData(e.target), skillId);
        });
    }

    /**
     * Save skill (create or update)
     */
    async saveSkill(formData, skillId = null) {
        const data = Object.fromEntries(formData.entries());

        try {
            let url, method;
            if (skillId) {
                url = `${this.baseUrl}/${this.resumeId}/skills/${skillId}`;
                method = 'PUT';
            } else {
                url = `${this.baseUrl}/${this.resumeId}/skills`;
                method = 'POST';
            }

            const result = await this.makeRequest(url, method, data);
            this.showNotification(result.message || 'Skill saved successfully', 'success');
            this.closeSidebar();
            setTimeout(() => window.location.reload(), 1000);
        } catch (error) {
            console.error('Error saving skill:', error);
        }
    }

    /**
     * Delete skill
     */
    async deleteSkill(skillId) {
        if (!confirm('Are you sure you want to delete this skill?')) {
            return;
        }

        try {
            const url = `${this.baseUrl}/${this.resumeId}/skills/${skillId}`;
            const result = await this.makeRequest(url, 'DELETE');
            this.showNotification(result.message || 'Skill deleted successfully', 'success');
            setTimeout(() => window.location.reload(), 1000);
        } catch (error) {
            console.error('Error deleting skill:', error);
        }
    }

    /**
     * ========================================
     * PROJECT CRUD OPERATIONS
     * ========================================
     */

    /**
     * Add new project
     */
    addProject() {
        const formHtml = `
            <form id="projectForm" class="edit-form">
                <div class="edit-form-group">
                    <label class="edit-form-label">Project Name *</label>
                    <input type="text" name="name" class="edit-form-input" required>
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">URL</label>
                    <input type="url" name="url" class="edit-form-input">
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">Your Role</label>
                    <input type="text" name="role" class="edit-form-input">
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">Description</label>
                    <textarea name="description" class="edit-form-textarea" rows="5"></textarea>
                </div>
                <div class="edit-form-actions">
                    <button type="submit" class="edit-btn-primary">Save Project</button>
                    <button type="button" class="edit-btn-secondary" onclick="resumeEditor.closeSidebar()">Cancel</button>
                </div>
            </form>
        `;

        this.openSidebar('Add Project', formHtml);

        document.getElementById('projectForm').addEventListener('submit', (e) => {
            e.preventDefault();
            this.saveProject(new FormData(e.target));
        });
    }

    /**
     * Edit existing project
     */
    editProject(projectId) {
        const projectElement = document.querySelector(`[data-project-id="${projectId}"]`);
        if (!projectElement) {
            this.showNotification('Project not found', 'error');
            return;
        }

        const project = {
            id: projectId,
            name: projectElement.dataset.name || '',
            url: projectElement.dataset.url || '',
            role: projectElement.dataset.role || '',
            description: projectElement.dataset.description || ''
        };

        const formHtml = `
            <form id="projectForm" class="edit-form">
                <input type="hidden" name="id" value="${project.id}">
                <div class="edit-form-group">
                    <label class="edit-form-label">Project Name *</label>
                    <input type="text" name="name" class="edit-form-input" value="${project.name}" required>
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">URL</label>
                    <input type="url" name="url" class="edit-form-input" value="${project.url}">
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">Your Role</label>
                    <input type="text" name="role" class="edit-form-input" value="${project.role}">
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">Description</label>
                    <textarea name="description" class="edit-form-textarea" rows="5">${project.description}</textarea>
                </div>
                <div class="edit-form-actions">
                    <button type="submit" class="edit-btn-primary">Update Project</button>
                    <button type="button" class="edit-btn-secondary" onclick="resumeEditor.closeSidebar()">Cancel</button>
                </div>
            </form>
        `;

        this.openSidebar('Edit Project', formHtml);

        document.getElementById('projectForm').addEventListener('submit', (e) => {
            e.preventDefault();
            this.saveProject(new FormData(e.target), projectId);
        });
    }

    /**
     * Save project (create or update)
     */
    async saveProject(formData, projectId = null) {
        const data = Object.fromEntries(formData.entries());

        try {
            let url, method;
            if (projectId) {
                url = `${this.baseUrl}/${this.resumeId}/projects/${projectId}`;
                method = 'PUT';
            } else {
                url = `${this.baseUrl}/${this.resumeId}/projects`;
                method = 'POST';
            }

            const result = await this.makeRequest(url, method, data);
            this.showNotification(result.message || 'Project saved successfully', 'success');
            this.closeSidebar();
            setTimeout(() => window.location.reload(), 1000);
        } catch (error) {
            console.error('Error saving project:', error);
        }
    }

    /**
     * Delete project
     */
    async deleteProject(projectId) {
        if (!confirm('Are you sure you want to delete this project?')) {
            return;
        }

        try {
            const url = `${this.baseUrl}/${this.resumeId}/projects/${projectId}`;
            const result = await this.makeRequest(url, 'DELETE');
            this.showNotification(result.message || 'Project deleted successfully', 'success');
            setTimeout(() => window.location.reload(), 1000);
        } catch (error) {
            console.error('Error deleting project:', error);
        }
    }

    /**
     * ========================================
     * PROFILE CRUD OPERATIONS
     * ========================================
     */

    /**
     * Edit complete profile (image, name, job title) - All in one
     */
    editProfile() {
        // Get current profile data from DOM
        const nameElement = document.querySelector('[data-profile-name]');
        const titleElement = document.querySelector('[data-profile-title]');
        const profileImg = document.querySelector('.profile-img img');

        const profile = {
            name: nameElement?.dataset.profileName || nameElement?.textContent?.trim() || '',
            job_title: titleElement?.dataset.profileTitle || titleElement?.textContent?.trim() || '',
            hasImage: profileImg ? true : false,
            imageUrl: profileImg?.src || ''
        };

        const formHtml = `
            <form id="profileForm" class="edit-form" enctype="multipart/form-data">
                <div class="edit-form-group">
                    <label class="edit-form-label">Profile Image</label>
                    ${profile.hasImage ? `
                        <div style="margin-bottom: 15px; text-align: center;">
                            <img src="${profile.imageUrl}" alt="Current Profile" style="width: 120px; height: 120px; border-radius: 50%; object-fit: cover; border: 3px solid #2196F3;">
                        </div>
                    ` : ''}
                    <input type="file" name="profile_image" class="edit-form-input" accept="image/*">
                    <small style="display: block; margin-top: 5px; color: #666;">Max 2MB. JPG, PNG, GIF (Optional - leave empty to keep current)</small>
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">Full Name *</label>
                    <input type="text" name="name" class="edit-form-input" value="${profile.name}" required>
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">Job Title *</label>
                    <input type="text" name="job_title" class="edit-form-input" value="${profile.job_title}" required>
                </div>
                <div class="edit-form-actions">
                    <button type="submit" class="edit-btn-primary">Update Profile</button>
                    <button type="button" class="edit-btn-secondary" onclick="resumeEditor.closeSidebar()">Cancel</button>
                </div>
            </form>
        `;

        this.openSidebar('Edit Profile', formHtml);

        document.getElementById('profileForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            await this.saveProfile(new FormData(e.target));
        });
    }

    /**
     * Save complete profile information (image, name, job title)
     */
    async saveProfile(formData) {
        try {
            const url = `${this.baseUrl}/${this.resumeId}/profile`;

            // Add _method field for Laravel method spoofing (to support PUT with file upload)
            formData.append('_method', 'PUT');

            // Use fetch for file upload with FormData
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': this.csrfToken,
                    'Accept': 'application/json'
                },
                body: formData
            });

            const result = await response.json();

            if (!response.ok) {
                throw new Error(result.message || 'Profile update failed');
            }

            this.showNotification(result.message || 'Profile updated successfully', 'success');
            this.closeSidebar();
            setTimeout(() => window.location.reload(), 1000);
        } catch (error) {
            console.error('Error saving profile:', error);
            this.showNotification('Error: ' + error.message, 'error');
        }
    }

    /**
     * Update profile image - Redirects to comprehensive profile edit
     * @deprecated Use editProfile() for complete profile editing
     */
    editProfileImage() {
        // Redirect to comprehensive profile edit function
        this.editProfile();
    }

    /**
     * @deprecated No longer used - kept for backward compatibility
     */
    async saveProfileImage(formData) {
        // Redirect to main saveProfile function
        return await this.saveProfile(formData);
    }

    /**
     * ========================================
     * CONTACT CRUD OPERATIONS
     * ========================================
     */

    /**
     * Edit contact information
     */
    editContact() {
        // Get current contact data from DOM
        const emailElement = document.querySelector('[data-contact-email]');
        const phoneElement = document.querySelector('[data-contact-phone]');
        const websiteElement = document.querySelector('[data-contact-website]');
        const locationElement = document.querySelector('[data-contact-location]');
        const linkedinElement = document.querySelector('[data-contact-linkedin]');
        const githubElement = document.querySelector('[data-contact-github]');

        const contact = {
            email: emailElement?.dataset.contactEmail || emailElement?.textContent?.trim() || '',
            phone: phoneElement?.dataset.contactPhone || phoneElement?.textContent?.trim() || '',
            website: websiteElement?.dataset.contactWebsite || websiteElement?.textContent?.trim() || '',
            location: locationElement?.dataset.contactLocation || locationElement?.textContent?.trim() || '',
            linkedin: linkedinElement?.dataset.contactLinkedin || linkedinElement?.href || '',
            github: githubElement?.dataset.contactGithub || githubElement?.href || ''
        };

        const formHtml = `
            <form id="contactForm" class="edit-form">
                <div class="edit-form-group">
                    <label class="edit-form-label">Email *</label>
                    <input type="email" name="email" class="edit-form-input" value="${contact.email}" required>
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">Phone</label>
                    <input type="tel" name="phone" class="edit-form-input" value="${contact.phone}">
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">Website</label>
                    <input type="url" name="website" class="edit-form-input" value="${contact.website}">
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">Location</label>
                    <input type="text" name="location" class="edit-form-input" value="${contact.location}">
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">LinkedIn URL</label>
                    <input type="url" name="linkedin" class="edit-form-input" value="${contact.linkedin}">
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">GitHub URL</label>
                    <input type="url" name="github" class="edit-form-input" value="${contact.github}">
                </div>
                <div class="edit-form-actions">
                    <button type="submit" class="edit-btn-primary">Update Contact</button>
                    <button type="button" class="edit-btn-secondary" onclick="resumeEditor.closeSidebar()">Cancel</button>
                </div>
            </form>
        `;

        this.openSidebar('Edit Contact Information', formHtml);

        document.getElementById('contactForm').addEventListener('submit', (e) => {
            e.preventDefault();
            this.saveContact(new FormData(e.target));
        });
    }

    /**
     * Save contact information
     */
    async saveContact(formData) {
        const data = Object.fromEntries(formData.entries());

        try {
            const url = `${this.baseUrl}/${this.resumeId}/contact`;
            const result = await this.makeRequest(url, 'PUT', data);
            this.showNotification(result.message || 'Contact information updated successfully', 'success');
            this.closeSidebar();
            setTimeout(() => window.location.reload(), 1000);
        } catch (error) {
            console.error('Error saving contact:', error);
        }
    }

    /**
     * ========================================
     * ABOUT ME CRUD OPERATIONS
     * ========================================
     */

    /**
     * Edit about me section
     */
    editAbout() {
        // Get current about/summary data from DOM
        const aboutElement = document.querySelector('[data-about-summary]');
        const about = {
            summary: aboutElement?.dataset.aboutSummary || aboutElement?.textContent?.trim() || ''
        };

        const formHtml = `
            <form id="aboutForm" class="edit-form">
                <div class="edit-form-group">
                    <label class="edit-form-label">Professional Summary *</label>
                    <textarea name="summary" class="edit-form-textarea" rows="8" required>${about.summary}</textarea>
                    <small>Write a brief professional summary about yourself (2-3 paragraphs)</small>
                </div>
                <div class="edit-form-actions">
                    <button type="submit" class="edit-btn-primary">Update Summary</button>
                    <button type="button" class="edit-btn-secondary" onclick="resumeEditor.closeSidebar()">Cancel</button>
                </div>
            </form>
        `;

        this.openSidebar('Edit About Me', formHtml);

        document.getElementById('aboutForm').addEventListener('submit', (e) => {
            e.preventDefault();
            this.saveAbout(new FormData(e.target));
        });
    }

    /**
     * Save about me section
     */
    async saveAbout(formData) {
        const data = Object.fromEntries(formData.entries());

        try {
            const url = `${this.baseUrl}/${this.resumeId}/about`;
            const result = await this.makeRequest(url, 'PUT', data);
            this.showNotification(result.message || 'Summary updated successfully', 'success');
            this.closeSidebar();
            setTimeout(() => window.location.reload(), 1000);
        } catch (error) {
            console.error('Error saving about:', error);
        }
    }

    /**
     * ========================================
     * REFERENCE CRUD OPERATIONS
     * ========================================
     */

    /**
     * Add new reference
     */
    addReference() {
        const formHtml = `
            <form id="referenceForm" class="edit-form">
                <div class="edit-form-group">
                    <label class="edit-form-label">Reference Name *</label>
                    <input type="text" name="name" class="edit-form-input" required>
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">Position/Title *</label>
                    <input type="text" name="position" class="edit-form-input" required>
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">Company</label>
                    <input type="text" name="company" class="edit-form-input">
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">Phone</label>
                    <input type="tel" name="phone" class="edit-form-input">
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">Email</label>
                    <input type="email" name="email" class="edit-form-input">
                </div>
                <div class="edit-form-actions">
                    <button type="submit" class="edit-btn-primary">Save Reference</button>
                    <button type="button" class="edit-btn-secondary" onclick="resumeEditor.closeSidebar()">Cancel</button>
                </div>
            </form>
        `;

        this.openSidebar('Add Reference', formHtml);

        document.getElementById('referenceForm').addEventListener('submit', (e) => {
            e.preventDefault();
            this.saveReference(new FormData(e.target));
        });
    }

    /**
     * Edit existing reference
     */
    editReference(referenceId) {
        const referenceElement = document.querySelector(`[data-reference-id="${referenceId}"]`);
        if (!referenceElement) {
            this.showNotification('Reference not found', 'error');
            return;
        }

        const reference = {
            id: referenceId,
            name: referenceElement.dataset.name || '',
            position: referenceElement.dataset.position || '',
            company: referenceElement.dataset.company || '',
            phone: referenceElement.dataset.phone || '',
            email: referenceElement.dataset.email || ''
        };

        const formHtml = `
            <form id="referenceForm" class="edit-form">
                <input type="hidden" name="id" value="${reference.id}">
                <div class="edit-form-group">
                    <label class="edit-form-label">Reference Name *</label>
                    <input type="text" name="name" class="edit-form-input" value="${reference.name}" required>
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">Position/Title *</label>
                    <input type="text" name="position" class="edit-form-input" value="${reference.position}" required>
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">Company</label>
                    <input type="text" name="company" class="edit-form-input" value="${reference.company}">
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">Phone</label>
                    <input type="tel" name="phone" class="edit-form-input" value="${reference.phone}">
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">Email</label>
                    <input type="email" name="email" class="edit-form-input" value="${reference.email}">
                </div>
                <div class="edit-form-actions">
                    <button type="submit" class="edit-btn-primary">Update Reference</button>
                    <button type="button" class="edit-btn-secondary" onclick="resumeEditor.closeSidebar()">Cancel</button>
                </div>
            </form>
        `;

        this.openSidebar('Edit Reference', formHtml);

        document.getElementById('referenceForm').addEventListener('submit', (e) => {
            e.preventDefault();
            this.saveReference(new FormData(e.target), referenceId);
        });
    }

    /**
     * Save reference (create or update)
     */
    async saveReference(formData, referenceId = null) {
        const data = Object.fromEntries(formData.entries());

        try {
            let url, method;
            if (referenceId) {
                url = `${this.baseUrl}/${this.resumeId}/references/${referenceId}`;
                method = 'PUT';
            } else {
                url = `${this.baseUrl}/${this.resumeId}/references`;
                method = 'POST';
            }

            const result = await this.makeRequest(url, method, data);
            this.showNotification(result.message || 'Reference saved successfully', 'success');
            this.closeSidebar();
            setTimeout(() => window.location.reload(), 1000);
        } catch (error) {
            console.error('Error saving reference:', error);
        }
    }

    /**
     * Delete reference
     */
    async deleteReference(referenceId) {
        if (!confirm('Are you sure you want to delete this reference?')) {
            return;
        }

        try {
            const url = `${this.baseUrl}/${this.resumeId}/references/${referenceId}`;
            const result = await this.makeRequest(url, 'DELETE');
            this.showNotification(result.message || 'Reference deleted successfully', 'success');
            setTimeout(() => window.location.reload(), 1000);
        } catch (error) {
            console.error('Error deleting reference:', error);
        }
    }

    /**
     * ========================================
     * ACHIEVEMENT CRUD OPERATIONS
     * ========================================
     */

    /**
     * Add new achievement
     */
    addAchievement() {
        const formHtml = `
            <form id="achievementForm" class="edit-form">
                <div class="edit-form-group">
                    <label class="edit-form-label">Title *</label>
                    <input type="text" name="title" class="edit-form-input" required>
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">Issuer/Organization</label>
                    <input type="text" name="issuer" class="edit-form-input">
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">Date</label>
                    <input type="date" name="date" class="edit-form-input">
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">Description</label>
                    <textarea name="description" class="edit-form-textarea" rows="4"></textarea>
                </div>
                <div class="edit-form-actions">
                    <button type="submit" class="edit-btn-primary">Save Achievement</button>
                    <button type="button" class="edit-btn-secondary" onclick="resumeEditor.closeSidebar()">Cancel</button>
                </div>
            </form>
        `;

        this.openSidebar('Add Achievement', formHtml);

        // Handle form submission
        document.getElementById('achievementForm').addEventListener('submit', (e) => {
            e.preventDefault();
            const formData = new FormData(e.target);
            this.saveAchievement(Object.fromEntries(formData));
        });
    }

    /**
     * Edit existing achievement
     */
    editAchievement(achievementId) {
        // Find achievement data from DOM
        const achievementElement = document.querySelector(`[data-achievement-id="${achievementId}"]`);
        if (!achievementElement) {
            this.showNotification('Achievement not found', 'error');
            return;
        }

        const title = achievementElement.getAttribute('data-achievement-title') || '';
        const issuer = achievementElement.getAttribute('data-achievement-issuer') || '';
        const date = achievementElement.getAttribute('data-achievement-date') || '';
        const description = achievementElement.getAttribute('data-achievement-description') || '';

        const formHtml = `
            <form id="achievementForm" class="edit-form">
                <div class="edit-form-group">
                    <label class="edit-form-label">Title *</label>
                    <input type="text" name="title" class="edit-form-input" value="${title}" required>
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">Issuer/Organization</label>
                    <input type="text" name="issuer" class="edit-form-input" value="${issuer}">
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">Date</label>
                    <input type="date" name="date" class="edit-form-input" value="${date}">
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">Description</label>
                    <textarea name="description" class="edit-form-textarea" rows="4">${description}</textarea>
                </div>
                <div class="edit-form-actions">
                    <button type="submit" class="edit-btn-primary">Update Achievement</button>
                    <button type="button" class="edit-btn-secondary" onclick="resumeEditor.closeSidebar()">Cancel</button>
                </div>
            </form>
        `;

        this.openSidebar('Edit Achievement', formHtml);

        // Handle form submission
        document.getElementById('achievementForm').addEventListener('submit', (e) => {
            e.preventDefault();
            const formData = new FormData(e.target);
            this.saveAchievement(Object.fromEntries(formData), achievementId);
        });
    }

    /**
     * Save achievement (create or update)
     */
    async saveAchievement(formData, achievementId = null) {
        const url = achievementId
            ? `${this.baseUrl}/${this.resumeId}/achievements/${achievementId}`
            : `${this.baseUrl}/${this.resumeId}/achievements`;
        const method = achievementId ? 'PUT' : 'POST';

        try {
            const result = await this.makeRequest(url, method, formData);
            this.showNotification(result.message || 'Achievement saved successfully', 'success');
            this.closeSidebar();
            setTimeout(() => window.location.reload(), 1000);
        } catch (error) {
            console.error('Error saving achievement:', error);
        }
    }

    /**
     * Delete achievement
     */
    async deleteAchievement(achievementId) {
        if (!confirm('Are you sure you want to delete this achievement?')) {
            return;
        }

        try {
            const url = `${this.baseUrl}/${this.resumeId}/achievements/${achievementId}`;
            const result = await this.makeRequest(url, 'DELETE');
            this.showNotification(result.message || 'Achievement deleted successfully', 'success');
            setTimeout(() => window.location.reload(), 1000);
        } catch (error) {
            console.error('Error deleting achievement:', error);
        }
    }

    /**
     * ========================================
     * PASSION CRUD OPERATIONS
     * ========================================
     */

    /**
     * Add new passion
     */
    addPassion() {
        const formHtml = `
            <form id="passionForm" class="edit-form">
                <div class="edit-form-group">
                    <label class="edit-form-label">Title *</label>
                    <input type="text" name="title" class="edit-form-input" required placeholder="e.g., Music, Travel, Photography">
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">Description</label>
                    <textarea name="description" class="edit-form-textarea" rows="3"></textarea>
                </div>
                <div class="edit-form-actions">
                    <button type="submit" class="edit-btn-primary">Save Passion</button>
                    <button type="button" class="edit-btn-secondary" onclick="resumeEditor.closeSidebar()">Cancel</button>
                </div>
            </form>
        `;

        this.openSidebar('Add Passion', formHtml);

        // Handle form submission
        document.getElementById('passionForm').addEventListener('submit', (e) => {
            e.preventDefault();
            const formData = new FormData(e.target);
            this.savePassion(Object.fromEntries(formData));
        });
    }

    /**
     * Edit existing passion
     */
    editPassion(passionId) {
        // Find passion data from DOM
        const passionElement = document.querySelector(`[data-passion-id="${passionId}"]`);
        if (!passionElement) {
            this.showNotification('Passion not found', 'error');
            return;
        }

        const title = passionElement.getAttribute('data-passion-title') || '';
        const icon = passionElement.getAttribute('data-passion-icon') || '';
        const description = passionElement.getAttribute('data-passion-description') || '';

        const formHtml = `
            <form id="passionForm" class="edit-form">
                <div class="edit-form-group">
                    <label class="edit-form-label">Title *</label>
                    <input type="text" name="title" class="edit-form-input" value="${title}" required>
                </div>
                <div class="edit-form-group">
                    <label class="edit-form-label">Description</label>
                    <textarea name="description" class="edit-form-textarea" rows="3">${description}</textarea>
                </div>
                <div class="edit-form-actions">
                    <button type="submit" class="edit-btn-primary">Update Passion</button>
                    <button type="button" class="edit-btn-secondary" onclick="resumeEditor.closeSidebar()">Cancel</button>
                </div>
            </form>
        `;

        this.openSidebar('Edit Passion', formHtml);

        // Handle form submission
        document.getElementById('passionForm').addEventListener('submit', (e) => {
            e.preventDefault();
            const formData = new FormData(e.target);
            this.savePassion(Object.fromEntries(formData), passionId);
        });
    }

    /**
     * Save passion (create or update)
     */
    async savePassion(formData, passionId = null) {
        const url = passionId
            ? `${this.baseUrl}/${this.resumeId}/passions/${passionId}`
            : `${this.baseUrl}/${this.resumeId}/passions`;
        const method = passionId ? 'PUT' : 'POST';

        try {
            const result = await this.makeRequest(url, method, formData);
            this.showNotification(result.message || 'Passion saved successfully', 'success');
            this.closeSidebar();
            setTimeout(() => window.location.reload(), 1000);
        } catch (error) {
            console.error('Error saving passion:', error);
        }
    }

    /**
     * Delete passion
     */
    async deletePassion(passionId) {
        if (!confirm('Are you sure you want to delete this passion?')) {
            return;
        }

        try {
            const url = `${this.baseUrl}/${this.resumeId}/passions/${passionId}`;
            const result = await this.makeRequest(url, 'DELETE');
            this.showNotification(result.message || 'Passion deleted successfully', 'success');
            setTimeout(() => window.location.reload(), 1000);
        } catch (error) {
            console.error('Error deleting passion:', error);
        }
    }

    // ============================================
    // HIGHLIGHTS SECTION
    // ============================================

    /**
     * Add new highlight
     */
    addHighlight() {
        const form = `
            <form id="highlightForm">
                <div class="edit-form-group">
                    <label class="edit-form-label">Title *</label>
                    <input type="text" name="title" class="edit-form-input" required
                           placeholder="e.g., Strategic Vision, Client Relations">
                </div>

                <div class="edit-form-group">
                    <label class="edit-form-label">Description *</label>
                    <textarea name="description" class="edit-form-textarea" required
                              placeholder="Describe this highlight in detail..."
                              rows="4"></textarea>
                </div>

                <div class="edit-form-actions">
                    <button type="button" class="edit-btn-secondary" onclick="resumeEditor.closeSidebar()">Cancel</button>
                    <button type="submit" class="edit-btn-primary">Add Highlight</button>
                </div>
            </form>
        `;

        this.openSidebar('Add Highlight', form);

        document.getElementById('highlightForm').addEventListener('submit', (e) => {
            e.preventDefault();
            this.saveHighlight(new FormData(e.target));
        });
    }

    /**
     * Edit existing highlight
     */
    editHighlight(highlightId) {
        const highlightElement = document.querySelector(`[data-highlight-id="${highlightId}"]`);
        if (!highlightElement) return;

        const highlightData = {
            title: highlightElement.dataset.highlightTitle,
            description: highlightElement.dataset.highlightDescription
        };

        const form = `
            <form id="highlightForm">
                <div class="edit-form-group">
                    <label class="edit-form-label">Title *</label>
                    <input type="text" name="title" class="edit-form-input" required
                           value="${this.escapeHtml(highlightData.title)}"
                           placeholder="e.g., Strategic Vision, Client Relations">
                </div>

                <div class="edit-form-group">
                    <label class="edit-form-label">Description *</label>
                    <textarea name="description" class="edit-form-textarea" required
                              placeholder="Describe this highlight in detail..."
                              rows="4">${this.escapeHtml(highlightData.description)}</textarea>
                </div>

                <div class="edit-form-actions">
                    <button type="button" class="edit-btn-secondary" onclick="resumeEditor.closeSidebar()">Cancel</button>
                    <button type="submit" class="edit-btn-primary">Update Highlight</button>
                </div>
            </form>
        `;

        this.openSidebar('Edit Highlight', form);

        document.getElementById('highlightForm').addEventListener('submit', (e) => {
            e.preventDefault();
            this.saveHighlight(new FormData(e.target), highlightId);
        });
    }

    /**
     * Save highlight (create or update)
     */
    async saveHighlight(formData, highlightId = null) {
        const data = {
            title: formData.get('title'),
            description: formData.get('description')
        };

        try {
            const method = highlightId ? 'PUT' : 'POST';
            const url = highlightId
                ? `${this.baseUrl}/${this.resumeId}/highlights/${highlightId}`
                : `${this.baseUrl}/${this.resumeId}/highlights`;

            const result = await this.makeRequest(url, method, data);
            this.showNotification(result.message || 'Highlight saved successfully', 'success');
            this.closeSidebar();
            setTimeout(() => window.location.reload(), 1000);
        } catch (error) {
            console.error('Error saving highlight:', error);
        }
    }

    /**
     * Delete highlight
     */
    async deleteHighlight(highlightId) {
        if (!confirm('Are you sure you want to delete this highlight?')) {
            return;
        }

        try {
            const url = `${this.baseUrl}/${this.resumeId}/highlights/${highlightId}`;
            const result = await this.makeRequest(url, 'DELETE');
            this.showNotification(result.message || 'Highlight deleted successfully', 'success');
            setTimeout(() => window.location.reload(), 1000);
        } catch (error) {
            console.error('Error deleting highlight:', error);
        }
    }
}

// Initialize global resume editor instance
let resumeEditor;

// Auto-initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    // Get resume ID from meta tag or data attribute
    const resumeIdElement = document.querySelector('[data-resume-id]');
    if (resumeIdElement) {
        const resumeId = resumeIdElement.dataset.resumeId;
        resumeEditor = new ResumeEditor(resumeId);
        console.log('Resume Editor initialized for resume ID:', resumeId);
    }
});
