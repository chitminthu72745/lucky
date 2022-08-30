@extends('backend.layouts.app')
@section('title','Dashboard')
@section('all-user','mm-active')
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
                All Users                                    
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="card">
        <div class="card-header">
            <a href="{{route('admin.all-user.create')}}" class="btn btn-primary"> Add User <i class="pe-7s-add-user"></i></a>
        </div>
        <div class="card-body">
            <table id="example" class="table table-bordered w-100">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
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
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            var table = $('#example').DataTable(
                {
                    "processing": true,
                    "serverSide": true,
                    "ajax": "{{ route('admin.datatable') }}",
                    "columns": [
                        { "data": "name", "name": "name" },
                        { "data": "email", "name": "email" },
                        { "data": "role", "name": "role"},
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
                        url: 'all-user/' + id,
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
@endsection