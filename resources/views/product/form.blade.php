@extends('backend_template')
@section('content')
    <div class="page-header">
        <h3 class="page-title">Product Tables</h3>
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Item</a></li>
            <li class="breadcrumb-item active" aria-current="page"> <a href="{{route('product.index')}}">Product</a> </li>
        </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    
                    <form action="{{ $product ? route('product.update', $product->id) : route('product.store') }}" class="product-form" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        @if($product)
                            @method('PUT')
                        @endif

                        <div class="row">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="product_name">Product Name</label>
                                    <input type="text" class="form-control" id="product_name" name="product_name" value="{{ $product ? $product->product_name :  old('product_name') }}" placeholder="Product Name" />
                                    @error('product_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="model_year">Date</label>
                                    <input type="date" class="form-control" id="model_year" name="model_year" value="{{ $product ? $product->model_year :  old('model_year') }}" placeholder="Date" />
                                    @error('model_year')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="list_price">Price</label>
                                    <input type="number" class="form-control" id="list_price" name="list_price" value="{{ $product ? $product->list_price :  old('list_price') }}" placeholder="Price" min="0"/>
                                    @error('list_price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="category">Category</label>
                                        <select class="js-example-basic-single form-control" style="width: 100%" name='category'>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" @if($product) @if($product->category_id == $category->id) selected @endif @endif>{{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                </div>
                            </div>
                            <div class="col-lg-5">

                                <div class="form-group">
                                    <label for="brand">Brand</label>
                                        <select class="js-example-basic-single form-control" style="width: 100%" name='brand'>
                                            @foreach($brands as $brand)
                                                <option value="{{ $brand->id }}" @if($product) @if($product->brand_id == $brand->id) selected @endif @endif>{{ $brand->brand_name }}</option>
                                            @endforeach
                                        </select>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <button type="submit" class="btn btn-primary mr-2 mt-4"> Submit </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection