<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;

//by me
use Illuminate\Http\Request;
use DB;
use Mail;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        

       /* return Validator::make($data, [
            'term' => ['required'],
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required', 'string', 'min:10','unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);*/
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    /*protected function create(array $data)
    {

      return User::create([
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'mobile' => $data['mobile'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

    
    }*/


    public function register(Request $request)
    {
       
        $ip =  $request->all();
       
        $this->validate($request, [
            'username' => ['required', 'unique:users', 'max:255'],
           // 'mobile' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
        ]);
        $user = User::create([
            'username'    => $ip['username'],
            'mobile'    => '',
            'email'     => $ip['email'],
            'password'  => Hash::make($ip['password']),
        ]);
        
        //SEND WELCOME EMAIL
        $uinfo = User::select('username')->where('username',$request->username)->first();
        Mail::send('emails.register',$ip,function($message) use ($ip)
        {
           $submsg = 'Welcome to Zhamber';
            $message->to($ip['email'])->subject($submsg);
        
        });

        auth()->login($user);


        return response()->json([
                    'status'        => 'S',
                    'message' => 'Login Successfuly.'
                ], 201);
         
    }



   



}
