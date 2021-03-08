<?php

namespace App\Http\Controllers;

use App\User;
use App\GiftList;
use App\ItemList;
use App\ListGuest;
use Illuminate\Http\Request;

class DynamicUserAdd extends Controller
{
    public function list_users_by_key(Request $req) {
        $begin = $req->current;
        $len = strlen($begin);
        $users = User::all(); 

        $owner = $this->get_list_owner($req->list_id);
        $guests = $this->list_members($req->list_id);
       
        $name_list = [];
        foreach($users as $user) {
            if(($user->id == $owner) or array_key_exists($user->id, $guests)){
                continue;
            }
            $head = substr($user->name, 0, $len);
            if($head === $begin) {
                $name_list[] = $user->name;
            }
        }
        
        $output = ['names' => $name_list];
        return response()->json($output);
    }


    function get_list_owner($list_id) {
        $list = GiftList::find($list_id);
        $owner_id = $list->owner;
        return $owner_id;
    }

    function list_members($list_id) {
        $guests = ListGuest::where('list_id', $list_id)->get('user_id');
        $guest_id = [];
        foreach($guests as $guest) {
            $guest_id[$guest->user_id] = 1;
        }
        return $guest_id;
    }


}
