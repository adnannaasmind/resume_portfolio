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
            ['name' => 'Minimal Pro', 'category' => 'modern', 'is_premium' => false],
            ['name' => 'Corporate Clean', 'category' => 'corporate', 'is_premium' => false],
            ['name' => 'Creative Splash', 'category' => 'creative', 'is_premium' => true],
            ['name' => 'Technical Grid', 'category' => 'tech', 'is_premium' => true],
            ['name' => 'Elegant Serif', 'category' => 'modern', 'is_premium' => false],
            ['name' => 'Bold Blocks', 'category' => 'creative', 'is_premium' => true],
            ['name' => 'Executive Dark', 'category' => 'corporate', 'is_premium' => true],
            ['name' => 'Crisp Columns', 'category' => 'minimal', 'is_premium' => false],
        ];

        foreach ($templates as $template) {
            ResumeTemplate::updateOrCreate(
                ['slug' => Str::slug($template['name'])],
                [
                    'name' => $template['name'],
                    'preview_url' => '#',
                    'cover_image' => '#',
                    'description' => $template['name'].' template',
                    'is_premium' => $template['is_premium'],
                    'category' => $template['category'],
                    'metadata' => ['version' => 1],
                ]
            );
        }
    }
}
