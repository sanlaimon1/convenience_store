@extends('backend_template')
@section('content')
    <div class="page-header">
        <h3 class="page-title">Product Tables</h3>
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Item</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Product </li>
        </ol>
        </nav>
    </div>
    <div class="row">
        <a href="{{ route('product.create') }}" class="btn btn-primary ml-3 mb-2 text-white">
            <i class="mdi mdi-plus"></i> Add Product
        </a>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="product_tbl">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Product Code</th>
                                    <th>Product Name</th>
                                    <th>Model Year</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                    <th>Brand</th>
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
        var table = $('#product_tbl').DataTable({
            "serverSide": true,
            "processing": true,
            "paging": true,
            "searching": { "regex": true },
            "pageLength": 10,
            ajax: "{{ route("product.index") }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'product_code', name: 'product_code' },
                { data: 'product_name', name: 'product_name' },
                { data: 'model_year', name: 'model_year' },
                { data: 'list_price', name: 'list_price' },
                { data: 'category_id', name: 'category' },
                { data: 'brand_id', name: 'brand' },
                { data: 'created_at', "render": function (value) {
                            if (value === null) return "";
                            return moment(value).format('DD/MM/YYYY');
                        }},
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });


         // Delete button click event
         $('#product_tbl').on('click', '.delete', function(){
            var id = $(this).data('id');
            var url = "{{ route('product.destroy', ['product' => ':id']) }}";
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