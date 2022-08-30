<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attribute;
use App\Models\Term;
use App\Http\Requests\AttributeStore;
use App\Http\Requests\AttributeUpdate;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.attribute.index');
    }

    public function ssd()
    {   
        $data = Attribute::query();
        return Datatables::of($data)
        ->editColumn('created_at',function($each){
            return Carbon::parse($each->created_at)->format('Y-m-d H:i:s');
        })
        ->editColumn('updated_at',function($each){
            return Carbon::parse($each->updated_at)->format('Y-m-d H:i:s');
        })
        ->addColumn('terms',function($each){


            $terms_data = Term::where("terms.attribute_id", $each->id)->get('terms.terms_name');
            $term = '';
            foreach ($terms_data as $terms) {
                $term .= $terms['terms_name'].', ';
            }
            $terms = '<a href="'.route("admin.addTermData" , $each->id ).'" class="text-primary" data-toggle="tooltip" title="Configure terms">Configure terms</a>';

            return $term .'<br>'. $terms;
        })
        ->addColumn('action',function($each){
            $edit_icon = '<a href="'.route("admin.attribute.edit" , $each->id ).'" class="btn btn-sm btn-outline-secondary" data-toggle="tooltip" title="Edit"><i class="pe-7s-edit"></i></a>';
            $delete_icon = '<a href="#" class="btn btn-sm btn-outline-danger delete" data-id="'.$each->id.'"><i class="pe-7s-delete-user"></i></a>';
            return $edit_icon .'&nbsp;'. $delete_icon;
        })
        ->rawColumns(['terms', 'action'])
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
    public function store(AttributeStore $request)
    {
        $attribute = new Attribute();
        $attribute->name = $request->name;
        $attribute->slug = $request->slug;
        $attribute->type = $request->type;

        $attribute->save();
        return redirect()->route('admin.attribute.index')->with('create','Successfully Created');
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
        $edit_attribute = Attribute::findOrFail($id);
        return view('backend.attribute.edit',compact('edit_attribute'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AttributeUpdate $request, $id)
    {
        $attribute_edit = Attribute::findOrFail($id);
        $attribute_edit->name = $request->name;
        $attribute_edit->slug = $request->slug;
        $attribute_edit->type = $request->type;
        $attribute_edit->update();
        
        return redirect()->route('admin.attribute.index')->with('update','Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attribute_del = Attribute::findOrFail($id);
        $attribute_del->delete();

        return 'success';
    }
}
