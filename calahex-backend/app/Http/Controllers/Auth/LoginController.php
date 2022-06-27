<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Http;
use App\Providers\RouteServiceProvider;
use App\Services\PoloniexService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;

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

    // public function __construct(DoctorProfileRepository $doctorProfileRepository)
    // {
    //     $this->doctorProfileRepository = $doctorProfileRepository;
    // }
    protected function authenticated(Request $request, $user)
    {
        // dd(Auth::user());
        if (Auth::user()->id != 1) {
            $this->logout($request);
        }

    }
    // protected function attemptLogin(Request $request)
    // {
    //     dd(Auth::user());
    //     return $this->guard()->attempt(
    //         $this->credentials($request), $request->filled('remember')
    //     );
    // }
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }
}
