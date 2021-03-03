<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

define("RIDEF_NAME", 1);
define("RIDEF_EMAIL", 2);
define("CORRECT", 0);

class LoginRegisterManager extends Controller
{
    public function login_page() {
        return view('public.login');
    }
    public function login_action(Request $req) {
        return $this->run_login($req);
    }

    public function register_page() {
        return view('public.register');
    }
    public function register_action(Request $req) {
        
        if($req->password == $req->confirm) {
            $status = $this->check_account_info($req->name, $req->email);
            if ($status == CORRECT) {
                $new_user = new User();
                $new_user->name = $req->name;
                $new_user->email = $req->email;
                $new_user->password = Hash::make($req->password);
                $new_user->save();
                
                $output = $this->run_login($req);
            } elseif ($status == RIDEF_NAME) {
                $output = view('public.register', ['username_error' => $req->name]);
            } elseif ($status == RIDEF_EMAIL) {
                $output = view('public.register', ['email_error' => $req->email]);
            }

        } else {
            $output = view('public.register', ['password_error' => true]);
        }
        

        return $output;
    }
    

    public function logout() {
        if(Auth::check()) {
            Auth::logout();
        }
        return Redirect::to(route('login'));
    }

    function check_account_info($name, $email) {
        if (! $this->check_user($name)) {
            return RIDEF_NAME;
        } elseif (! $this->check_email($email)) {
            return RIDEF_EMAIL;
        } else {
            return CORRECT;
        }
    }

    function check_user($name) {
        $n = User::all()->where('name', $name);
        return ($n->count() == 0);
    }

    function exist_user($name) {
        $n = User::all()->where('name', $name);
        return ($n->count() == 1);
    }

    function check_email($email) {
        $e = User::all()->where('email', $email);
        return ($e->count() == 0);
    }

    function run_login(Request $req) {
        if($this->exist_user($req->name)) {
            $credentials = $req->only('name', 'password');
            if (Auth::attempt($credentials)) {
                $output = Redirect::to(route('user:home'));
            } else {
                $output = view('public.login', ['password_error' => true]);
            }
        }else {
            $output = view('public.login', ['username_error' => $req->name]);
        }
        return $output;
    }

}
