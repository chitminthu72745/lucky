<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Term;
use App\Models\Attribute;
use App\Http\Requests\TermsStore;
use App\Http\Requests\TermsUpdate;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;

class TermsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.terms.index');
    }

    public function addTermData($id)
    {
        // $create_terms = Attribute::findOrFail($id)->id;
        return view('backend.terms.index',compact('id'));
    }

    public function ssd($id)
    {
        $data = Term::query()->where("attribute_id",$id);
        return Datatables::of($data)
        ->editColumn('description',function($each){
            if($each->description == ""){
                return "-";
            }
            return $each->description;
        })
        ->editColumn('created_at',function($each){
            return Carbon::parse($each->created_at)->format('Y-m-d H:i:s');
        })
        ->editColumn('updated_at',function($each){
            return Carbon::parse($each->updated_at)->format('Y-m-d H:i:s');
        })
        ->addColumn('action',function($each){
            $edit_icon = '<a href="'.route("admin.terms.edit" , $each->id ).'" class="btn btn-sm btn-outline-secondary" data-toggle="tooltip" title="Edit"><i class="pe-7s-edit"></i></a>';
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
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TermsStore $request)
    {   
        $terms = new Term();
        $terms->attribute_id = $request->create_terms;
        $terms->terms_name = $request->name;
        $terms->slug = $request->slug;
        $terms->description = $request->description == "" ? "" : $request->description;

        $terms->save();
        return back();
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
        $edit_terms = Term::findOrFail($id);
        return view('backend.terms.edit',compact('edit_terms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TermsUpdate $request, $id)
    {
        $terms_edit = Term::findOrFail($id);
        $terms_edit->terms_name = $request->name;
        $terms_edit->slug = $request->slug;
        $terms_edit->description = $request->description == "" ? "" : $request->description;
        $terms_edit->update();
        
        return redirect("admin/terms/create-terms/".$id)->with('update','Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $terms_del = Term::findOrFail($id);
        $terms_del->delete();

        return 'success';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $terms_del = Term::findOrFail($id);
        $terms_del->delete();

        return 'success';
    }
}
