@extends('backend.layouts.app')
@section('title','Edit User')
@section('user','mm-active')
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-users icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>
                Edit User
            </div>
        </div>   
    </div>
</div>

<div class="content">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.all-user.update', $edit_user->id) }}" method="POST" id="update">
                @include('backend.layouts.flash')
                @csrf
                @method('PUT')
                
                <div class="form-group">
                  <label for="">Name</label>
                  <input type="text"
                    class="form-control" name="name" id="" aria-describedby="helpId" placeholder="name" value="{{$edit_user->name}}">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email"
                        class="form-control" name="email" id="" aria-describedby="helpId" placeholder="Email" value="{{$edit_user->email}}">
                </div>
                <div class="form-group">
                    <label for="">Role</label>
                    <select name="role" id="" class="form-control">
                        <?php 
                            $arys = array(
                                'Admin' => $edit_user->is_admin, 
                                'Owner' => $edit_user->is_shopowner,
                                'Seller' => $edit_user->is_seller, 
                                'User' => $edit_user->is_user,
                            );
                            foreach ($arys as $ary => $role) {
                                if ($role == 1) {
                                    ?>
                                    <option value="<?php echo $ary; ?>">
                                       <?php echo $ary; ?>
                                    </option>
                                    <?php
                                }
                            }

                            foreach ($arys as $ary => $role) {
                                if ($role == 0) {
                                    ?>
                                    <option value="<?php echo $ary; ?>">
                                       <?php echo $ary; ?>
                                    </option>
                                    <?php
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password"
                        class="form-control" name="passsword" id="" aria-describedby="helpId" placeholder="Password">
                </div>
                <div class="text-right">
                    <button class="btn btn-secondary btn-back mr-3">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
{{-- {!! JsValidator::formRequest('App\Http\Requests\AdminUserUpdate','#update') !!} --}}
@endsection