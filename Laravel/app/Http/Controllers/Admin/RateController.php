<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Rate;
use App\Models\User;
use Illuminate\Http\Request;

class RateController extends Controller
{
    //to return all rates exist in rates table (admin)
    public function index()
    {
        $rates = Rate::all();
        return view('Admin.rate.index', compact('rates'));
    }


    // to get details of specific contact
    public function show($id)
    {
        $rate = Rate::find($id);
        if ($rate == null) {
            return redirect()->back()->with('rate not found');
        }else{
            return view('Admin.rate.show', compact('rate'));
        }
    }

    public function DELETE($id)
    {
        $rate = Rate::find($id);
        if ( $rate == null) {
            return redirect()->back()->with('rate not found');
        }else{
                $rate = $rate->delete();
                return redirect()->back();
            }
        }


    // to get rates of specific user (admin)
    public function GET($id)
    {
        $user = User::find($id);
        if ($user == null) {
            return redirect()->back()->with('User not found');
        }
        $rates = Rate::select()->where('receiver_id',$user->id)->get();
        if (is_null($rates))
            return redirect()->back()->with('there in no rates for this user');
        else {
            return view('Admin.rate.get', compact('rates'));
        }
    }


    // total sum of rates for specific user
    public function totalRate($id)
    {
        $user = User::find($id);
        if ($user == null) {
            return redirect()->back()->with('User not found');
        }
        $rate = Rate::all()->where('receiver_id',$user->id);
        if (is_null($rate))
            return redirect()->back()->with('there in no rates for this user');
        else {
            $sum = 0;
            foreach ($rate as $item){
                $sum =$sum+ $item->rate_value;
            }
            $total = $sum / sizeof($rate);
            return view('Admin.rate.get', compact('total'));
        }
    }


        }









