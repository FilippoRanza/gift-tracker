<?php

namespace App\Http\Controllers;
use App\ListGuest;
use App\Vote;
use Illuminate\Support\Facades\Auth;

function can_view_list($list, $done) {
    $user = Auth::id();
    if ($list->owner == $user) {
        $output = true;
    } else {
        $query = ListGuest::all()->where('list_id', $list->id)->where('user_id', $user);
        $count = $query->count();
        $output = $count == 1;
    }
    return $output && $list->done == $done;
}

function has_voted($list_id) {
    $tmp = Vote::all()
                ->where('list_id', $list_id)
                ->where('user', Auth::id());
    return $tmp->count() == 1;
} 

