<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use DB;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $membernumber = $request->input('email');

        if(strpos($membernumber, '@') !== false){
           $email = $membernumber;
        }else{
            $email = DB::table('memberprofiles')->where('member_no','=',$membernumber)->pluck('email_id')->first();
        }
        

        // Validate the form data
          $this->validate($request, [
            'email'   => 'required',
            'password' => 'required|min:6'
          ]);
          
          // Attempt to log the user in
          if (Auth::attempt(['email' => $email, 'password' => $request->password])) {
            // if successful, then redirect to their intended location
           
            if (auth()->user()->is_admin == 1) {
                return redirect()->route('admin.home');
            }else{
                return redirect()->route('home');
            }
          } 
          // if unsuccessful, then redirect back to the login with the form data
          return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    // public function login(Request $request)
    // {   
    //     $input = $request->all();

    //     $this->validate($request, [
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
    //     {
    //         if (auth()->user()->is_admin == 1) {
    //             return redirect()->route('admin.home');
    //         }else{
    //             return redirect()->route('home');
    //         }
    //     }else{
    //         return redirect()->route('login')
    //             ->with('error','Email-Address And Password Are Wrong.');
    //     }
        
    // }
}
