@extends('layouts.front')

@section('title')
    My favorites
@endsection
@section('content')
    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6 class="mb-0">
                <a href="{{ url('/') }}" style="text-decoration: none; color: inherit;">
                    Home
                </a> /
                <a href="{{ url('wishlist') }}" style="text-decoration: none; color: inherit;">
                    My favorites
                </a> /
            </h6>
        </div>
    </div>


    <div class="container my-5">
        <div class="card shadow">
            <div class="card-body">
                @if ($wishlist->count() > 0)
                    @foreach ($wishlist as $item)
                        <div class="row  product_data">
                            <div class="col-md-2 my-auto">
                                <img src="{{ asset('assets/uploads/products/' . $item->products->image) }}" height="100px"
                                    width="100px" alt=" Image here">
                            </div>
                            <div class="col-md-2 my-auto">
                                <h6>{{ $item->products->prodname }}</h6>
                            </div>
                            <div class="col-md-2 my-auto">
                                <h6>{{ $item->products->selling_price }}</h6>
                            </div>
                            <div class="col-md-2 my-auto">
                                <input type="hidden" class="productid" value="{{ $item->productid }}">
                                @if ($item->products->quantity >= $item->productquantity)
                                    <label for="Quantity">Quantity</label>
                                    <div class="input-group text-center mb-3" style="width:130px;">
                                        <button class="input-group-text  decrement-btn">-</button>
                                        <input type="text" name="quantity" class="form-control qty-input text-center"
                                            value="1">
                                        <button class="input-group-text   increment-btn">+</button>
                                    </div>
                                @else
                                    <h6>Not available</h6>
                                @endif
                            </div>
                            <div class="col-md-2 my-auto">
                                <button class="btn btn-success addToCartBtn "> <i class="fa fa-heart"></i> Add To
                                    Saved Properties</button>
                            </div>
                            <div class="col-md-2 my-auto">
                                <button class="btn btn-danger remove-wishlist-item"> <i class="fa fa-trash"></i>
                                    Remove</button>
                            </div>
                        </div>
                    @endforeach
            </div>
        @else
            <h4>There is no Property in the Favorites</h4>
            @endif
        </div>
    </div>
    </div>
@endsection
