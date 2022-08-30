@extends('backend.layouts.app')
@section('title','Edit Tag')
@section('products','mm-active')
@section('products_expanded','mm-show')
@section('attribute','mm-active')
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-users icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>
                Edit Attribute
            </div>
        </div>   
    </div>
</div>

<div class="content">
    <div class="row">
        <div class="col-md-6 offset-3">
            <div class="card">
                <div class="card-body">        
                    <form action="{{ route('admin.attribute.update', $edit_attribute->id) }}" method="post" enctype="multipart/form-data" id="update">
                        <h5>
                            Edit Tag
                        </h5>
                        @include('backend.layouts.flash')
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                          <label for="">Name</label>
                          <input type="text"
                            class="form-control" name="name" id="" aria-describedby="helpId" value="{{$edit_attribute->name}}">
                        </div>
                        <div class="form-group">
                            <label for="">Slug</label>
                            <input type="text"
                              class="form-control" name="slug" id="" aria-describedby="helpId" value="{{$edit_attribute->slug}}">
                          </div>
                        <div class="form-group">
                            <label for="type">Type</label>
                            <input type="text"
                              class="form-control" name="type" id="type" aria-describedby="helpId" value="{{$edit_attribute->type}}">
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
{!! JsValidator::formRequest('App\Http\Requests\AttributeUpdate','#update') !!}
@endsection