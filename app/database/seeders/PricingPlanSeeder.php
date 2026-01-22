<?php

namespace Database\Seeders;

use App\Models\PricingPlan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PricingPlanSeeder extends Seeder
{
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Free',
                'price' => 0,
                'features' => ['1 resume', 'Watermarked PDF', 'Basic templates'],
                'resume_limit' => 1,
                'template_limit' => 2,
                'ai_credits' => 0,
            ],
            [
                'name' => 'Pro',
                'price' => 19,
                'features' => ['Unlimited resumes', 'Premium templates', 'AI cover letters'],
                'resume_limit' => 50,
                'template_limit' => 10,
                'ai_credits' => 50,
                'is_featured' => true,
            ],
            [
                'name' => 'Business',
                'price' => 39,
                'features' => ['Team collaboration', 'Portfolio analytics', 'Priority support'],
                'resume_limit' => 200,
                'template_limit' => 20,
                'ai_credits' => 200,
            ],
        ];

        foreach ($plans as $plan) {
            PricingPlan::updateOrCreate(
                ['slug' => Str::slug($plan['name'])],
                array_merge([
                    'currency' => 'USD',
                    'interval' => 'monthly',
                    'is_active' => true,
                ], $plan)
            );
        }
    }
}
