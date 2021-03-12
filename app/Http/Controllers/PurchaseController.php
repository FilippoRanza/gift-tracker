<?php

namespace App\Http\Controllers;

use App\Debt;
use App\GiftList;
use App\Item;
use App\Purchase;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PurchaseInfo 
{
    function __construct($id, $item, $list, $recipient, $price)
    {
        $this->id = $id;
        $this->item = $item;
        $this->list = $list;
        $this->recipient = $recipient;
        $this->price = $price;
    }

}

class PurchaseController extends Controller
{
    public function list() {
        $user_purchase = Purchase::all()
                            ->where('buyer', Auth::id());
        $purchases = [];                    
        foreach($user_purchase as $purchase) {
            $item = Item::find($purchase->item_id);
            $list = GiftList::find($purchase->list_id);
            if($list->has_recipient) {
                $recipient = $list->recipient;
            } else {
                $recipient = User::find($list->owner)->name;
            }
            
            $info = new PurchaseInfo($purchase->id, $item->name, $list->name, $recipient, $item->price);
            array_push($purchases, $info);
        }
        return view('private.purchase_list', ['user' => Auth::user(), 'purchases' => $purchases]);
    }

    public function info($id) {
        $purchase = Purchase::findOrFail($id);
        $list = GiftList::find($purchase->list_id);
        return Redirect::to(route('list:old', ['id' => $list->id]));
    }


    public function purchase(Request $req) {
        $list = GiftList::findOrFail($req->list);
        $item = Item::findOrFail($req->item);
        return $this->make_purchase($list, $item);
    }

    //remove purchase and relative list, without 
    // touching the debt
    public function delete_purchase(Request $req) {
        $purchase = Purchase::findOrFail($req->purchase);
        $list = GiftList::find($purchase->list_id);
        $items = $list->items();
        $items->delete();
        $list->delete();
        $purchase->delete();
        return Redirect::to(route('purchase:list'));
    }

    //reverse the purchase, reset the list as 
    // 'undone' and reset all the debts
    public function void_purchase(Request $req) {
        $purchase = Purchase::findOrFail($req->purchase);
        $list = GiftList::find($purchase->list_id);
        $item = Item::find($purchase->item_id);
        // -1 inverts the sign of the debt assignment, 
        // removing the associated debt
        $this->compute_guests_debts($list, $item, -1);
        $list->done = false;
        $purchase->delete();
        $list->save();
        return Redirect::to(route('list:show'));
    }

    public function automatic_purchase(Request $req) {
        $controller = new PollManager();
        $item_id = $controller->get_winner($req->list);
        $list = GiftList::findOrFail($req->list);
        $item = Item::findOrFail($item_id);
        return $this->make_purchase($list, $item);
    }


    function update_purchase($list, $item){
        $purchase = new Purchase();
        $purchase->buyer = Auth::id();
        $purchase->list_id = $list->id;
        $purchase->item_id = $item->id;
        $purchase->save();
    }

    function compute_guests_debts($list, $item, $sign=1) {
        $guests = $list->group();
        $participants = $guests->count();
        if (!$list->guest_only) {
            $participants++;
        }

        $price_per_capita = (int)($item->price / $participants);
        $id = Auth::id();
        foreach($guests->get() as $guest) {
            if ($guest->id != $id) {
                $this->update_debt($guest->id, $id, $sign * $price_per_capita);
                $this->update_debt($id, $guest->id, -$sign * $price_per_capita);
            }
        }

        if(!$list->guest_only) {
            if ($list->owner != $id ){
                $this->update_debt($list->owner, $id, $price_per_capita);
                $this->update_debt($id, $list->owner, -$price_per_capita);
            }
        }

    }

    function update_debt($from, $to, $amount) {
        $debt = $this->get_debt_or_new($from, $to);
        $debt->amount += $amount;
        if($debt->amount == 0) {
            $debt->delete();
        } else {
            $debt->save();
        }
        
    }

    function get_debt_or_new($from, $to) {
        $debt = Debt::all()
                    ->where('from_id', $from)
                    ->where('to_id', $to)
                    ->first();
        if ($debt === null) {
            $tmp = new Debt();
            $tmp->amount = 0;
            $tmp->from_id = $from;
            $tmp->to_id = $to;
            $debt = $tmp;
        }
        return $debt;
    }

    function make_purchase($list, $item) {
        
        if(!$list->done) {
            $this->compute_guests_debts($list, $item);
            $this->update_purchase($list, $item);
            $list->done = true;
            $list->save();
            $redirect =  Redirect::to(route('purchase:list'));
        } else {
            abort(404);
        }
        return $redirect;
    }

}
