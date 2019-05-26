<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Contracts\Auth\Guard;
use Auth;
use Illuminate\Http\Request;
use Session;
use App\Employee;
use Illuminate\Support\Facades\Hash;

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
    protected $redirectTo = '/user';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function signIn(){
        return view("auth.login");
    }

    protected function authenticated(Request $request, $user){
    /*if ( $user->isAdmin() ) {
        return redirect()->route('user');
    }*/

     return redirect('/user');
    }

    public function login(Request $request){
        if(Auth::user() != NULL)
            return redirect('/payroll');
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            if(Auth::user()->auth_type == 0){
                return redirect()->intended('/user');
            } else {
                return redirect()->intended('/payroll/user');
            }
            
        } else {
            $error = "Please make sure email and password.";
            return view('auth.login', compact('error'));
        }
        exit();
    }
    public function logout(){
        Auth::logout();
        return redirect('/signin');
    }
}
