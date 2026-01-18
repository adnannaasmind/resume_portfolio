<?php

namespace Database\Seeders;

use App\Models\ResumeTemplate;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ResumeTemplateSeeder extends Seeder
{
    public function run(): void
    {
        $templates = [
            [
                'id' => 1,
                'name' => 'Modern Free',
                'slug' => 'modern-free',
                'blade_file' => 'admin.resume_templates.template_free',
                'category' => 'modern',
                'is_premium' => false,
                'preview_image' => 'templates/previews/template_free.jpg',
                'description' => 'Modern sidebar free template',
            ],
            [
                'id' => 2,
                'name' => 'Premium Executive',
                'slug' => 'premium-executive',
                'blade_file' => 'admin.resume_templates.template_premium',
                'category' => 'corporate',
                'is_premium' => true,
                'preview_image' => 'templates/previews/template_premium.jpg',
                'description' => 'Premium executive professional template',
            ],
        ];

        foreach ($templates as $template) {
            ResumeTemplate::updateOrCreate(
                ['id' => $template['id']],
                $template
            );
        }
    }
}
