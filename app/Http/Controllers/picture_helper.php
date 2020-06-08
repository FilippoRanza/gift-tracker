<?php

use Illuminate\Support\Facades\Storage;

define('PIC_HEADER', 'data:image/png;base64,');

function get_random_string($len) 
{
    $output = "";
    for($i = 0; $i < $len; $i++) {
        $curr = random_int(0, 255);
        $output .= chr($curr);
    }
    return $output;
}


function get_unique_name($ext, $curr_len=20) 
{
    
    for($iter = 0;; $iter++) {
        $str_token = get_random_string($curr_len++);
        $num_token = random_int(PHP_INT_MIN, PHP_INT_MAX);
        $now = time();
        $str = "$num_token$now$str_token$iter";
        $hash = sha1($str);
        $name = $hash . '.' . $ext;
        if(!Storage::disk('public')->exists($name)) {
            break;
        }
    }
    return $name;
}


function save_image($image_str, $old_pic="") 
{
    if (substr_compare($image_str, PIC_HEADER, 0, 22) == 0) {
        if($old_pic){
            remove_image($old_pic);
        }
        $base_64 = str_replace(PIC_HEADER, '', $image_str);
        $image = base64_decode($base_64);
        $name = get_unique_name('png');
        Storage::disk('public')->put($name, $image);
    } else {
        abort(406);
    }
    return $name;
}

function remove_image($image_name) 
{
    if($image_name) {
        Storage::disk('public')->delete($image_name);
        $output = true;
    } else {
        $output = false;
    }
    return $output;
}