<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Rate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RateController extends Controller
{
    public function index()
    {
        $rates = Rate::paginate(10);
        return view('Admin.rate.index', compact('rates'));
    }

    // to get details of specific rate
    public function show($s_id , $r_id)
    {
        $rate = Rate::select()->where('sender_id' , $s_id)->where('receiver_id' , $r_id)->first();
        return view('Admin.rate.show', compact('rate'));
    }

    // to get rates of specific user
    public function GET($id)
    {
        $user = User::find($id);
        if ($user == null) {
            return redirect()->back()->with('User not found');
        }
        $rates = Rate::select()->where('receiver_id',$user->id)->get();

        $sum = 0;
        $total = 0;
        foreach ($rates as $rate){
            $sum =$sum+ $rate->rate_value;
        }
        if(sizeof($rates) > 0){
            $total = $sum / sizeof($rates);
            $data['number_of_reviews']=sizeof($rates);
            $data['total_reviews_percentage']=$total;
        }
        $collection = collect(['number_of_reviews' => sizeof($rates), 'total_reviews_percentage' => $total]);

        return view('Admin.rate.get', compact('user','rates','collection'));
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
            $data['number_of_reviews']=sizeof($rate);
            $data['total_reviews_percentage']=$total;
            $collection = collect(['number_of_reviews' => sizeof($rate), 'total_reviews_percentage' => $total]);

            return view('Admin.rate.total', compact('collection'));
        }
    }

    public function DELETE($s_id , $r_id)
    {
        DB::delete('DELETE FROM rates WHERE sender_id = ? AND receiver_id = ?',[$s_id,$r_id] );
        return redirect(route('admin.rate.index'));
    }


    public function low()
    {
        $users = User::all();
        $data=[];
        foreach($users as $user){
            $rates = Rate::select()->where('receiver_id',$user->id)->get();
            $sum = 0;
            $total = 0;
            foreach ($rates as $rate){
                $sum =$sum+ $rate->rate_value;
            }
            if(sizeof($rates) > 3){
                $total = $sum / sizeof($rates);
                if($total<3){
                    array_push($data,
                    [
                        'name' => $user->name,
                        'id' => $user->id,
                        'avg'=> $total,
                        'number'=>sizeof($rates)
                    ]);
                }
            }

        }
        return view('Admin.rate.low', compact('data'));
    }

        }









