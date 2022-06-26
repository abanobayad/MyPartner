<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\IllegalWords;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class IllegalWordsController extends Controller
{
    public function index()
    {
        $words = IllegalWords::paginate(10);
        return view ('Admin.setting.illegalwords.index' , compact('words'));
    }

    public function add()
    {
        return view ('Admin.setting.illegalwords.add');
    }


    public function store(Request $request)
    {

        $data = $request->validate([
            'word' => 'required|max:20',
        ]);
        try{
            for($i = 0 ; $i < count($request->word);$i++ )
            {
                $word = new IllegalWords();
                $word->word = $request->word[$i];
                $word->save();
            }
            Alert::success('Add Completed' , 'Words Added Successfully');
            return redirect(route('admin.word.index'));
        }
        catch(Exception $e)
        {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


    public function edit($id)
    {
        $word = IllegalWords::find($id);
        return view ('Admin.setting.illegalwords.edit' , compact('word'));
    }

    public function doEdit(Request $request)
    {
        $data = $request->validate([
            'word' => 'required|max:20',
            'id' => 'required|exists:illegal_words,id',
        ]);
        $word = IllegalWords::find($request->id);
        $word->word = $request->word;
        $word->save();
        Alert::success('Edit Success');
        return redirect(route('admin.word.index'));
    }

    public function delete($id)
    {
        $word = IllegalWords::find($id);
        Alert::success('Delete Success' ,'Word '. $word->word .' Deleted Successfully');
        $word->delete();
        return redirect(route('admin.word.index'));
    }
}
