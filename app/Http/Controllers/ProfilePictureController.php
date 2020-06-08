<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

require 'picture_helper.php';

class ProfilePictureController extends Controller
{

    public function set_profile_pic(Request $req)
    {
        $user = User::findOrFail(Auth::id());
        $base_64 = $req->image;
        $name = save_image($base_64, $user->profile_pic);
        $user->profile_pic = $name;
        $user->save();
        return response()->json(['update' => true, 'picture' => $name]);
    }
    
    public function delete_profile_pic()
    {        
        $user = User::find(Auth::id());
        if(remove_image($user->profile_pic)) {
            $user->profile_pic = "";
            $user->save();
        }
        return response()->json(['update' => true]);
    }
}
