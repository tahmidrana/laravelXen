<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function get_login()
    {
        return view('auth.login');
    }

    public function post_login(Request $request)
    {
        $resp = array('accessGranted' => false, 'errors' => '');

        $username = $request->username;
        $password = $request->passwd;
        //echo $password;

        //$user_res = DB::table('users')->where('userid', $username);
        
        if(Auth::attempt(['userid' => $username, 'password' => $password, 'status'=>1])) {
            $user = User::find(Auth::user()->id);
            $user->last_login = date('Y-m-d H:i:s');
            $user->save();

            /*$user_data = [
                'name' => Auth::user()->first_name.' '.Auth::user()->last_name,
                'user_id' => Auth::user()->id, 
                'username' => Auth::user()->username 
            ];*/

            $resp['accessGranted'] = true;
        } else {
            $resp['errors'] = '<strong>Invalid login!</strong><br />Please enter valid userid and password.<br />';
        }
        echo json_encode($resp);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        //return Redirect::back();
        return redirect('/login');
    }

}
