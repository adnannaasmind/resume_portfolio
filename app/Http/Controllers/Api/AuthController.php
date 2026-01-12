<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class AuthController extends BaseApiController
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role' => 'user',
            'preferred_locale' => 'en',
        ]);

        UserProfile::create([
            'user_id' => $user->id,
        ]);

        $deviceName = $request->header('X-Device-Name', 'Unknown Device');
        $deviceId = $request->header('X-Device-ID');
        
        $token = $user->createToken($deviceName, ['*'], $deviceId ? ['device_id' => $deviceId] : [])->plainTextToken;

        return $this->created([
            'token' => $token,
            'user' => $user->load('profile'),
        ], 'Registration successful');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => ['Invalid credentials.'],
            ]);
        }

        /** @var User $user */
        $user = Auth::user();
        $user->update(['last_login_at' => now()]);

        $deviceName = $request->header('X-Device-Name', 'Unknown Device');
        $deviceId = $request->header('X-Device-ID');
        
        $token = $user->createToken($deviceName, ['*'], $deviceId ? ['device_id' => $deviceId] : [])->plainTextToken;

        return $this->success([
            'token' => $token,
            'user' => $user->load('profile'),
        ], 'Login successful');
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()?->delete();

        return $this->success(null, 'Logged out successfully');
    }

    public function me(Request $request)
    {
        return $this->success($request->user()->load(['profile', 'subscription.plan']));
    }

    public function updateProfile(Request $request)
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'headline' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'company' => ['nullable', 'string', 'max:255'],
            'website' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'summary' => ['nullable', 'string'],
            'social_links' => ['nullable', 'array'],
            'skills' => ['nullable', 'array'],
        ]);

        /** @var User $user */
        $user = $request->user();

        if (isset($data['name'])) {
            $user->name = $data['name'];
            $user->save();
        }

        $profileData = collect($data)->except('name')->toArray();

        $user->profile()->updateOrCreate(['user_id' => $user->id], $profileData);

        return $this->success($user->load('profile'), 'Profile updated successfully');
    }

    public function updatePreferences(Request $request)
    {
        $data = $request->validate([
            'preferred_locale' => ['nullable', 'in:en,es'],
            'timezone' => ['nullable', 'string', 'max:100'],
            'avatar_url' => ['nullable', 'string', 'max:500'],
            'password' => ['nullable', 'confirmed', 'min:8'],
        ]);

        /** @var User $user */
        $user = $request->user();

        $update = collect($data)->except('password')->filter(fn ($value) => !is_null($value))->toArray();

        if ($update) {
            $user->update($update);
        }

        if (!empty($data['password'])) {
            $user->update(['password' => Hash::make($data['password'])]);
        }

        return $this->success($user->fresh(), 'Preferences updated successfully');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => ['required', 'email']]);

        $status = Password::sendResetLink($request->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            return $this->success(null, 'Password reset link sent to your email');
        }

        return $this->error('Unable to send reset link', 400);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password): void {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status !== Password::PASSWORD_RESET) {
            return $this->error(__($status), 400);
        }

        return $this->success(null, 'Password reset successfully');
    }
}
