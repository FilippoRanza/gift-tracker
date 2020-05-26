<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GiftList extends Model
{
    public function author() {
        return $this->belongsTo('App\User');
    }

    public function items() {
        return $this->hasManyThrough('App\Item', 'App\ItemList', 'list_id', 'id', null, 'item_id');
    }

    public function group() {
        return $this->hasManyThrough('App\User', 'App\ListGuest', 'list_id', 'id', null, 'user_id');
    }

}
