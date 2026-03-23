@extends('app')
@section('title','Subcategory')

@section('content')

 <div class="container mt-5">
        <h4>Category Page</h4>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ $editdata ? route('subcategory.update',$editdata->id) : route('subcategory.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @if($editdata)
            @method('PUT')
            @endif
            <input type="hidden" name="subcatid" id="subcatid" value="{{ $editdata ? $editdata->id : '' }}">
            <div class="form-group">
                <label>Category</label>
                <select name="category_id" id="category_id" class="form-control">
                    <option value="">--Select Category--</option>
                    @foreach ($categories as $cat)
                        <option value={{ $cat->id }} {{ $editdata && $editdata->category_id ==$cat->id ? 'selected':'' }}>
                        {{ $cat->catname }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="subcatname">Subcategory</label>
                <input type="text" name="subcatname" id="subcatname" class="form-control"
                    value="{{ $editdata ? $editdata->subcatname : '' }}">
                @error('subcatname')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
        <br><br>
        <table class="table table-bordered">
            <caption>Subcategory List</caption>
            <thead class="thead-light">
                <tr>
                    <th>Id</th>
                    <th>Category</th>
                    <th>Subcategory</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subcategories as $subcat)
                <tr>
                    <td>{{ $subcat->id }}</td>
                    <td>{{ $subcat->category->catname }}</td>
                    <td>{{ $subcat->subcatname }}</td>
                    <td>
                        <form action="{{ route('subcategory.edit',$subcat->id) }}" method="post" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-warning btn-sm">Edit</button>
                        </form>
                        <form action="{{ route('subcategory.destroy',$subcat->id) }}" method="post" style="display:inline;">
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
@endsection