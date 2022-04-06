<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RepController extends Controller
{
    //to return all reports exist in reports table
    public function index(Request $request){
        $selected_reps = $request->has('handled') ? $request->get('handled'):null;

        $reports = Report::all();
        // dd($reports);

        if($selected_reps != null){

            if($selected_reps == 'yes'){$reports = Report::select()->where('is_handled' , 'yes')->get();}
            if($selected_reps == 'no'){$reports = Report::select()->where('is_handled' , 'no')->get(); }
        }
       return view('Admin.report.index', compact('reports' , 'selected_reps'));
    }

    // to get details of specific contact
    public function show($post_id , $user_id)
    {
        $report = Report::select()->where('post_id' , $post_id)->where('user_id',$user_id)->first();
        if ($report == null) {
            return redirect()->back()->with('report not found');
        }else{
            return view('Admin.report.show', compact('report'));
        }
    }

    public function DELETE($post_id , $user_id){
       $report = Report::select()->where('post_id' , $post_id)->where('user_id',$user_id)->first();
       if ( $report == null) {
        return redirect()->back()->with('report not found');
    }else{
            $report = $report->delete();
            return redirect()->back();
        }
    }

   //to return reports of specific post
    public function GET($id){
        $post = Post::find($id);
        if ($post == null) {
        return redirect()->back()->with('post not found');
        }

        $reports = Report::all()->where('post_id',$id);
        if ($reports == null) {
        return redirect()->back()->with('this post doesn\'t has any reports');
        }else{
        return view('Admin.report.get', compact('reports'));
        }
    }

    //make post invisbale , send notification to post owner , send notification to report owner
    public function approve($post_id , $user_id){

        DB::table('reports')->where('post_id', $post_id)->where('user_id', $user_id)->update(['is_handled' => 'yes']);

        $report = Report::select()->where('post_id' , $post_id)->where('user_id',$user_id)->first();
        $post = Post::find($report->post_id);
        $post->visible = 'no';
        $post->save();
        // $report->update(['is_handled' => 'yes']);
        // $report->save();

        return redirect(route('admin.report.index'));
    }

    //delete report , send notification to report owner
    public function reject($post_id , $user_id){
        $report = Report::select()->where('post_id' , $post_id)->where('user_id',$user_id)->delete();
        return redirect(route('admin.report.index'));
    }

}
