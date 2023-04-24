<?php

namespace App\Http\Controllers\Auth\ForgottenPassword;

use App\Core\Infra\IController;
use App\Http\Controllers\Auth\HasBrokerMethods;
use App\Http\Controllers\Auth\HasGuardMethods;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class SendResetPasswordLinkEmailController extends Controller implements IController
{
    use HasGuardMethods, HasBrokerMethods;

    protected function credentials(Request $request): array
    {
        return $request->only('email');
    }

    protected function rules(): array
    {
        return [
            'email' => 'required|email',
        ];
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
    public function handle(Request $request): RedirectResponse
    {
        $this->validate($request, $this->rules());

        $response = $this->broker()->sendResetLink(
            $this->credentials($request)
        );

        return $response === Password::RESET_LINK_SENT
            ? $this->sendResetLinkResponse($request, $response)
            : $this->sendResetLinkFailedResponse($request, $response);
    }
}
