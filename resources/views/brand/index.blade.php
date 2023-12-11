@extends('backend_template')
@section('content')
    <div class="page-header">
        <h3 class="page-title">Brand Tables</h3>
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Item</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Brand </li>
        </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    
                    <form action="{{ $brand ? route('brand.update', $brand->id) : route('brand.store') }}" class="brand-form" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        @if($brand)
                            @method('PUT')
                        @endif

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="brand_name">Brand Name</label>
                                    <input type="text" class="form-control" id="brand_name" name="brand_name" value="{{ $brand ? $brand->brand_name :  old('brand_name') }}" placeholder="Brand Name" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <button type="submit" class="btn btn-primary mr-2 mt-4"> Submit </button>
                            </div>
                        </div>
                    </form>

                    <!-- brand Table -->
                    <div class="table-responsive">
                        <table class="table" id="brand_tbl">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Brand Name</th>
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
        var table =  $('#brand_tbl').DataTable({
            "serverSide": true,
            "processing": true,
            "paging": true,
            "searching": { "regex": true },
            "pageLength": 10,
            ajax: "{{ route("brand.index") }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'brand_name', name: 'brand_name' },
                { data: 'created_at', "render": function (value) {
                            if (value === null) return "";
                            return moment(value).format('DD/MM/YYYY');
                        }},
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });

        // Edit button click event
        $('#brand_tbl').on('click', '.edit', function(){
            var id = $(this).data('id');
            window.location.href = '/brand/' + id + '/edit';
        });

        // Delete button click event
        $('#brand_tbl').on('click', '.delete', function(){
            var id = $(this).data('id');
            var url = "{{ route('brand.destroy', ['brand' => ':id']) }}";
            url = url.replace(':id', id);
            if (del()) {
                $.ajax({
                    type: 'POST',
                    data: { _method: 'DELETE'},
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        console.log(response);
                        table.ajax.reload();
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