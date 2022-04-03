<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Resources\ContactResource;

class ContactController extends BaseController
{

    // to add new rate in rates table
    public function ADD(Request $request){
        $input = $request->all();
        $validator = Validator::make(
            $input,
            [
                'subject' => 'required',
                'content' => 'required',
            ]
            );
        if ($validator->fails()) {
            return $this->SendError("Validate Input",  $validator->errors());
        }else{

            $input['user_id'] = Auth::id();
            $contact = Contact::create($input);

            $js_contact = ContactResource::make($contact);
            return $this->SendResponse($js_contact, "contact send");
        }
    }


    // to get contacts of specific user (admin)
    public function GET($id)
    {
        $user = User::find($id);
        if ($user == null) {
            return $this->SendError('User not found');
        }
        $contacts = Contact::select()->where('user_id',$user->id)->get();
        if (is_null($contacts))
            return $this->SendError('there in no contacts from this user');
        else {
            $js_contact = ContactResource::collection($contacts);
            return $this->SendResponse($js_contact, 'user contacts sent Successfully');
        }
    }


}




















