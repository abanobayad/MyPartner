<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\RateResource;
use App\Models\Rate;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RateController extends BaseController
{

    //to return my rates
    public function myRate()
    {
        $user = Auth::user();
        $rates = Rate::all()->where('receiver_id',$user->id);
        if ($rates == null) {
            return $this->SendError('No one has rated you before');
        }
        $data = $this->totalRate($user->id);
        $js_rate = RateResource::collection($rates);
        $collection = collect(['reviews' =>$data ,'rates'=>$js_rate]);

        return $this->SendResponse($collection, 'rates sent Successfully');
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
                'rate_value' => 'required|integer|between:1,5',
                'feedback' => 'nullable',

                ]
        );
        if ($validator->fails()) {
            return $this->SendError("Validate Input",  $validator->errors());
        } else {
            $input['sender_id']=Auth::id();
            $input['created_at'] = now();
            $input['updated_at'] = now();

            $rate = Rate::create($input);
            $js_rate = RateResource::make($rate);
            return $this->SendResponse($js_rate, "rate Added");
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
             $total =0;
             foreach ($rate as $item){
                 $sum =$sum+ $item->rate_value;
             }
             if(count($rate)>0){
                 $total = $sum / sizeof($rate);
             }

             $data['number_of_reviews'] = sizeof($rate);
             $data['totoal_reviews_percentage'] = $total;

             return $this->SendResponse($data, 'rates sent Successfully');
         }
     }


    // to get rates of specific user
    public function GET($id)
    {
        $user = User::find($id);
        if ($user == null) {
            return $this->SendError('User not found');
        }
        $rate = Rate::all()->where('receiver_id',$user->id);
        if (is_null($rate))
            return $this->SendError('there in no rates for this user');
        else {
            $data = $this->totalRate($user->id);
            $js_rate = RateResource::collection($rate);
            $collection = collect(['reviews' =>$data ,'rate'=>$js_rate]);
            return $this->SendResponse($collection, 'rates sent Successfully');
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
                        'rate_value' => 'required|integer|between:1,5',
                        'feedback' => 'nullable',
                    ]
                );

                if($validator->fails()) {
                    return $this->SendError("Error Of Edit rate", $validator->errors());
                } else {
                    $rate->rate_value = $input['rate_value'];
                    $rate->feedback = $input['feedback'];

                    $rate->save();
                    $js_rate = RateResource::make($rate);
                    return $this->SendResponse($js_rate, 'rate Updated');
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


    public function make($id){

        $input['sender_id'] = Auth::id();
        $input['receiver_id'] = $id;

        $rate = Rate::select()->where('sender_id',$input['sender_id'])->where('receiver_id',$input['receiver_id'])->get()->first();

        if($rate == null){
            return $this->SendResponse($rate, 'make rate');
        }else{
            return $this->SendResponse($rate, 'update rate');
        }
    }


    // public function create(Request $request){

    //     $input['sender_id'] = Auth::id();
    //     $input['receiver_id'] = $request->receiver_id;

    //     $rate = Rate::select()->where('sender_id',$input['sender_id'])->where('receiver_id',$input['receiver_id'])->get()->first();

    //     if($rate == null){
    //         return $this->ADD($request);
    //     }else{
    //         return $this->EDIT($request,$rate->id);
    //     }
    // }


    public function url($id){

        $rate = Rate::find($id)->get()->first();
        //$path = url()->current();
        $path = url("/api/rate/show/{$rate->id}");
        return $path;
    }



        }









