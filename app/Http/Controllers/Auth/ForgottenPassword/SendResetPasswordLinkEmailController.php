<?php

namespace App\Http\Controllers\Auth\ForgottenPassword;

use App\Core\Infra\IController;
use App\Core\Infra\Traits\AlertsUser;
use App\Core\Infra\Traits\HasBrokerMethods;
use App\Core\Infra\Traits\HasGuardMethods;
use App\Core\Infra\Traits\HasValidator;
use App\Core\Infra\Traits\RedirectsUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class SendResetPasswordLinkEmailController extends Controller implements IController
{
    use HasGuardMethods, HasBrokerMethods, HasValidator, AlertsUser, RedirectsUser;

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

    protected function redirectTo(): string
    {
        return 'login';
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

    protected function sendResetLinkResponse(): JsonResponse|RedirectResponse
    {
        $this->alertInfo('Reset link sent. Check your email.');
        return redirect($this->redirectPath());
    }

    public function handle(Request $request): RedirectResponse
    {
        try {
            $this->validate($request, $this->rules());

            $response = $this->broker()->sendResetLink(
                $this->credentials($request)
            );

            $return = $response === Password::RESET_LINK_SENT
                ? $this->sendResetLinkResponse()
                : $this->sendResetLinkFailedResponse($request, $response);
        } catch (ValidationException $e) {
            $this->alertDanger('Validation error.');
            $return = back()->withErrors($e->errors());
        } catch (\Exception $e) {
            $this->alertDanger($e->getMessage());
            $return = back();
        }
        return $return;
    }
}
