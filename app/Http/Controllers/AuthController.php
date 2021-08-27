<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;


class AuthController extends Controller {

    public function index() {
        //
    } 

    //login
    public function login() {
        
        if(Auth::check()){
            return redirect("dashboard")->withSuccess('You are already logged in');
        }
        return view('auth.login');

    }  
    
    public function customLogin(Request $request) {

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('Logged in');
        }
  
        return redirect("login")->withSuccess('Login details are not valid');

    }

    //register
    public function register() {

        if(Auth::check()){
            return redirect("dashboard")->withSuccess('You are already logged in');
        }
        return view('auth.register');

    }
    
    public function customRegistration(Request $request) {  

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("dashboard")->withSuccess('You have signed-in');

    }

    //create user
    public function create(array $data) {

      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);

    }


    //forget password
    public function forgot() {

        if(Auth::check()){
            return redirect("dashboard")->withSuccess('You are already logged in');
        }
        return view('auth.forgot');

    }
    
    public function customForgot(Request $request) {  

        $request->validate([
            'email' => 'required|email',
        ]);

        $data = $request->all();
        $randpass = rand();
        $newpass = Hash::make($randpass);

        $findemail = DB::table('users')->where('email', $data['email'])->get();
        if( $findemail ){
            $userid = $findemail[0]->id;
            $update_pass = DB::table('users')->where('id', $userid)->update(['password' => $newpass]);
            echo "New password: ".$randpass;
        }
        
        // return redirect("forgot?success=1")->withSuccess('Email sent with required details');

    }
    
    //dashboard
    public function dashboard() {

        if(Auth::check()){
            return view('auth.dashboard');
        }
  
        return redirect("login")->withSuccess('You are not allowed to access');

    }   

    //logout
    public function logout() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}