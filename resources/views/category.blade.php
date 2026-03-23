@extends('app')
@section('title','Category')

@section('content')
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Category</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Category</li>
                    </ol>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content Header-->
    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <!--begin::Col-->
                <div class="col-md-6">
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <form action="{{ $editdata ? route('category.update',$editdata->id) : route('category.store') }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        @if($editdata)
                        @method('PUT')
                        @endif
                        <input type="hidden" name="catid" id="catid" value="{{ $editdata ? $editdata->id : '' }}">
                        <div class="form-group">
                            <label for="catname">Category</label>
                            <input type="text" name="catname" id="catname" class="form-control"
                                value="{{ $editdata ? $editdata->catname : '' }}">
                            @error('catname')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="catimg">Category Image</label>
                            <input type="file" name="image" id="image" class="form-control-file">
                            <img src="{{ $editdata?asset('catimages/'.$editdata->image):'' }}" width="100" height="100">
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <table class="table table-bordered">
        <caption>Category List</caption>
        <thead class="thead-light">
            <tr>
                <th>Id</th>
                <th>Image</th>
                <th>Category</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($catdata as $cat)
            <tr>
                <td>{{ $cat->id }}</td>
                <td><img src="{{ asset('catimages/'.$cat->image) }}" width="100" height="100"></td>
                <td>{{ $cat->catname }}</td>
                <td>
                    <form action="{{ route('category.edit',$cat->id) }}" method="post" style="display:inline;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-warning btn-sm">Edit</button>
                    </form>
                    <form action="{{ route('category.destroy',$cat->id) }}" method="post" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->

            <!-- /.row (main row) -->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
</main>

@endsection