@extends('backend.layouts.app')
@section('title','Add New User')
@section('user-create','mm-active')
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
                Add New User
            </div>
        </div>   
    </div>
</div>

<div class="content">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.all-user.store') }}" method="POST" id="create">
                @include('backend.layouts.flash')
                @csrf
                <div class="form-group">
                  <label for="">Name</label>
                  <input type="text"
                    class="form-control" name="name" id="" aria-describedby="helpId" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email"
                      class="form-control" name="email" id="" aria-describedby="helpId" placeholder="Email">
                  </div>
                  <div class="form-group">
                    <label for="">Role</label>
                    <select name="role" id="" class="form-control">
                        <option value="is_admin">Admin</option>
                        <option value="is_shopowner">Shop Owner</option>
                        <option value="is_seller">Seller</option>
                        <option value="is_user">User</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="">Password</label>
                    <input type="password"
                      class="form-control" name="password" id="" aria-describedby="helpId" placeholder="Password">
                  </div>
                  <div class="text-right">
                    <button class="btn btn-secondary btn-back mr-3">Cancel</button>
                    <input type="submit" class="btn btn-primary" value="Create">
                  </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
{{-- {!! JsValidator::formRequest('App\Http\Requests\AdminUserStore','#create') !!} --}}
@endsection