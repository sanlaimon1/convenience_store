@extends('backend_template')
@section('content')
    <div class="page-header">
        <h3 class="page-title">Category Tables</h3>
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
                        <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Category Name</th>
                                <th>Created</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                            <tbody>
                                @foreach($categories as $key => $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->category_name }}</td>
                                    <td>{{ $category->created_at }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('category.show', ['category'=>$category->id]) }}" class="btn btn-primary">
                                                <i class="mdi mdi-pencil-box"></i>
                                            </a>
                                            <form action="{{ route('category.destroy', ['category'=>$category->id]) }}" method="post" onsubmit="javascript:return del()">
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