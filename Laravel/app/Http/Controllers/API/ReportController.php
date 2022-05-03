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
use App\Http\Resources\ReportResource;
use Illuminate\Validation\Rule;

class ReportController extends BaseController
{

   // to make new report
   public function ADD(Request $request)
   {
        $input = $request->all();
        $input['user_id']= Auth::id();
        $post = Post::find($input['post_id']);

        if($post==null)
        return $this->SendError('Post Not Found');

        $old_rep = Report::select()->where('user_id' , $input['user_id'])->where('post_id' , $input['post_id'])->first();

        if($old_rep != null)
        {
            return $this->SendError('You report this post before....please wait until admins take an action');
        }

        if($input['user_id'] == $post->user_id)
        {
            return $this->SendError('You Cannot report your post');
        }


        $reasons =['reason1','reason2','reason3','reason4'];
        $validator = Validator::make(
            $input,
            [
                'reason' => Rule::in($reasons),
                'post_id' => 'required',
                'feedback' => 'nullable|string',
            ]
        );
       if ($validator->fails()) {
           return $this->SendError("Validate Input",  $validator->errors());
       } else {

        //user_id Edit
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

        $js_report = ReportResource::make($report);
        return $this->SendResponse($js_report, "report created");
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
            $reasons =['reason1','reason2','reason3','reason4'];

             $validator = Validator::make(
                 $input,
                 [
                  'reason' => Rule::in($reasons),
                  'feedback' => 'nullable|string', ]
             );

               if($validator->fails()) {
                   return $this->SendError("Error Of Edit report", $validator->errors());
               } else {
                   $report->reason = $input['reason'];
                   $report->feedback = $input['feedback'];

                   $report->save();
                   $js_report = ReportResource::make($report);
                   return $this->SendResponse($js_report, 'report Updated');
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
        $js_report = ReportResource::collection($reports);
        return $this->SendResponse($js_report, "report sent");    }
   }

       }










