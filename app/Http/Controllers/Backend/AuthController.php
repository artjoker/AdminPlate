<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Rules\Backend\CheckRoleRule;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

/**
 * Class AuthController.
 */
class AuthController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected string $redirectTo = '/dashboard';

    /**
     * @var string
     */
    protected string $redirect_name = 'backend.dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->redirectTo = '/' . config('app.backend');
        $this->middleware('guest:admin')->except('logout');
    }

    /**
     * Show form for admins login.
     *
     * @return Factory|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|Redirector|RedirectResponse
     */
    public function showLoginForm()
    {
        if (auth('admin')->user()) {
            return redirect(route('backend.dashboard'));
        }

        return view('backend.auth.login');
    }

    /**
     * Login for admins.
     *
     * @param Request $request
     *
     * @throws \Illuminate\Validation\ValidationException
     * @return Redirector|RedirectResponse
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        if (Auth::guard('admin')
            ->attempt(
                [
                    'email'    => $request->email,
                    'password' => $request->password,
                    'active'   => 1,
                ],
                (bool)$request->remember
            )) {
            return redirect(route($this->redirect_name));
        }

        return back()->with('danger', __('backend.auth_failed'));
    }

    /**
     * Logout for admins.
     *
     * @param  Request          $request
     * @return RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        return redirect()->route('backend.login');
    }

    /**
     * Check activity and role for admin.
     * @param  Request                                    $request
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request): void
    {
        $username = $this->username();

        $rules = [
            $username => [
                'required',
                'exists:users,' . $username . ',active,1',
                new CheckRoleRule(),
                'password' => 'required',
            ],
        ];

        $errorMessages = [
            $username . '.exists' => __('backend.disabled_user'),
        ];

        $this->validate($request, $rules, $errorMessages);
    }
}
