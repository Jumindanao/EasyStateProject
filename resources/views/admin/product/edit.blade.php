@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Add Product</h4>
        </div>
        <div class="card-body">
           <form action="{{ url('update-product/'.$products->id) }}" method="POST" enctype="multipart/form-data">
              @method('PUT')
              @csrf
                <div class="row">
                    <div class="col-md-12 mb-3"> 
                    <label for="">Category</label>
                    <select class="form-select" name="cate_id">
                    <<option value="">{{$products->category->name}}</option>
                    </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Product name</label>
                        <input type="text" class="form-control" value="{{ $products->prodname}}" name="prodname" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Small Description</label>
                        <input type="text" row="3" class="form-control" value="{{ $products->small_description}}" name="small_description" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Description</label>
                    <textarea name="description"  rows="3" class="form-control" required>{{ $products->description}}</textarea>
                    <br>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Original Price </label>
                        <input type="number" min="0"   name="original_price" class="form-control" value="{{ $products->original_price}}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Selling Price</label>
                        <input type="number" min="0"     name="selling_price" class="form-control" value="{{ $products->selling_price}}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">quantity</label>
                        <input type="number" min="0" max="99" name="quantity" class="form-control" value="{{ $products->quantity}}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Tax</label>
                        <input type="number" name="tax" class="form-control" value="{{ $products->tax}}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Status:</label> 
                        <input type="checkbox" {{ $products->status == "1" ? 'checked' : '' }} name="status">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Trending:</label>
                        <input type="checkbox" {{ $products->trending == "1" ? 'checked' : '' }} name="trending">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Meta Title</label>
                        <input type="text"  row="3" class="form-control" value="{{ $products->meta_title}}" name="meta_title" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Meta Keywords</label>
                        <textarea name="meta_keywords"  class="form-control" required>{{ $products->meta_keywords}}</textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Meta Description</label>
                        <textarea name="meta_description"  rows="3" class="form-control" required>{{ $products->meta_description}}</textarea>
                    </div>
                    @if($products->image)
                        <img src="{{ asset('assets/uploads/products/'.$products->image)}}" alt="">
                    @endif
                    <div class="col-md-6 mb-3">
                       <input type="file" name="image" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                       <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
           </form>
        </div>
    </div>
@endsection
