<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

/**
 * VerifyEmailController handles the email verification process for authenticated users.
 * 
 * Responsibilities:
 * - Marks the user's email as verified if it is not already.
 * - Triggers the Verified event upon successful verification.
 * - Redirects the user to the dashboard with a verification status indicator.
 */
class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param EmailVerificationRequest $request The request containing the email verification details.
     * 
     * @return RedirectResponse Redirects the user to the dashboard.
     * 
     * Behavior:
     * - If the email is already verified, redirects immediately.
     * - If verification succeeds, triggers the Verified event and redirects.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        // Check if the user's email is already verified
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
        }

        // Mark the email as verified and trigger the Verified event
        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        // Redirect to the dashboard with a verification status indicator
        return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
    }
}
