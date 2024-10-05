@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Add Property</h4>
        </div>
        <div class="card-body">
            <form action="{{ url('insert-product') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <select class="form-select" name="categoryid" required>
                            <option value="">Select Category</option>
                            @foreach ($category as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Property name</label>
                        <input type="text" class="form-control" name="prodname" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Small Description</label>
                        <input type="text" row="3" class="form-control" name="small_description" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Description</label>
                        <textarea name="description" rows="3" class="form-control" required></textarea>
                        <br>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Original Price </label>
                        <input type="number" min="0" name="original_price" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Selling Price</label>
                        <input type="number" min="0" name="selling_price" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">quantity</label>
                        <input type="number" min="0" max="99" name="quantity" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Tax</label>
                        <input type="number" name="tax" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Status:</label>
                        <input type="checkbox" name="status">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Trending:</label>
                        <input type="checkbox" name="trending">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Meta Title</label>
                        <input type="text" row="3" class="form-control" name="meta_title" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Meta Keywords</label>
                        <textarea name="meta_keywords" class="form-control" required></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Meta Description</label>
                        <textarea name="meta_description" rows="3" class="form-control" required></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <input type="file" name="image" row="3" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <input type="submit" class="btn btn-primary"></input>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
