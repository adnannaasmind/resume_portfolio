<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    // System Settings
    public function system()
    {
        return view('admin.settings.system');
    }

    public function systemUpdate(Request $request)
    {
        $validated = $request->validate([
            'app_name' => 'required|string|max:255',
            'app_url' => 'required|url',
            'timezone' => 'required|string',
            'date_format' => 'required|string',
            'time_format' => 'required|string',
        ]);

        foreach ($validated as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return redirect()->route('admin.settings.system')
            ->with('success', 'System settings updated successfully');
    }

    // SMTP Settings
    public function smtp()
    {
        return view('admin.settings.smtp');
    }

    public function smtpUpdate(Request $request)
    {
        $validated = $request->validate([
            'mail_mailer' => 'required|string',
            'mail_host' => 'required|string',
            'mail_port' => 'required|integer',
            'mail_username' => 'required|string',
            'mail_password' => 'nullable|string',
            'mail_encryption' => 'required|in:tls,ssl',
            'mail_from_address' => 'required|email',
            'mail_from_name' => 'required|string',
        ]);

        foreach ($validated as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return redirect()->route('admin.settings.smtp')
            ->with('success', 'SMTP settings updated successfully');
    }

    // Payment Settings
    public function payment()
    {
        return view('admin.settings.payment');
    }

    public function paymentUpdate(Request $request)
    {
        $validated = $request->validate([
            'stripe_key' => 'nullable|string',
            'stripe_secret' => 'nullable|string',
            'paypal_mode' => 'required|in:sandbox,live',
            'paypal_client_id' => 'nullable|string',
            'paypal_secret' => 'nullable|string',
            'currency' => 'required|string|max:3',
        ]);

        foreach ($validated as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return redirect()->route('admin.settings.payment')
            ->with('success', 'Payment settings updated successfully');
    }

    // Website Settings
    public function website()
    {
        return view('admin.settings.website');
    }

    public function websiteUpdate(Request $request)
    {
        $validated = $request->validate([
            'site_title' => 'required|string|max:255',
            'site_description' => 'nullable|string',
            'site_keywords' => 'nullable|string',
            'logo' => 'nullable|string',
            'favicon' => 'nullable|string',
            'footer_text' => 'nullable|string',
            'contact_email' => 'required|email',
            'contact_phone' => 'nullable|string',
        ]);

        foreach ($validated as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return redirect()->route('admin.settings.website')
            ->with('success', 'Website settings updated successfully');
    }

    // Language Settings
    public function languages()
    {
        $languages = ['en' => 'English', 'es' => 'Spanish'];

        return view('admin.settings.languages', compact('languages'));
    }

    public function languagesUpdate(Request $request)
    {
        $validated = $request->validate([
            'default_language' => 'required|string',
            'available_languages' => 'required|array',
        ]);

        foreach ($validated as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => is_array($value) ? json_encode($value) : $value]);
        }

        return redirect()->route('admin.settings.languages')
            ->with('success', 'Language settings updated successfully');
    }

    // SEO Settings
    public function seo()
    {
        return view('admin.settings.seo');
    }

    public function seoUpdate(Request $request)
    {
        $validated = $request->validate([
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string|max:500',
            'meta_keywords' => 'nullable|string',
            'og_title' => 'nullable|string',
            'og_description' => 'nullable|string',
            'og_image' => 'nullable|string',
            'twitter_card' => 'nullable|string',
        ]);

        foreach ($validated as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return redirect()->route('admin.settings.seo')
            ->with('success', 'SEO settings updated successfully');
    }

    // About Settings
    public function about()
    {
        return view('admin.settings.about');
    }

    public function aboutUpdate(Request $request)
    {
        $validated = $request->validate([
            'about_title' => 'required|string|max:255',
            'about_description' => 'required|string',
            'mission' => 'nullable|string',
            'vision' => 'nullable|string',
            'team_info' => 'nullable|string',
        ]);

        foreach ($validated as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return redirect()->route('admin.settings.about')
            ->with('success', 'About settings updated successfully');
    }
}
