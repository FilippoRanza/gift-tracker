<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

define("PIC_PATH", join(DIRECTORY_SEPARATOR, array('static', 'image', 'profile')));

function get_picture_path($name) 
{
    return join(DIRECTORY_SEPARATOR, array(PIC_PATH, $name));
}


class ProfilePictureController extends Controller
{


    public function set_profile_pic(Request $req)
    {
        $this->validate($req,[
            'image' => 'required|image|mimes:jpeg,png,jpg,gif'
        ]);
        $user = User::findOrFail(Auth::id());
        $path = $req->image->store('', 'public');
        error_log($path);
        $user->profile_pic = $path;
        $user->save();
        return Redirect::to(route('settings:index'));
    }
    
    public function delete_profile_pic()
    {
        $user = User::find(Auth::id());
        if($user->profile_pic) {
            Storage::disk('public')->delete($user->profile_pic);
            $user->profile_pic = "";
            $user->save();
        }
        return Redirect::to(route('settings:index'));
    }

}
