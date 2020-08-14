<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Session;

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
    protected $redirectTo = '/profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('web')->except('logout');
    }

    /**
     * Show the login form.
     * 
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.login',[
            'title' => 'User Login',
            'loginRoute' => 'login',
            'forgotPasswordRoute' => 'password.request',
        ]);
    }


    public function login(Request $request)
    {
       
     
        $this->validate($request, [
            'login'    => 'required',
            'password' => 'required',
        ]);
        
        $login_type = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL ) 
            ? 'email' 
            : 'username';

        $request->merge([
            $login_type => $request->input('login')
        ]);

        if (Auth::attempt($request->only($login_type, 'password'))) {
               
                $request->session()->regenerate();
                $previous_session = Auth::User()->session_id;
                if ($previous_session) {
                    Session::getHandler()->destroy($previous_session);
                }

                Auth::user()->session_id = Session::getId();
                Auth::user()->save();
             
                $user = auth()->guard('web')->user();
                $this->clearLoginAttempts($request);
                
                return response()->json([
                    'status'        => 'S',
                    'message' => 'Login Successfuly.'
                ], 201);

          }

        return response()->json([
                'status'        => 'F',
                'message' => 'Unauthorized - Password Not matched.'
            ], 401);




     } 

    public function logout(){
        Auth::logout();
         Auth::guard('web')->logout();
        return redirect('/')->with('status','User has been logged out!');
    }


}





