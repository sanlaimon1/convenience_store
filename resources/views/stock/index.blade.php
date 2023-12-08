@extends('backend_template')
@section('content')
    <div class="page-header">
        <h3 class="page-title">Stock Table</h3>
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Item</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Stock </li>
        </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    
                    <form action="{{ $stock ? route('stock.update', $stock->id) : route('stock.store') }}" class="stock-form" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        @if($stock)
                            @method('PUT')
                        @endif

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="prod_name">Product Name</label>
                                    <!-- <input type="text" class="form-control" id="prod_name" name="prod_name" value="{{ $stock ? $stock->prod_name :  old('prod_name') }}" placeholder="Product Name" /> -->
                                    <select class="js-example-basic-single form-control" style="width: 100%" name='prod_id'>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="qty">Quantity</label>
                                    <input type="text" class="form-control" id="qty" name="qty" value="{{ $stock ? $stock->quantity :  old('qty') }}" placeholder="Quantity" />
                                    @error('qty')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <button type="submit" class="btn btn-primary mr-2 mt-4"> Submit </button>
                            </div>
                        </div>
                    </form>

                    <!-- Categry Table -->
                    <div class="table-responsive">
                        <table class="table" id="stock_tbl">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Prodcut Code</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
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
        var table =  $('#stock_tbl').DataTable({
            "serverSide": true,
            "processing": true,
            "paging": true,
            "searching": { "regex": true },
            "pageLength": 10,
            ajax: "{{ route("stock.index") }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'product.product_code', name: 'product.product_code' },
                { data: 'product.product_name', name: 'product.product_name' },
                { data: 'quantity', name: 'quantity' },
                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });

        // Edit button click event
        $('#stock_tbl').on('click', '.edit', function(){
            var id = $(this).data('id');
            window.location.href = '/stock/' + id + '/edit';
        });

        // Delete button click event
        $('#stock_tbl').on('click', '.delete', function(){
            var id = $(this).data('id');
            var url = "{{ route('stock.destroy', ['stock' => ':id']) }}";
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