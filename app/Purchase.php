<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    public function buyer() {
        return $this->belongsTo('App\User');
    }
    public function contributors() {
        return $this->belongsToMany('App\User');
    }
    public function gift() {
        return $this->hasOne('App\Item');
    }
}
