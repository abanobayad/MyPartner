<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Report;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Notifications\AdminPostReported;
use Illuminate\Support\Facades\Notification;
use App\Models\Admin;

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

    $reports = Report::select()->where('post_id',$id)->get();
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
               'post_id' => 'required',
           ]
       );
       if ($validator->fails()) {
           return $this->SendError("Validate Input",  $validator->errors());
       } else {

        //user_id Edit
        $input['user_id']= Auth::id();
        $input['created_at']= now();
        $input['updated_at']= now();

           $report = Report::create($input);

           //Notification part start
           $Admins = Admin::all();
           $post = Post::find($request->post_id);
           $group = $post->group;
           $reporter =Auth::user();
           $details = [
            'post_id' => $post->id,
            'reporter_id' => $reporter->id,
            'title' => $post->title.' post has been reported',
            'body' => $post->title.' post in '.$group->name. ' group is reported by user: ' .$reporter->name,
            ];
           Notification::send($Admins , new AdminPostReported($details));
           //notification part end

          // $js_report = new ProfileResource($report);
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
               return $this->SendError("You Are Not Allowed to edit this report");
           }else{
               $validator = Validator::make(
                   $input,
                   [
                    'reason' => 'required',
                    'user_id' => 'required',
                    'post_id' => 'required',                   ]
               );

               if($validator->fails()) {
                   return $this->SendError("Error Of Edit report", $validator->errors());
               } else {
                   $report->reason = $input['reason'];
                   $report->feedback = $input['feedback'];

                   $report->save();
                   //$profile_Json = ProfileResource::make($profile);
                   return $this->SendResponse($report, 'report Updated');
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










