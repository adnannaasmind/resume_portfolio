<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $defaults = [
            'smtp' => [
                'host' => 'smtp.example.com',
                'port' => 587,
                'username' => 'hello@example.com',
                'encryption' => 'tls',
            ],
            'payments' => [
                'currency' => 'USD',
                'invoice_prefix' => 'RS',
            ],
            'ai' => [
                'provider' => 'openai',
                'model' => config('services.openai.model'),
            ],
        ];

        foreach ($defaults as $group => $settings) {
            foreach ($settings as $key => $value) {
                Setting::updateOrCreate(
                    ['group' => $group, 'key' => $key],
                    ['value' => $value]
                );
            }
        }
    }
}
