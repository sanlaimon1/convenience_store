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
                        <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Brand Name</th>
                                <th>Created</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                            <tbody>
                                @foreach($brands as $key => $brand)
                                <tr>
                                    <td>{{ $brand->id }}</td>
                                    <td>{{ $brand->brand_name }}</td>
                                    <td>{{ $brand->created_at }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('brand.show', ['brand'=>$brand->id]) }}" class="btn btn-primary">
                                                <i class="mdi mdi-pencil-box"></i>
                                            </a>
                                            <form action="{{ route('brand.destroy', ['brand'=>$brand->id]) }}" method="post" onsubmit="javascript:return del()">
                                                {{ csrf_field() }}
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="mdi mdi-delete-forever"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection