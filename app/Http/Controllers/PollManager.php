<?php

namespace App\Http\Controllers;

use App\GiftList;
use App\Item;
use App\ItemList;
use App\ListGuest;
use App\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

include_once 'list_helper.php';

class PollManager extends Controller
{
    //ok
    public function toggle_poll_mode(Request $req) {
        $list = GiftList::findOrFail($req->list);
        if ($list->owner == Auth::id()) {
            if($list->poll) {
                $this->clear($list);
            }
            $list->poll = !$list->poll;
            $list->save();
            $output = Redirect::to(route('list:manage', ['id' => $req->list]));
        } else {
            $output = abort(404);
        }
        return $output;
    }

    //ok
    public function vote(Request $req) {
        $list = GiftList::findOrFail($req->list);
        if(can_view_list($list, false)) {
            if($this->can_vote($list)) {
                $this->vote_for($req->list, $req->item);
                if ($this->is_done($list)) {
                    $list->ready = true;
                    $list->save();
                }
                $output = Redirect::to(route('list:manage', ['id' => $req->list]));
            } else {
                $output = abort(403);
            }
        } else {
            $output = abort(404);
        }
        return $output;
    }

    //ok
    public function get_winner($list_id) {
        $list = GiftList::find($list_id);
        $item_list = $list->items()
                    ->orderBy('votes', 'desc');
        $tmp = $item_list->first();
        return $tmp->id;
    }

    public function clear_votes(Request $req) {
        $list = GiftList::findOrFail($req->list);
        $this->clear($list);
        return Redirect::to(route('list:manage', ['id' => $req->list]));
    }

    function clear($list) {        
        foreach($list->items() as $item) {
            $item->poll = 0;
            $item->save();
        }
        Vote::where('list_id', $list->id)->delete();
        $list->ready = false;
        $list->save();
    }

    function vote_for($list_id, $item_id) {
        $item = Item::find($item_id);
        $item->votes++;
        
        $vote = new Vote();
        $vote->user = Auth::id();
        $vote->list_id = $list_id;
        $vote->item_id = $item_id;

        $item->save();
        $vote->save();

    }

    //ok
    function can_vote($list) {
        $id = Auth::id();
        $vote = Vote::all()
                    ->where('user', $id)
                    ->where('list_id', $list->id);
                
        if ($vote->count()) {
            return false;
        } else {
            if ($id == $list->owner) {
                return !$list->guest_only;
            } else {
                return true;
            }
        }
    }

    //ok
    function is_done($list) {
        $guests = $list->group()->count();
        $voters = Vote::all()
                    ->where('list_id', $list->id)
                    ->count();

        if(!$list->guest_only) {
            $guests++;
        }

        if($voters == $guests) {
            return true;
        }

        $votes = $list->items()
                    ->orderBy('votes', 'desc');
        if ($votes->count() > 1) {
            $votes = $votes->get();
            $first = $votes[0]->votes;
            $second = $votes[1]->votes;
            $missing = $guests - $voters;
            return $missing < ($first - $second);             
        } else {
            return true;
        }

    }

}
