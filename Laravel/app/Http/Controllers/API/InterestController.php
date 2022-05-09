<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\GroupCollection;
use App\Http\Resources\InterCategoryCollection;
use App\Http\Resources\ProfileResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class InterestController extends BaseController
{
    public function make(Request $request)
    {
        $categoires = $request->has('category') ? $request->get('category'):[];
        // dd($categoires);


            $data = $request->all();
        $s = Validator::make($data , [
            // 'category_id' => 'required|exists:categories,id',
            'category' => 'required|exists:categories,id|unique:interests,category_id',
        ]);

        if($s ->fails()){return $this->SendError('Error of Validation' , $s->errors());}
        // dd('after validate');
        $user = User::find(Auth::id());
        // dd($user);

        try
        {
            $user->intrest_cat()->attach($request->category);
        }
        catch(Exception $e)
        {
            return $this->SendError('Error of insert' , $e->getMessage());
        }
        // $user->tags()->attach($request->tag);
        $data = [
            'user' =>  new UserResource($user)  ,
            'interested_categories' => new CategoryCollection($user->intrest_cat()->get()),
        ];
        return $this->SendResponse($data , 'User Interest successfully');



    }

    public function show()
    {
        $user = User::find(Auth::id());
        $data = new InterCategoryCollection($user->intrest_cat()->orderBy('updated_at', 'desc')->get());
        return $this->SendResponse($data ,'Interests Sent');
    }

    public function manyVgroups()
    {
        $user = User::find(Auth::id());
        $groups = $user->group_visits()->orderBy('times','desc')->get()->take(5);
        return $this->SendResponse( new GroupCollection($groups) ,'Many Visited Groups Sent');
    }


}
