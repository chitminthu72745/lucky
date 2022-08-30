@extends('backend.layouts.app')
@section('title','Tag')
@section('products','mm-active')
@section('products_expanded','mm-show')
@section('tag','mm-active')
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-shopbag icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>
                Tags
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="row">
        <div class="col-4">
            <form action="{{ route('admin.tag.store') }}" method="post" enctype="multipart/form-data" id="create">
                <h5>
                    Add New Category
                </h5>
                @include('backend.layouts.flash')
                @csrf
                <div class="form-group">
                  <label for="tag">Tag</label>
                  <input type="text"
                    class="form-control" name="name" id="tag" aria-describedby="helpId">
                </div>
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text"
                      class="form-control" name="slug" id="slug" aria-describedby="helpId">
                  </div>
                <div class="form-group">
                    <label for="description">Description</label>
                      <textarea name="description" class="form-control" aria-describedby="helpId" id="description" cols="20" rows="5"></textarea>
                </div>
                <div class="text-right">
                    <button class="btn btn-secondary btn-back mr-3">Cancel</button>
                    <input type="submit" class="btn btn-primary" value="Create">
                </div>
            </form>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <table id="category" class="table table-bordered w-100">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Description</th>
                                <th class="hidden-data">Latest Create</th>
                                <th class="hidden-data">Latest Update</th>
                                <th class="no-sort" width="100">Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            var table = $('#category').DataTable(
                {
                    "processing": true,
                    "serverSide": true,
                    "ajax": "{{ route('admin.tag') }}",
                    "columns": [
                        { "data": "name", "name": "name" },
                        { "data": "slug", "name": "slug" },
                        { "data": "description", "name": "description"},
                        { "data": "created_at", "name": "created_at" },
                        { "data": "updated_at", "name": "updated_at" },
                        { "data": "action", "name": "action" }
                    ],
                    "order": [
                        [5,"desc"]
                    ],
                    "columnDefs": [
                        { "targets": "hidden-data", "visible": false},
                        { "targets": "no-sort", "searchable": false, "sortable": false}
                    ]
                }
            );

            $(document).on('click', '.delete', function(e){
                e.preventDefault();
                var id = $(this).data('id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to delete this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'tag/' + id,
                        type: 'DELETE',
                        success: function(){
                            Swal.fire(
                                'Deleted!',
                                'User has been deleted.',
                                'success'
                            )
                            table.ajax.reload();
                        }
                    });
                    
                }
                })
            });
        })
    </script>
    {!! JsValidator::formRequest('App\Http\Requests\CategoryStore','#create') !!}
@endsection