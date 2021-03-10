<?php

namespace App\Http\Controllers;

use App\GiftList;
use App\Item;
use App\ItemList;
use App\ListGuest;
use App\Purchase;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

include_once 'list_helper.php';

class GuestListInfo {
    function __construct($list_name, $list_id, $list_owner, $poll)
    {   
        $this->name = $list_name;
        $this->id = $list_id;
        $this->owner = $list_owner;
        $this->poll = $poll;
    }
}

class OldListRecap 
{
    function __construct($owner, $buyer, $date, $name, $price, $guests)
    {
        $this->owner = $owner;
        $this->buyer = $buyer;
        $this->date = $date;
        $this->name = $name;
        $this->price = $price;
        $this->guests = $guests;
    }
}


class GiftListController extends Controller
{
    public function home() {
        return $this->user_list_home();
    }

    public function add_list(Request $req) {
        if ($this->check_unique($req->name)) {
            $list = new GiftList();
            $list->owner =  Auth::id();
            $list->name = $req->name;
            $list->done = false;
            $list->guest_only = false;
            
            $list->duplicated = $this->dup;
            $list->save();
            $output = Redirect::to(route('list:manage', ['id' => $list->id]));
        } else {
            $output = $this->user_list_home($req->name);
        }
        return $output;
    }

    public function manage_list(Request $req) {
        return $this->user_list_manage($req->id);
    }

    public function insert_item(Request $req) {
        if(check_unique_item($req->name, $req->list)) {
            $item = new Item();
            $item->name = $req->name;
            $amount = $req->price;
            $item->price = $amount * 100;
            $item->save();

            $item_list = new ItemList();
            $item_list->list_id = $req->list;
            $item_list->item_id = $item->id;
            $item_list->save();
            $output = Redirect::to(route('list:manage', ['id' => $req->list]));        
        } else {
            $output = $this->user_list_manage($req->list, $req->name);
        }
        return $output;
    }

    public function add_guest(Request $req) {
        $name = $req->name;
        $guest = User::all()->where('name', $name)->first();
        if(isset($guest)) {
            if($this->check_unique_guest($guest->id, $req->list)) {
                $list_guest = new ListGuest();
                $list_guest->list_id = $req->list;
                $list_guest->user_id = $guest->id;
                $list_guest->save();
                $output = Redirect::to(route('list:manage', ['id' => $req->list]));
            } else {
                $output = $this->user_list_manage($req->list, null, null, $name);
            }
        } else {
            $output = $this->user_list_manage($req->list, null, $name, null);
        }

        
        return $output;
    }

    public function delete_item(Request $req){
        $item = Item::findOrFail($req->item);
        $item->delete();
        return Redirect::to(route('list:manage', ['id' => $req->list]));
    }

    public function remove_guest(Request $req) {
        $guest = $req->guest;
        $list = $req->list;
        $this->remove_user_from_list($guest, $list);
        return Redirect::to(route('list:manage', ['id' => $req->list]));
    }

    public function delete_list(Request $req) {
        $list = GiftList::findOrFail($req->list);
        if ($list->owner == Auth::id()) {
            if ($list->done) {
                $purchase = Purchase::all()
                                ->where('list_id', $list->id)
                                ->first();
                $list->items()->where('item_id', '!=', $purchase->item_id)->delete();
                $list->delete();
            } else {
                $list->items()->delete();
                $list->delete();
            }
            $output = $this->user_list_home();
        } else {
            $output = abort(404);
        }
        return $output;
    }


    public function show_guest_list() {
        $user_guests = ListGuest::all()->where('user_id', Auth::id());
        $active_lists = [];
        $archived_lists = [];
        foreach($user_guests as $list_info) {
            $list = GiftList::find($list_info->list_id);
            $owner = User::find($list->owner);
            $info = new GuestListInfo($list->name, $list->id, $owner->name, $list->poll);
            if($list->done) {
                array_push($archived_lists, $info);
            } else {
                array_push($active_lists, $info);
            }
        }

        return view('private.contribute_list', 
            ['active_list' => $active_lists,
             'archived_list' => $archived_lists,
             'user' => Auth::user()]);
    }

    public function unsubscribe_from_list(Request $req) {
        $id = Auth::id();
        $list = $req->list;
        $this->remove_user_from_list($id, $list);
        return Redirect::to(route('list:guest'));
    }

    public function update_guest_only(Request $req) {
        $list = GiftList::findOrFail($req->list);
        $list->guest_only = !$list->guest_only;
        $list->save();
        return Redirect::to(route('list:manage', ['id' => $req->list]));
    }

    public function old($id){
        $list = GiftList::findOrFail($id);
        if (can_view_list($list, true)) {
            $purchase = Purchase::all()->where('list_id', $list->id)->first();
            $buyer = User::find($purchase->buyer)->name;
            $date = $purchase->created_at;
            $item = Item::find($purchase->item_id);

            $guests = [];
            foreach($list->group()->get() as $guest) {
                array_push($guests, $guest->name);
            }
            $owner = User::find($list->owner);
            if(!$list->guest_only) {
                array_push($guests, $owner->name);
            }

            $data = new OldListRecap($owner->name, $buyer, $date, $item->name, $item->price, $guests);
            $output = view('private.old_list', [
                'user' => Auth::user(),
                'list' => $list,
                'data' => $data]);
        } else {
            $output = abort(404);
        }
        return $output;
    }

    public function recipient(Request $req) {
        $list = GiftList::find($req->list);
        $list->recipient = $req->recipient;
        $list->has_recipient = true;
        $list->save();
        return Redirect::to(route('list:manage', ['id' => $req->list]));
    }

    public function recipient_delete(Request $req) {
        $list = GiftList::find($req->list);
        $list->recipient = '';
        $list->has_recipient = false;
        $list->save();
        return Redirect::to(route('list:manage', ['id' => $req->list]));
    }


    function check_unique($name) {
        $tmp = GiftList::all()->where('name', $name)->where('owner', Auth::id());
        if ($tmp->count() == 0) {
            $this->dup = false;
            $output = true;
        } elseif($tmp->where('done', false)->count() > 0) {
            $this->dup = false;
            $output = false;
        } else {
            $tmp = $tmp->where('done', true);
            if ($tmp->count() > 0) {
                $list = $tmp->first();
                $list->duplicated = true;
                $list->save();
                $this->dup = true;
                $output = true;
            } else {
                $this->dup = false;
                $output = true;
            }
        } 
        return $output;
    }

    function check_unique_guest($guest, $list) {
        $owner_id = GiftList::find($list)->owner;
        if($owner_id == $guest) {
            $output = false;
        } else {
            $tmp = ListGuest::all()->where('list_id', $list)->where('user_id', $guest);
            $output = $tmp->count() == 0;
        }
        return $output;
    }

    function user_list_home($err=null) {
        $uid = Auth::id();
        $lists = GiftList::all()->where('owner', $uid);
        $active_lists = $lists->where('done', false);
        $archived_lists = $lists->where('done', true);
        return view('private.personal_list',
         ['user' => Auth::user(),
          'user_lists' => $active_lists, 
          'old_lists' => $archived_lists, 
          'error' => $err]);
    }

    function user_list_manage($id, $item_err=null, $user_err=null, $guest_err=null) {
        $list = GiftList::findOrFail($id);
        if (can_view_list($list, false)) {
            $items = $list->items()->get();
            $guests = $list->group()->get();
            $win_name = $this->get_winning_item_name($list);
            $output = view('private.manage_list', 
                ['user' => Auth::user(),
                 'list' => $list,
                 'win_name' => $win_name,
                 'voted' => has_voted($list->id),
                 'items' => $items, 
                 'guests' => $guests, 
                 'item_err' => $item_err,
                 'recipient' => $list->recipient,
                 'user_err' => $user_err, 
                 'guest_err' => $guest_err,
                 'guest_only' => $list->guest_only && $list->owner == Auth::id(),
                 'guest_only_handle' => $this->can_hanlde_guest_only($list)]);
        } else {
            $output = abort(404);
        }
        return $output;
    }

    function get_winning_item_name($list) {
        if($list->ready) {
            $controller = new PollManager();
            $item_id = $controller->get_winner($list->id);
            $item = Item::findOrFail($item_id);
            $output = $item->name;
        } else {
            $output = null;
        }
        error_log($output);
        return $output;
    } 

    function remove_user_from_list($user_id, $list_id) {
        $membership = ListGuest::all()->
            where('list_id', $list_id)->
            where('user_id', $user_id)->
            first();
        $membership->delete();
    }

    function can_hanlde_guest_only($list) {
        if ($list->owner == Auth::id()) {
            $output = $list->guest_only;
        } else {
            $output = null;
        }
        return $output;
    }


}
