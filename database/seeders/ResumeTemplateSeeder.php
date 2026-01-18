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
            ['name' => 'Minimal Pro', 'category' => 'modern', 'is_premium' => false, 'layout' => 'minimal'],
            ['name' => 'Corporate Clean', 'category' => 'corporate', 'is_premium' => false, 'layout' => 'corporate'],
            ['name' => 'Creative Splash', 'category' => 'creative', 'is_premium' => true, 'layout' => 'creative'],
            ['name' => 'Technical Grid', 'category' => 'tech', 'is_premium' => true, 'layout' => 'technical'],
            ['name' => 'Elegant Serif', 'category' => 'modern', 'is_premium' => false, 'layout' => 'elegant'],
            ['name' => 'Bold Blocks', 'category' => 'creative', 'is_premium' => true, 'layout' => 'bold'],
            ['name' => 'Executive Dark', 'category' => 'corporate', 'is_premium' => true, 'layout' => 'executive'],
            ['name' => 'Crisp Columns', 'category' => 'minimal', 'is_premium' => false, 'layout' => 'columns'],
            ['name' => 'Classic Timeline', 'category' => 'classic', 'is_premium' => false, 'layout' => 'timeline'],
            ['name' => 'Modern Sidebar', 'category' => 'modern', 'is_premium' => true, 'layout' => 'sidebar'],
        ];

        foreach ($templates as $template) {
            ResumeTemplate::updateOrCreate(
                ['slug' => Str::slug($template['name'])],
                [
                    'name' => $template['name'],
                    'preview_url' => $template['preview_url'] ?? '#',
                    'cover_image' => $template['cover_image'] ?? null,
                    'description' => $template['name'].' template',
                    'is_premium' => $template['is_premium'],
                    'category' => $template['category'],
                    'metadata' => [
                        'version' => 1,
                        'layout' => $template['layout'],
                        'accent_color' => $template['accent_color'] ?? null,
                    ],
                ]
            );
        }
    }
}
