<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class ResetPasswordController extends Controller
{
    public function reset_password(Request $req) {

        $user = User::find(Auth::id());
        $old = $req->old;
        $new = $req->password;
        $confirm = $req->confirm;
        if($new == $confirm) {
            if (Hash::check($old, $user->password)){
                $user->password = Hash::make($new);
                $user->save();
                $output = Redirect::to(route('settings:index'));
            } else {
                $output = Redirect::to(route('settings:index', ['password' => 'err']));;
            }    
        } else {
            $output = abort(404);
        }

        return $output;
    }
}
