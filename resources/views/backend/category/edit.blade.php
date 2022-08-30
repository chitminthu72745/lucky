@extends('backend.layouts.app')
@section('title','Edit Category')
@section('products','mm-active')
@section('products_expanded','mm-show')
@section('category','mm-active')
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-users icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>
                Edit Category
            </div>
        </div>   
    </div>
</div>

<div class="content">
    <div class="row">
        <div class="col-md-6 offset-3">
            <div class="card">
                <div class="card-body">        
                    <form action="{{ route('admin.category.update', $edit_category->id) }}" method="post" enctype="multipart/form-data" id="update">
                        <h5>
                            Edit Category
                        </h5>
                        @include('backend.layouts.flash')
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <img src="{{asset('uploads/'.$edit_category->image)}}" id="edit_image" width="100" class="img img-thumbnail"><br>
                            <label for="image" class="btn btn-sm btn-outline-primary" style="display: inline-block; width: 100px;">Add Image</label>
                            <input type="file" class="form-control d-none" name="image" id="image">
                        </div>
                        <div class="form-group">
                          <label for="">Name</label>
                          <input type="text"
                            class="form-control" name="name" id="" aria-describedby="helpId" value="{{$edit_category->name}}">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                              <textarea name="description" class="form-control" aria-describedby="helpId" id="description" cols="20" rows="5" value="{{$edit_category->description}}">{{$edit_category->description}}</textarea>
                        </div>
                        <div class="text-right">
                            <button class="btn btn-secondary btn-back mr-3">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Create">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
{!! JsValidator::formRequest('App\Http\Requests\CategoryUpdate','#update') !!}
@endsection