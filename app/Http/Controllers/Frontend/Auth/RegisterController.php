<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Providers\RouteServiceProvider;
use App\Services\Base\Client\Dto\ClientDto;
use App\Services\Frontend\Client\ClientService;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

/**
 * Class RegisterController.
 */
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected string $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(private readonly ClientService $clientService)
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showRegistrationForm(): Renderable
    {
        return view('frontend.auth.register');
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return StatefulGuard
     */
    protected function guard(): StatefulGuard
    {
        return Auth::guard('web');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array<array-key, mixed> $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make(
            $data,
            [
                'first_name' => [
                    'required',
                    'string',
                    'max:255',
                ],
                'last_name'  => [
                    'required',
                    'string',
                    'max:255',
                ],
                'email'      => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    'unique:clients',
                ],
                'phone'      => [
                    'string',
                    'max:30',
                    'unique:clients',
                ],
                'password'   => [
                    'required',
                    'string',
                    'min:8',
                    'confirmed',
                ],
            ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array<array-key, mixed> $data
     *
     * @throws ValidationException
     * @return Client
     */
    protected function create(array $data): Client
    {
        /* @var Client $client */
        return $this->clientService->create(
            new ClientDto(
                ...$this->validator($data)
                    ->validated()
            )
        );
    }
}
