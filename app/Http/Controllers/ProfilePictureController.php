<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

define('PIC_HEADER', 'data:image/png;base64,');

function get_random_string($len) 
{
    $output = "";
    for($i = 0; $i < $len; $i++) {
        $curr = random_int(0, 255);
        $output .= chr($curr);
    }
    return $output;
}


function get_unique_name($ext, $curr_len=20) 
{
    
    for($iter = 0;; $iter++) {
        $str_token = get_random_string($curr_len++);
        $num_token = random_int(PHP_INT_MIN, PHP_INT_MAX);
        $now = time();
        $str = "$num_token$now$str_token$iter";
        $hash = sha1($str);
        $name = $hash . '.' . $ext;
        if(!Storage::disk('public')->exists($name)) {
            break;
        }
    }
    return $name;
}

class ProfilePictureController extends Controller
{


    public function set_profile_pic(Request $req)
    {
        
        $user = User::findOrFail(Auth::id());
        $this->remove_profile_pic();
        $base_64 = $req->image;
        if (substr_compare($base_64, PIC_HEADER, 0, 22) == 0) {
            $base_64 = str_replace(PIC_HEADER, '', $base_64);
            $image = base64_decode($base_64);
            $name = get_unique_name('png');
            
            Storage::disk('public')->put($name, $image);
            
            $user->profile_pic = $name;
            $user->save();
            $output = Redirect::to(route('settings:index'));
        } else {
            $output = abort(406);
        }
        return $output;
    }
    
    public function delete_profile_pic()
    {
        $this->remove_profile_pic();
        return Redirect::to(route('settings:index'));
    }

    function remove_profile_pic() 
    {
        $user = User::find(Auth::id());
        if($user->profile_pic) {
            Storage::disk('public')->delete($user->profile_pic);
            $user->profile_pic = "";
            $user->save();
        }
    }

}
