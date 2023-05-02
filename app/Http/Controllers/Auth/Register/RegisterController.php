<?php

namespace App\Http\Controllers\Auth\Register;

use App\Core\Infra\IController;
use App\Core\Infra\Traits\AlertsUser;
use App\Core\Infra\Traits\HasGuardMethods;
use App\Core\Infra\Traits\HasValidator;
use App\Core\Infra\Traits\RedirectsUser;
use App\Domain\UseCases\User\CreateUser;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller implements IController
{
    use HasGuardMethods, HasValidator, RedirectsUser, AlertsUser;

    public function __construct(
        private readonly CreateUser $createUser
    )
    {
    }

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'photo' => 'image|mimes:jpeg,png,jpg|max:2048|nullable',
            'password' => 'required|string|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'password_confirmation' => 'required',
        ];
    }

    /**
     * @throws Exception
     */
    protected function create($data): User
    {
        // Creates a new user.
        $result = $this->createUser
            ->setArgs($data)
            ->execute();

        if ($result->isRejected()) {
            throw new Exception($result->getMessage());
        }

        return $result->get();
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request)
    {
        try {
            // Validates the request data.
            $raw = $this->validateWith($this->validator(
                $request->all('name', 'email', 'photo', 'password', 'password_confirmation')
            ));

            // Notifies listeners that a user has been registered.
            event(new Registered($this->create($raw)));

            // Alerts the user that a new verification link has been sent to his email address.
            $this->alertInfo('Registered successfully. A new verification link has been sent to your email address.');

            // Redirects the user to the login page.
            $return = redirect('login');
        } catch (ValidationException $e) {
            // Alerts the user that the form fields are invalid.
            $this->alertDanger('Please, check the form fields.');
            $return = back()->withErrors($e->validator->errors())->withInput();
        } catch (Exception $e) {
            // Alerts the user that an error has occurred.
            $this->alertDanger($e->getMessage());
            $return = back();
        }

        return $return;
    }
}
