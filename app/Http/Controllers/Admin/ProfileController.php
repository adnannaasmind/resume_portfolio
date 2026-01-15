<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user(); // @phpstan-ignore-line
        return view('admin.profile', compact('user'));
    }

    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user(); // @phpstan-ignore-line

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'preferred_locale' => 'nullable|string',
            'timezone' => 'nullable|string',
        ]);

        $user->update($validated);

        return redirect()->route('admin.profile')
            ->with('success', 'Profile updated successfully');
    }

    public function passwordUpdate(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user(); // @phpstan-ignore-line

        $validated = $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($validated['current_password'], $user->password)) {
            return redirect()->route('admin.profile')
                ->with('error', 'Current password is incorrect');
        }

        $user->update([
            'password' => Hash::make($validated['password'])
        ]);

        return redirect()->route('admin.profile')
            ->with('success', 'Password updated successfully');
    }

    public function avatarUpdate(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user(); // @phpstan-ignore-line

        $validated = $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');

            // Delete old avatar if exists
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            $user->update(['avatar' => $path]);
        }

        return redirect()->route('admin.profile')
            ->with('success', 'Avatar updated successfully');
    }
}
