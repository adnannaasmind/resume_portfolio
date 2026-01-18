<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserProfile;
use App\Models\Resume;
use App\Models\ResumeTemplate;
use App\Models\ResumeEducation;
use App\Models\ResumeExperience;
use App\Models\ResumeSkill;
use App\Models\ResumeProject;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TemplateDemoDataSeeder extends Seeder
{
    public function run(): void
    {
        $templates = $this->getTemplateData();

        foreach ($templates as $templateId => $data) {
            $template = ResumeTemplate::find($templateId);

            if (!$template) {
                continue;
            }

            // Create demo user for this template
            $user = User::firstOrCreate(
                ['email' => $data['user']['email']],
                [
                    'name' => $data['user']['name'],
                    'password' => Hash::make('password'),
                ]
            );

            // Create user profile
            UserProfile::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'phone' => $data['profile']['phone'],
                    'location' => $data['profile']['address'],
                    'summary' => $data['profile']['bio'] ?? null,
                ]
            );

            // Create resume
            $resume = Resume::firstOrCreate(
                [
                    'user_id' => $user->id,
                    'resume_template_id' => $template->id,
                ],
                [
                    'title' => $data['resume']['title'],
                    'data' => [
                        'summary' => $data['resume']['summary'],
                    ],
                    'is_public' => true,
                    'slug' => \Illuminate\Support\Str::slug($data['resume']['title']) . '-' . $user->id,
                    'share_token' => \Illuminate\Support\Str::random(32),
                ]
            );

            // Clear existing data for this resume
            $resume->experiences()->delete();
            $resume->educations()->delete();
            $resume->skills()->delete();
            $resume->projects()->delete();

            // Add experiences
            foreach ($data['experiences'] as $experience) {
                ResumeExperience::create([
                    'resume_id' => $resume->id,
                    'title' => $experience['job_title'],
                    'company' => $experience['company'],
                    'start_date' => $experience['start_date'],
                    'end_date' => $experience['end_date'],
                    'description' => $experience['description'],
                    'is_current' => $experience['is_current'] ?? false,
                ]);
            }

            // Add education
            foreach ($data['education'] as $education) {
                ResumeEducation::create([
                    'resume_id' => $resume->id,
                    'degree' => $education['degree'],
                    'institution' => $education['institution'],
                    'start_date' => $education['start_date'],
                    'end_date' => $education['end_date'],
                    'description' => $education['description'] ?? null,
                ]);
            }

            // Add skills
            foreach ($data['skills'] as $skillName) {
                ResumeSkill::create([
                    'resume_id' => $resume->id,
                    'name' => $skillName,
                    'level' => 'Advanced',
                ]);
            }

            // Add projects (if any)
            if (isset($data['projects'])) {
                foreach ($data['projects'] as $project) {
                    ResumeProject::create([
                        'resume_id' => $resume->id,
                        'name' => $project['title'],
                        'description' => $project['description'],
                        'url' => $project['url'] ?? null,
                        'role' => $project['role'] ?? null,
                    ]);
                }
            }

            $this->command->info("Demo data created for Template ID: {$templateId} - {$template->name}");
        }
    }

    private function getTemplateData(): array
    {
        return [
            // Template 1: Minimal Pro - Free Template
            1 => [
                'user' => [
                    'name' => 'Lisa Brown',
                    'email' => 'lisa.brown@example.com',
                ],
                'profile' => [
                    'phone' => '+1 617-555-0155',
                    'address' => 'Boston, MA 02108',
                    'city' => 'Boston',
                    'country' => 'USA',
                    'bio' => 'HR Manager specializing in talent acquisition and employee development.',
                ],
                'resume' => [
                    'title' => 'Human Resources Manager',
                    'summary' => 'Strategic HR professional with 12+ years of experience in talent management, organizational development, and employee relations. SHRM-certified with expertise in building high-performing teams.',
                ],
                'experiences' => [
                    [
                        'job_title' => 'HR Manager',
                        'company' => 'Tech Innovations Inc.',
                        'location' => 'Boston, MA',
                        'start_date' => '2019-01-01',
                        'end_date' => null,
                        'description' => 'Oversee all HR functions for 200+ employees. Reduced turnover by 30% through enhanced retention programs. Implemented new HRIS system improving efficiency by 40%.',
                        'is_current' => true,
                    ],
                    [
                        'job_title' => 'HR Specialist',
                        'company' => 'Healthcare Solutions',
                        'location' => 'Boston, MA',
                        'start_date' => '2014-06-01',
                        'end_date' => '2018-12-31',
                        'description' => 'Managed recruitment for multiple departments. Developed onboarding program that improved new hire satisfaction by 45%.',
                        'is_current' => false,
                    ],
                ],
                'education' => [
                    [
                        'degree' => 'Master of Human Resource Management',
                        'institution' => 'Boston University',
                        'location' => 'Boston, MA',
                        'start_date' => '2012-09-01',
                        'end_date' => '2014-05-31',
                    ],
                ],
                'skills' => [
                    'Talent Acquisition',
                    'Employee Relations',
                    'Performance Management',
                    'HRIS Systems',
                    'Compensation & Benefits',
                    'Training & Development',
                    'Labor Law Compliance',
                ],
            ],

            // Template 2: Modern Sidebar - Premium Template
            2 => [
                'user' => [
                    'name' => 'James Taylor',
                    'email' => 'james.taylor@example.com',
                ],
                'profile' => [
                    'phone' => '+1 206-555-0144',
                    'address' => 'Seattle, WA 98101',
                    'city' => 'Seattle',
                    'country' => 'USA',
                    'bio' => 'DevOps Engineer passionate about automation and cloud infrastructure.',
                ],
                'resume' => [
                    'title' => 'Senior DevOps Engineer',
                    'summary' => 'AWS-certified DevOps Engineer with 9+ years of experience designing and implementing CI/CD pipelines, infrastructure as code, and cloud-native solutions. Expert in Kubernetes, Docker, and automation tools.',
                ],
                'experiences' => [
                    [
                        'job_title' => 'Senior DevOps Engineer',
                        'company' => 'Cloud Systems Pro',
                        'location' => 'Seattle, WA',
                        'start_date' => '2020-02-01',
                        'end_date' => null,
                        'description' => 'Architected and deployed microservices infrastructure on AWS serving 5M+ users. Reduced deployment time by 70% through automation. Managed $2M cloud infrastructure budget.',
                        'is_current' => true,
                    ],
                    [
                        'job_title' => 'DevOps Engineer',
                        'company' => 'Software Development Corp',
                        'location' => 'Seattle, WA',
                        'start_date' => '2016-08-01',
                        'end_date' => '2020-01-31',
                        'description' => 'Implemented CI/CD pipelines using Jenkins and GitLab. Containerized 50+ applications using Docker and Kubernetes.',
                        'is_current' => false,
                    ],
                ],
                'education' => [
                    [
                        'degree' => 'Bachelor of Science in Information Technology',
                        'institution' => 'University of Washington',
                        'location' => 'Seattle, WA',
                        'start_date' => '2012-09-01',
                        'end_date' => '2016-06-30',
                    ],
                ],
                'skills' => [
                    'AWS & Azure',
                    'Kubernetes & Docker',
                    'Terraform & Ansible',
                    'CI/CD Pipelines',
                    'Linux System Administration',
                    'Python & Bash',
                    'Monitoring & Logging',
                ],
            ],
        ];
    }
}
