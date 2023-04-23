<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\ValidationException;

class ForgotPasswordController extends Controller
{
    use HasGuard, HasBroker;

    public function showLinkRequestForm(): \Illuminate\Contracts\View\View
    {
        return View::make('auth.passwords.email');
    }

    protected function credentials(Request $request): array
    {
        return $request->only('email');
    }

    protected function validateEmail(Request $request): void
    {
        $request->validate(['email' => 'required|email']);
    }

    /**
     * @throws ValidationException
     */
    protected function sendResetLinkFailedResponse(Request $request, $response): RedirectResponse
    {
        if ($request->wantsJson()) {
            throw ValidationException::withMessages([
                'email' => [trans($response)],
            ]);
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => trans($response)]);
    }

    protected function sendResetLinkResponse(Request $request, $response): JsonResponse|RedirectResponse
    {
        return $request->wantsJson()
            ? new JsonResponse(['message' => trans($response)], 200)
            : back()->with('status', trans($response));
    }

    /**
     * @throws ValidationException
     */
    public function sendResetLinkEmail(Request $request): RedirectResponse
    {
        $this->validateEmail($request);

        $response = $this->broker()->sendResetLink(
            $this->credentials($request)
        );

        return $response === Password::RESET_LINK_SENT
            ? $this->sendResetLinkResponse($request, $response)
            : $this->sendResetLinkFailedResponse($request, $response);
    }
}
