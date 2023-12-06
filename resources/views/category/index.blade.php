@extends('backend_template')
@section('content')
    <div class="page-header">
        <h3 class="page-title">Category Table</h3>
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Item</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Category </li>
        </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    
                    <form action="{{ $category ? route('category.update', $category->id) : route('category.store') }}" class="category-form" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        @if($category)
                            @method('PUT')
                        @endif

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="cat_name">Category Name</label>
                                    <input type="text" class="form-control" id="cat_name" name="cat_name" value="{{ $category ? $category->category_name :  old('cat_name') }}" placeholder="Category Name" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <button type="submit" class="btn btn-primary mr-2 mt-4"> Submit </button>
                            </div>
                        </div>
                    </form>

                    <!-- Categry Table -->
                    <div class="table-responsive">
                        <table class="table" id="category_tbl">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Category Name</th>
                                    <th>Created</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
    $(document).ready(function () {
        $('#category_tbl').DataTable({
            "serverSide": true,
            "processing": true,
            "paging": true,
            "searching": { "regex": true },
            "pageLength": 10,
            ajax: "{{ route("category.index") }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'category_name', name: 'category_name' },
                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });

        // Edit button click event
        $('#category_tbl').on('click', '.edit', function(){
            var id = $(this).data('id');
            window.location.href = '/category/' + id + '/edit';
        });

        // Delete button click event
        $('#category_tbl').on('click', '.delete', function(){
            var id = $(this).data('id');
            var table = $(this).data('table');
            if (del()) {
                $.ajax({
                    type: 'DELETE',
                    url: 'category/' + id,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        console.log(response);
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            }
        });

    });
</script>
@endsection