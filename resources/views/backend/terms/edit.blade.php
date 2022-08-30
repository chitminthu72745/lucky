@extends('backend.layouts.app')
@section('title','Edit Tag')
@section('products','mm-active')
@section('products_expanded','mm-show')
@section('terms','mm-active')
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-users icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>
                Edit Terms
            </div>
        </div>   
    </div>
</div>

<div class="content">
    <div class="row">
        <div class="col-md-6 offset-3">
            <div class="card">
                <div class="card-body">        
                    <form action="{{ route('admin.terms.update', $edit_terms->id) }}" method="post" id="update">
                        <h5>
                            Edit Tag
                        </h5>
                        @include('backend.layouts.flash')
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                          <label for="">Name</label>
                          <input type="text"
                            class="form-control" name="name" id="" aria-describedby="helpId" value="{{$edit_terms->terms_name}}">
                        </div>
                        <div class="form-group">
                            <label for="">Slug</label>
                            <input type="text"
                              class="form-control" name="slug" id="" aria-describedby="helpId" value="{{$edit_terms->slug}}">
                          </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                              <textarea name="description" class="form-control" aria-describedby="helpId" id="description" cols="20" rows="5" value="{{$edit_terms->description}}">{{$edit_terms->description}}</textarea>
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
{!! JsValidator::formRequest('App\Http\Requests\TermsUpdate','#update') !!}
@endsection