<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class LoginRegisterManager extends Controller
{
    public function login_page() {
        return view('login.login');
    }
    public function login_action(Request $req) {
        return $this->run_login($req);
    }

    public function register_page() {
        return view('login.register');
    }
    public function register_action(Request $req) {
        
        if($req->password == $req->confirm) {
            if ($this->check_user($req->name, $req->email)) {
                $new_user = new User();
                $new_user->name = $req->name;
                $new_user->email = $req->email;
                $new_user->password = Hash::make($req->password);
                $new_user->save();
                
                $output = $this->run_login($req);
            } else {
                $output = view('login.register', ['username_error' => $req->name]);
            }

        } else {
            $output = view('login.register', ['password_error' => true]);
        }
        

        return $output;
    }


    public function logout() {
        if(Auth::check()) {
            Auth::logout();
        }
        return Redirect::to(route('login'));
    }


    function check_user($name, $email) {
        $n = User::all()->where('name', $name);
        $e = User::all()->where('email', $email);
        return ($n->count() == 0) && ($e->count() == 0);
    }

    function run_login(Request $req) {
        $credentials = $req->only('name', 'password');
        if (Auth::attempt($credentials)) {
            $output = Redirect::to(route('user:home'));
        } else {
            $output = view('login.login', ['login_error' => true]);
        }
        return $output;
    }

}
