<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
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

    protected function redirectTo()
    {    
        if(Auth::user()->role == 'admin') {
            return '/admin-dashboard';
        } elseif(Auth::user()->role == 'lodging') {
            return '/glamping';
        } elseif(Auth::user()->role == 'cashier') {
            return '/start-shift';
        } else {
            return '/logout'; 
        }
 
    }
   // protected $redirectTo = '/glamping';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
      }
}
