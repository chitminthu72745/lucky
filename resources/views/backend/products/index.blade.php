@extends('backend.layouts.app')
@section('title','All Product')
@section('products','mm-active')
@section('products_expanded','mm-show')
@section('all_product','mm-active')
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-keypad icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>
                All Product
            </div>
        </div>   
    </div>
</div>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table id="category" class="table table-bordered w-100">
                        <thead>
                            <tr>
                                <th width="0">Image</th>
                                <th>Product Name</th>
                                <th>Stock</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Latest Create</th>
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
                    "ajax": "{{ route('admin.products') }}",
                    "columns": [
                        { "data": "image", "name": "image" },
                        { "data": "name", "name": "name" },
                        { "data": "stock_status", "name": "stock_status" },
                        { "data": "regular_price", "name": "regular_price" },
                        { "data": "cat_name", "name": "cat_name" },
                        { "data": "created_at", "name": "created_at" },
                        { "data": "updated_at", "name": "updated_at" },
                        { "data": "action", "name": "action" }
                    ],
                    "order": [
                        [6,"desc"]
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
                        url: 'products/' + id,
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