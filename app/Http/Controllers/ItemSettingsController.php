<?php

namespace App\Http\Controllers;

use App\GiftList;
use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;

class ItemSettingsController extends Controller
{
    public function index(Request $req) {
        $item = Item::find($req->item);
        $list = GiftList::find($req->list);
        return view('private.item_settings', ['user' => Auth::user(), 'item' => $item, 'list' => $list]);
    }

    public function update_name(Request $req) {

    }

    public function update_price(Request $req) {
        $item = Item::find($req->item);
        error_log($req->price);
        $item->price = $req->price * 100;
        $item->save();
        return response()->json(['price' => $item->price]);
    }

    public function update_url(Request $req) {

    }

}
