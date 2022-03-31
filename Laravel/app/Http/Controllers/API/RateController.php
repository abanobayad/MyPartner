<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\ProfileResource;

use App\Models\Rate;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RateController extends BaseController
{
    //to return all rates exist in rates table
    public function index()
    {
        $rates = Rate::all();
        return $this->SendResponse($rates, 'rates sent');
    }


    //to return my rates
    public function myRate()
    {
        $user = Auth::user();
        $rates = Rate::all()->where('receiver_id',$user->id);
        if ($rates == null) {
            return $this->SendError('No one has rated you before');
        }
        return $this->SendResponse($rates, 'rates sent');
    }

    // to add new rate in rates table
    public function ADD(Request $request)
    {

        $sender_id = Auth::id();
        $receiver_id = $request->receiver_id;
        if($sender_id == $receiver_id)
        {
            return $this->SendError('You Cannot Rate Yourself');
        }
        $input = $request->all();
        $validator = Validator::make(
            $input,
            [
                'receiver_id' => 'required',
                'rate_value' => 'required',
            ]
        );
        if ($validator->fails()) {
            return $this->SendError("Validate Input",  $validator->errors());
        } else {
            $input['sender_id']=Auth::id();
            $input['created_at'] = now();
            $input['updated_at'] = now();
            
            $rate = Rate::create($input);
           // $js_rate = new ProfileResource($rate);
            return $this->SendResponse($rate, "rate Added");
        }
    }


    // to get rates of sspecific user
    public function GET($id)
    {
        $user = User::find($id);
        if ($user == null) {
            return $this->SendError('User not found');
        }
       // $rate = $user->rates()->first();
        $rate = Rate::all()->where('receiver_id',$user->id);
        if (is_null($rate))
            return $this->SendError('there in no rates');
        else {
            //$js_prof = new ProfileResource($profile);
            return $this->SendResponse($rate, 'rates sent Successfully');
        }
    }


    // to total sum of rates for specific user
    public function totalRate($id)
    {
        $user = User::find($id);
        if ($user == null) {
            return $this->SendError('User not found');
        }
        $rate = Rate::all()->where('receiver_id',$user->id);
        if (is_null($rate))
            return $this->SendError('there in no rates');
        else {
            $sum = 0;
            foreach ($rate as $item){
                $sum =$sum+ $item->rate_value;
            }
            $total = $sum / sizeof($rate);
            return $this->SendResponse($total, 'rates sent Successfully');
        }
    }

    // to update specific rate
    public function EDIT(Request $request , $id)
    {
        $input = $request->all();
        $rate = Rate::find($id);

        if ( $rate == null) {
            return $this->SendError("rate not found");
        }else{

            if ( $rate->sender_id != Auth::id()) {
                return $this->SendError("You Are Not Allowed to edit this rate");
            }else{
                $validator = Validator::make(
                    $input,
                    [
                        'rate_value' => 'required',
                    ]
                );

                if($validator->fails()) {
                    return $this->SendError("Error Of Edit rate", $validator->errors());
                } else {
                    $rate->rate_value = $input['rate_value'];
                    $rate->save();
                    //$profile_Json = ProfileResource::make($profile);
                    return $this->SendResponse($rate, 'rate Updated');
                }
            }
        }
    }



    public function DELETE($id)
    {
        $rate = Rate::find($id);
        if ( $rate == null) {
            return $this->SendError("rate not found");
        }else{
            if ($rate->sender_id != Auth::id()) {
                return $this->SendError("You Are Not Allowed to delete this rate");
            }else{
                $rate = $rate->delete();
                return $this->SendResponse($rate, 'rate Deleted Successfully');
            }
        }
    }
        }









