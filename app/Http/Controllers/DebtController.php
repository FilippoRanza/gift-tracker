<?php

namespace App\Http\Controllers;

use App\Debt;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class DebtInfo 
{
    function __construct($debt, $name, $marked, $pic)
    {
        $this->debt = $debt;
        $this->name = $name;
        $this->pic = $pic;
        $this->marked = $marked;
    }

}


class DebtController extends Controller
{
    public function list() {
        $id = Auth::id();
        $user_debts = Debt::all()->where('from_id', $id);
        $debts = $this->collect_debt_info($user_debts);
        $tmp = $this->get_warm_debts();
        $notify = count($tmp['confirm']);
        $notify += count($tmp['refused']);

        return view('private.debt_home', ['user' => Auth::user(), 'debts' => $debts, 'notify' => $notify]);
    }

    public function settle(Request $req) {
        $debt = Debt::find($req->debt);
        $relative = $this->get_relative($debt);
        if($debt->amount < 0) {
            $debt->delete();
            $relative->delete();
        } else {
            $relative->confirm_settle = true;
            $relative->save();
        }
        return Redirect::to(route('debt:list'));
    }

    public function list_notifications() {
        $tmp = $this->get_warm_debts();
        $confirm_debt = $tmp['confirm'];
        $refused_debt = $tmp['refused'];
        return view('private.debt_notification', ['user' => Auth::user(), 'confirm' => $confirm_debt, 'refused' => $refused_debt]);
    }

    public function mark_as_seen(Request $req) {
        $debt = Debt::find($req->debt);
        $debt->refused = false;
        $debt->confirm_settle = false;
        $debt->save();
        return Redirect::to(route('debt:list'));
    }

    public function refuse_settle(Request $req) {
        $debt = Debt::find($req->debt);
        $relative = $this->get_relative($debt);
        $relative->refused = true;
        $relative->save();

        $debt->confirm_settle = false;
        $debt->save();
        return Redirect::to(route('debt:list'));
    }

    function get_warm_debts() {
        $id = Auth::id();
        $confirm = Debt::all()->where('from_id', $id)->where('confirm_settle', true);
        $confirm = $this->collect_debt_info($confirm);
        $refused = Debt::all()->where('from_id', $id)->where('refused', true);
        $refused = $this->collect_debt_info($refused);
        $output = ['confirm' => $confirm, 'refused' => $refused];
        return $output;
    }


    function collect_debt_info($debts) {
        $output = [];
        foreach($debts as $debt) {
            $user = User::find($debt->to_id);
            $relative = $this->get_relative($debt);
            $info = new DebtInfo($debt, $user->name, $relative->confirm_settle, $user->profile_pic);
            array_push($output, $info);
        }
        return $output;
    }

    function get_relative($debt) {
        return Debt::all()->where('from_id', $debt->to_id)
                   ->where('to_id', $debt->from_id)
                   ->first();
    } 


}
