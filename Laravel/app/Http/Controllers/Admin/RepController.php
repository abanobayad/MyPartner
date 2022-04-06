<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\Post;
use Illuminate\Http\Request;

class RepController extends Controller
{
    //to return all reports exist in reports table
    public function index(){
       $reports = Report::all();
       return view('Admin.report.index', compact('reports'));
    }

    // to get details of specific contact
    public function show($id)
    {
        $report = Report::find($id);
        if ($report == null) {
            return redirect()->back()->with('report not found');
        }else{
            return view('Admin.report.show', compact('report'));
        }
    }

    public function DELETE($id){
       $report = Report::find($id);
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
        return redirect()->back()->with('this post dosnot hava any reports');
        }else{
        return view('Admin.report.get', compact('reports'));
        }
    }

    //make post invisbale , send notification to post owner , send notification to report owner
    public function approve($id){
        $report = Report::find($id);
        $post = Post::find($report->post_id);
        $post->visible = 'no';
        $report->is_handled = 'yes';
        $report->save();
        $post->save();
        return redirect(route('admin.report.index'));
    }

    //delete report , send notification to report owner
    public function reject($id){
        $report = Report::find($id);
        $this->DELETE($report->id);
        return redirect(route('admin.report.index'));
    }

}
