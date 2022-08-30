<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminUserController extends Controller
{

    use HasFactory;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.all_user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.all_user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $all_user = new User();
        $all_user->name = $request->name;
        $all_user->email = $request->email;
        $all_user->password = Hash::make($request->password);
        switch ($request->role) {
            case 'is_admin':
                $all_user->is_admin = 1;
                $all_user->is_shopowner = 0;
                $all_user->is_seller = 0;
                $all_user->is_user = 0;
                break;
            case 'is_shopowner':
                $all_user->is_admin = 0;
                $all_user->is_shopowner = 1;
                $all_user->is_seller = 0;
                $all_user->is_user = 0;
                break;
            case 'is_seller':
                $all_user->is_admin = 0;
                $all_user->is_shopowner = 0;
                $all_user->is_seller = 1;
                $all_user->is_user = 0;
                break;                                    
            default:
                $all_user->is_admin = 0;
                $all_user->is_shopowner = 0;
                $all_user->is_seller = 0;
                $all_user->is_user = 1;
                break;
        }
        $all_user->save();

        return redirect()->route('admin.all-user.index')->with('create','Successfully Created');
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
        $edit_user = User::findOrFail($id);
        return view('backend.all_user.edit',compact('edit_user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user_edit = User::findOrFail($id);
        $user_edit->name = $request->name;
        $user_edit->email = $request->email;
        switch ($request->role) {
            case 'Admin':
                $user_edit->is_admin = 1;
                $user_edit->is_shopowner = 0;
                $user_edit->is_seller = 0;
                $user_edit->is_user = 0;
                break;
            case 'Owner':
                $user_edit->is_admin = 0;
                $user_edit->is_shopowner = 1;
                $user_edit->is_seller = 0;
                $user_edit->is_user = 0;
                break;
            case 'Seller':
                $user_edit->is_admin = 0;
                $user_edit->is_shopowner = 0;
                $user_edit->is_seller = 1;
                $user_edit->is_user = 0;
                break;                                    
            case 'User':
                $user_edit->is_admin = 0;
                $user_edit->is_shopowner = 0;
                $user_edit->is_seller = 0;
                $user_edit->is_user = 1;
                break;
        }
        $user_edit->password = $request->password ? Hash::make($request->password) : $user_edit->password;
        $user_edit->update();

        return redirect()->route('admin.all-user.index')->with('update','Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user_del = User::findOrFail($id);
        $user_del->delete();

        return 'success';
    }

    public function ssd()
    {
        $data = User::query();
        return Datatables::of($data)
        ->addColumn('role', function($each){
            switch (1) {
                case $each->is_admin:
                    return "Admin";
                    break;

                case $each->is_shopowner:
                    return "Owner";
                    break;
                    
                case $each->is_seller:
                    return "Seller";
                    break;
                
                default:
                    return "User";
                    break;
            }
        })
        ->editColumn('created_at',function($each){
            return Carbon::parse($each->created_at)->format('Y-m-d H:i:s');
        })
        ->editColumn('updated_at',function($each){
            return Carbon::parse($each->updated_at)->format('Y-m-d H:i:s');
        })
        ->addColumn('action',function($each){
            $show_icon = '<a href="#" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit"><i class="pe-7s-look"></i></a>';
            $edit_icon = '<a href="'.route("admin.all-user.edit" , $each->id ).'" class="btn btn-sm btn-outline-secondary" data-toggle="tooltip" title="Edit"><i class="pe-7s-edit"></i></a>';
            $delete_icon = '<a href="#" class="btn btn-sm btn-outline-danger delete" data-id="'.$each->id.'"><i class="pe-7s-delete-user"></i></a>';
            return $show_icon .'&nbsp;'. $edit_icon .'&nbsp;'. $delete_icon;
        })
        ->make(true);
    }
}
