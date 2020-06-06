<?php

namespace App\Http\Controllers;

use App\GiftList;
use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

require 'list_helper.php';

class ItemSettingsController extends Controller
{
    public function index(Request $req) {
        $item = Item::find($req->item);
        $list = GiftList::find($req->list);
        return view('private.item_settings', ['user' => Auth::user(), 'item' => $item, 'list' => $list]);
    }

    public function update_name(Request $req) {
        $new_name = $req->name;
        $item = Item::find($req->item);
        if(check_unique_item($new_name, $req->list)) {
            $item->name = $new_name;
            $item->save();
            $output = ['rename' => true];
        }elseif($new_name == $item->name) {
            $output = ['rename' => true];
        } else {
            $output = ['rename' => false, 'name' => $item->name];
        }
        return response()->json($output);
    }

    public function update_price(Request $req) {
        $item = Item::find($req->item);
        $item->price = $req->price * 100;
        $item->save();
        return response()->json(['price' => $item->price]);
    }

    public function update_url(Request $req) {
        $item = Item::find($req->item);
        error_log($req->url);
        $item->site = $req->url;
        $item->save();
        return response()->json(['url' => true]);
    }


    public function delete_url(Request $req) {
        $item = Item::find($req->item);
        $item->site = "";
        $item->save();
        error_log('ok');
        return response()->json(['url' => false]);
    }

}
