<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function gift() {
        return $this->belongsTo('App\Purchase');
    }

    public function gift_list() {
        return $this->belongsTo('App\GiftList');
    }

}
