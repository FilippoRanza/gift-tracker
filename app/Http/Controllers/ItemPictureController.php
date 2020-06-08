<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

require 'picture_helper.php';

class ItemPictureController extends Controller
{
    public function set_item_picture(Request $req)
    {
        $item = Item::find($req->id);
        $base_64 = $req->image;
        $name = save_image($base_64, $item->picture);
        $item->picture = $name;
        $item->save();
        return response()->json(['update' => true]);
    }

    public function remove_item_picture(Request $req)
    {
        $item = Item::find($req->id);
        if(remove_image($item->picuture)) {
            $item->picute = "";
            $item->save();
        }
        return response()->json(['update' => true]);
    }

}
