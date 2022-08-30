<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryStore;
use App\Http\Requests\CategoryUpdate;
use App\Models\Category;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.category.index');
    }

    public function ssd()
    {
        $data = Category::query();
        return Datatables::of($data)
        ->editColumn('cat_image',function($each){
            $img = '<img src="'.asset('/uploads/'.$each->cat_image).'" width="60" alt="">';
            return $img;
        })
        ->editColumn('created_at',function($each){
            return Carbon::parse($each->created_at)->format('Y-m-d H:i:s');
        })
        ->editColumn('updated_at',function($each){
            return Carbon::parse($each->updated_at)->format('Y-m-d H:i:s');
        })
        ->addColumn('action',function($each){
            $edit_icon = '<a href="'.route("admin.category.edit" , $each->id ).'" class="btn btn-sm btn-outline-secondary" data-toggle="tooltip" title="Edit"><i class="pe-7s-edit"></i></a>';
            $delete_icon = '<a href="#" class="btn btn-sm btn-outline-danger delete" data-id="'.$each->id.'"><i class="pe-7s-delete-user"></i></a>';
            return $edit_icon .'&nbsp;'. $delete_icon;
        })
        ->rawColumns(['cat_image', 'action'])
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryStore $request)
    {
        $file = $request->file('image');
        $filename = uniqid().'_'.$file->getClientOriginalName();

        $file->move(public_path().'/uploads/',$filename);

        $category = new Category();
        $category->cat_image = $filename;
        $category->cat_name = $request->name;
        $category->description = $request->description;

        $category->save();
        return redirect()->route('admin.category.index')->with('create','Successfully Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit_category = Category::findOrFail($id);
        return view('backend.category.edit',compact('edit_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdate $request, $id)
    {
        $category_edit = Category::findOrFail($id);

        if(!empty($request->file('image'))){
            $file = $request->file('image');
            $filename = uniqid().'_'.$file->getClientOriginalName();
            $file->move(public_path().'/uploads/',$filename);
            $category_edit->cat_image = $filename;
        }else{
            $category_edit->cat_image = $category_edit->image;
        }
        
        $category_edit->cat_name = $request->name;
        $category_edit->description = $request->description;
        $category_edit->update();

        return redirect()->route('admin.category.index')->with('update','Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category_del = Category::findOrFail($id);
        $category_del->delete();

        return 'success';
    }
}
