<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Category Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h4>Category Page</h4>
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <form action="{{ $editdata ? route('product.update',$editdata->id) : route('product.store') }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @if($editdata)
            @method('PUT')
            @endif
            <input type="hidden" name="productid" id="productid" value="{{ $editdata ? $editdata->id : '' }}">
            <div class="form-group">
                <label>Category</label>
                <select name="cat_id" id="cat_id" class="form-control">
                    <option value="">--Select Category--</option>
                    @foreach ($catdata as $cat)
                    <option value={{ $cat->id }} {{ $editdata && $editdata->cat_id ==$cat->id ?'selected':'' }}>{{
                        $cat->catname }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Subcategory</label>
                <select name="subcat_id" id="subcat_id" class="form-control">
                    <option value="">--Select Subcategory--</option>
                    @if ($editdata)
                        @foreach ($subcatdata as $s)
                            <option value="{{ $s->id }}" {{ $s->id == $editdata->subcat_id ?"selected":"" }}>{{ $s->subcatname }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="form-group">
                <label for="subcatname">Product</label>
                <input type="text" name="name" id="name" class="form-control"
                    value="{{ $editdata ? $editdata->name : '' }}">
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="catimg">product Image</label>
                <input type="file" name="image" id="image" class="form-control-file">
                <br><br>
                <img src="{{ $editdata?asset('productimage/'.$editdata->image):'' }}" width="100" height="100">
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" name="price" id="price" class="form-control"
                    value="{{ $editdata ? $editdata->price : '' }}">
                @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
        <br><br>
        <table class="table table-bordered">
            <caption>product List</caption>
            <thead class="thead-light">
                <tr>
                    <th>Id</th>
                    <th>Category</th>
                    <th>Subcategory</th>
                    <th>Product</th>
                    <th>image</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
             @foreach ($products as $pr)
            <tr>
            <td>{{ $pr->id }}</td>
            <td>{{ $pr->category->catname }}</td>
            <td>{{ $pr->subcategory->subcatname }}</td>
            <td>{{ $pr->name }}</td>
            <td>
            <img src="{{ asset('productimage/'.$pr->image) }}" width="100" height="100">
            </td>

            <td>{{ $pr->price }}</td>

            <td>
            <form action="{{ route('product.edit',$pr->id) }}" method="post" style="display:inline;">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-warning btn-sm">Edit</button>
        </form>

            <form action="{{ route('product.destroy',$pr->id) }}" method="post" style="display:inline;">
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
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js" type="text/javascript"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script>
        $(document).ready(function(){
        $("#cat_id").on('change',function(){
        let catid = $('#cat_id').val()

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
         $.ajax({
            url:"/getSubcat",
            method:"post",
            data:{
                "cat_id":catid,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                res = "<option>Select Subcategory</option>"
               res += data.map((i)=>{
                    return `<option value=${i.id}>${i.subcatname}</option>`
               })  
               $("#subcat_id").html(res)             
            },
            error:function(err){
                console.log(err);      
            }
        })
            })
        })
    //    function getSubcatData(){
    //     alert('hii')
       
    //    }
    </script>
</body>


</html>