<?php

namespace App\Http\Controllers\Auth\Verification;

use App\Core\Infra\IController;
use App\Core\Infra\Traits\AlertsUser;
use App\Core\Infra\Traits\HasValidator;
use App\Core\Infra\Traits\RedirectsUser;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class VerificationController extends Controller implements IController
{
    use RedirectsUser, HasValidator, AlertsUser;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('handle');
        $this->middleware('throttle:6,1')->only('handle');
    }

    /**
     * The redirect route
     *
     * @return string
     */
    protected function redirectTo(): string
    {
        return route(RouteServiceProvider::HOME);
    }

    protected function rules(): array
    {
        return [
            'id' => 'required|integer',
            'hash' => 'required|string',
        ];
    }

    /**
     * @inheritDoc
     *
     * @throws AuthorizationException|ValidationException
     */
    public
    function handle(Request $request)
    {
        [$id, $hash] = $this->validateWith(
            $this->validator([
                'id' => $request->route('id'),
                'hash' => $request->route('hash')
            ])
        );

        $user = $request->user();

        if (!hash_equals($id, (string)$user->getKey())) {
            throw new AuthorizationException;
        }

        if (!hash_equals($hash, sha1($user->getEmailForVerification()))) {
            throw new AuthorizationException;
        }

        if ($user->hasVerifiedEmail()) {
            return redirect($this->redirectTo());
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        $this->alertInfo('Email verified successfully.');

        return redirect($this->redirectPath())->with('resent', true);
    }
}
