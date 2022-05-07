<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Resources\ContactResource;
use App\Models\Admin;
use App\Notifications\MakeContact;
use Illuminate\Support\Facades\Notification;

class ContactController extends BaseController
{

    // to add new rate in rates table
    public function ADD(Request $request){
        $input = $request->all();
        $validator = Validator::make(
            $input,
            [

                'subject' => 'required|string',
                'reason' => 'required|in:Create New Group,Create New Category,other',
                'content' => 'required|string',
            ]
            );
        if ($validator->fails()) {
            return $this->SendError("Validate Input",  $validator->errors());
        }else{

            $input['user_id'] = Auth::id();

            // dd($input);

            $contact = Contact::create($input);
            // dd($contact);


            //Notification part start
           $Admins = Admin::all();
           $reporter =Auth::user();
           $details = [
            'contact_id'    => $contact->id,
            'reporter_id'   => $reporter->id,
            'title'         => $reporter->name.' contact admins',
            'body'          => $reporter->name. ' contact for this reason : ' .$contact->reason,
            ];
           Notification::send($Admins , new MakeContact($details));
           //notification part end





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




















