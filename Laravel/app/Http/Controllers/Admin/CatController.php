<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Tag;
use Exception;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;



class CatController extends Controller
{
    public function index()
    {
        $data['cats'] = Category::select()->orderBy('id', 'desc')->get();
        return view('Admin.cat.index')->with($data);
    }


    public function create()
    {
        return view('Admin.cat.addCat');
    }


    public function doCreate(Request $request)
    {
        // dd($request);
        $data = $request->validate([
            'admin_id' => 'required|exists:admins,id',
            'name' => 'required|max:20|unique:categories,name',
            'image' => 'required|image|mimes:jpg,jpeg,png',
        ]);

        if ($request->hasFile('image')) {
            $newImgName = $request->image->hashName();
            Image::make($data['image'])->save(public_path('uploads/Categories/' . $newImgName));
            $data['image'] = $newImgName;
        }


        $ca = Category::create($data);
        Alert::success('Success Add', 'Category '.$ca->name .' Add Successfully');

        return redirect(route('admin.cat.index'));
    }


    public function doCreate2(Request $request)
    {

        $data = $request->validate([
            'admin_id' => 'required|exists:admins,id',
            'name' => 'required|max:20|unique:categories,name',
        ]);
        try{
            for($i = 0 ; $i < count($request->name);$i++ )
            {
                // dd($request->image[$i]);
                $Cate = new Category();
                $Cate->admin_id = $request->admin_id;
                $Cate->name = $request->name[$i];
                $newImgName = $request->image[$i]->hashName();
                    Image::make($request->image[$i])->save(public_path('uploads/Categories/' . $newImgName));
                $Cate->image = $newImgName;
                $Cate->save();
            }
            Alert::success('Add Completed' , 'Categories Added Successfully');
            return redirect(route('admin.cat.index'));
        }
        catch(Exception $e)
        {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }



    public function edit($id)
    {
        $data['cat'] = Category::findOrfail($id);
        return view('Admin.cat.editCat')->with($data);
    }


    public function doEdit(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:20',
            'admin_id' => 'required|exists:admins,id',
            'id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:png,jpg,jpeg',
        ]);

        $OldImg = Category::find($request->id);
        if ($OldImg == null) {
            $newImgName = $request->image->hashName();
            Image::make($data['image'])->save(public_path('uploads/Categories/' . $newImgName));
            $data['image'] = $newImgName;
        } else {
            $OldImgName = Category::find($request->id)->image;
                if ($request->hasFile('image')) {

                    Storage::disk('uploads')->delete('Categories/' . $OldImgName);
                    $newImgName = $request->image->hashName();
                    Image::make($data['image'])->save(public_path('uploads/Categories/' . $newImgName));
                    $data['image'] = $newImgName;
                }
                else
                {
                    $data['image'] = $OldImgName;
                }
        }

         Category::findOrFail($request->id)->update($data);
         $ca = Category::find($request->id);
        Alert::success('Edit Completed', 'Category '.$ca->name .' Changed Successfully');

        return back();
        // return redirect(route('admin.cat.index'));
    }


    public function delete($id)
    {
        $ca = Category::findOrfail($id);
        Alert::success('Delete Completed', 'Category '.$ca->name .' Deleted Successfully');

        $ca->delete();
        return redirect(route('admin.cat.index'));
    }
}
