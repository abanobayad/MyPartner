<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\ProfileResource;
use App\Models\Report;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReportController extends BaseController
{
   //to return all reports exist in reports table
   public function index()
   {
       $reports = Report::all();
       return $this->SendResponse($reports, 'reports sent');
   }


   //to return reports of specific post
   public function GET($id)
   {

    $post = Post::find($id);
    if ($post == null) {
        return $this->SendError('post not found');
    }

    $reports = Report::all()->where('post_id',$id);
    if ($reports == null) {
        return $this->SendError("this post dosn't hava any reports not found");
    }else{
        return $this->SendResponse($reports, 'reports sent');}
   }



   // to make new report
   public function ADD(Request $request)
   {
       $input = $request->all();
       $validator = Validator::make(
           $input,
           [
               'reason' => 'required',
               'user_id' => 'required',
               'post_id' => 'required',
           ]
       );
       if ($validator->fails()) {
           return $this->SendError("Validate Input",  $validator->errors());
       } else {

           $report = Report::create($input);
          // $js_rate = new ProfileResource($rate);
           return $this->SendResponse($report, "report created");
       }
   }


   // to update specific report
   public function EDIT(Request $request , $id)
   {
       $input = $request->all();
       $report = Report::find($id);

       if ( $report == null) {
           return $this->SendError("report not found");
       }else{

           if ( $report->user_id != Auth::id()) {
               return $this->SendError("You Are Not Allowed to edit this rate");
           }else{
               $validator = Validator::make(
                   $input,
                   [
                    'reason' => 'required',
                    'user_id' => 'required',
                    'post_id' => 'required',                   ]
               );

               if($validator->fails()) {
                   return $this->SendError("Error Of Edit rate", $validator->errors());
               } else {
                   $report->reason = $input['reason'];
                   $report->feedback = $input['feedback'];

                   $report->save();
                   //$profile_Json = ProfileResource::make($profile);
                   return $this->SendResponse($report, 'rate Updated');
               }
           }
       }
   }



   public function DELETE($id)
   {
       $report = Report::find($id);
       if ( $report == null) {
           return $this->SendError("report not found");
       }else{
           if ($report->user_id != Auth::id()) {
               return $this->SendError("You Are Not Allowed to delete this report");
           }else{
               $report = $report->delete();
               return $this->SendResponse($report, 'report Deleted Successfully');
           }
       }
   }
       }










