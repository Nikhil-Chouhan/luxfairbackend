<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // custom logout function
    // redirect to login page
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new Response('', 204)
            : redirect('/login');
    }

    
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // if the user has been authenticated
        if ($this->attemptLogin($request)) {
            // get the authenticated user
            $user = $this->guard()->user();
            // check if the user is active
            if ($user->status == 1) {
                // if the user is active then redirect to the intended location
                return $this->sendLoginResponse($request);
            } else {
                // if the user is not active then logout the user
                $this->guard()->logout();
                // redirect the user to the login page with the error message
                return redirect('/login')->withErrors(['email' => 'Your account is not active.']);
            }
        }

        // if the user has not been authenticated
        return $this->sendFailedLoginResponse($request);
    }

}
