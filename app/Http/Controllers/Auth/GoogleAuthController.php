<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse as SymfonyRedirectResponse;

class GoogleAuthController extends Controller
{
    /**
     * Redirect to Google OAuth.
     */
    public function redirect(): SymfonyRedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle Google OAuth callback.
     */
    public function callback(): RedirectResponse
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('login')
                ->with('error', 'Failed to authenticate with Google. Please try again.');
        }

        // Check if user exists by google_id
        $user = User::where('google_id', $googleUser->getId())->first();

        if ($user) {
            // Update avatar if changed
            if ($googleUser->getAvatar() && $user->google_avatar !== $googleUser->getAvatar()) {
                $user->update(['google_avatar' => $googleUser->getAvatar()]);
            }

            return $this->loginUser($user);
        }

        // Check if user exists by email
        $user = User::where('email', $googleUser->getEmail())->first();

        if ($user) {
            // Link Google account to existing user
            $user->update([
                'google_id' => $googleUser->getId(),
                'google_avatar' => $googleUser->getAvatar(),
            ]);

            return $this->loginUser($user);
        }

        // Create new user
        $user = User::create([
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'google_id' => $googleUser->getId(),
            'google_avatar' => $googleUser->getAvatar(),
            'email_verified_at' => now(),
            'password' => null,
        ]);

        return $this->loginUser($user);
    }

    /**
     * Login the user and handle 2FA if enabled.
     */
    protected function loginUser(User $user): RedirectResponse
    {
        // Check if user has 2FA enabled
        if ($user->hasTwoFactorEnabled()) {
            session(['2fa:user:id' => $user->id]);

            return redirect()->route('two-factor.challenge');
        }

        Auth::login($user, remember: true);

        return redirect()->intended(route('home'));
    }
}
