<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Http\Requests\TagStore;
use App\Http\Requests\TagUpdate;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.tag.index');
    }

    public function ssd()
    {
        $data = Tag::query();
        return Datatables::of($data)
        ->editColumn('created_at',function($each){
            return Carbon::parse($each->created_at)->format('Y-m-d H:i:s');
        })
        ->editColumn('updated_at',function($each){
            return Carbon::parse($each->updated_at)->format('Y-m-d H:i:s');
        })
        ->addColumn('action',function($each){
            $edit_icon = '<a href="'.route("admin.tag.edit" , $each->id ).'" class="btn btn-sm btn-outline-secondary" data-toggle="tooltip" title="Edit"><i class="pe-7s-edit"></i></a>';
            $delete_icon = '<a href="#" class="btn btn-sm btn-outline-danger delete" data-id="'.$each->id.'"><i class="pe-7s-delete-user"></i></a>';
            return $edit_icon .'&nbsp;'. $delete_icon;
        })
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
    public function store(TagStore $request)
    {
        $tag = new Tag();
        $tag->name = $request->name;
        $tag->slug = $request->slug;
        $tag->description = $request->description;

        $tag->save();
        return redirect()->route('admin.tag.index')->with('create','Successfully Created');
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
        $edit_tag = Tag::findOrFail($id);
        return view('backend.tag.edit',compact('edit_tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TagUpdate $request, $id)
    {
        $tag_edit = Tag::findOrFail($id);
        $tag_edit->name = $request->name;
        $tag_edit->slug = $request->slug;
        $tag_edit->description = $request->description;
        $tag_edit->update();
        
        return redirect()->route('admin.tag.index')->with('update','Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag_del = Tag::findOrFail($id);
        $tag_del->delete();

        return 'success';
    }
}
