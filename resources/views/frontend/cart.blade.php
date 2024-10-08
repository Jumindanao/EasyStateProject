@extends('layouts.front')

@section('title')
    My Saved Properties
@endsection

@section('content')
    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6 class="mb-0">
                <a href="{{ url('/') }}" style="text-decoration: none; color: inherit;">
                    Home
                </a> /
                <a href="{{ url('cart') }}" style="text-decoration: none; color: inherit;">
                    Saved Properties
                </a> /
            </h6>
        </div>
    </div>

    <div class="container my-5 cartitemz">
        <div class="card shadow">
            @if ($cartitems->count() > 0)
                <div class="card-body">
                    @php
                        $total = 0; // Initialize total here
                    @endphp

                    @foreach ($cartitems as $item)
                        <div class="row product_data">
                            <div class="col-md-2 my-auto">
                                <img src="{{ asset('assets/uploads/products/' . $item->products->image) }}" height="100px"
                                    width="100px" alt=" Image here">
                            </div>
                            <div class="col-md-3 my-auto">
                                <h6>{{ $item->products->prodname }}</h6>
                            </div>
                            <div class="col-md-2 my-auto">
                                <h6>Php {{ $item->products->selling_price }}</h6>
                            </div>
                            <div class="col-md-3 my-auto">
                                <input type="hidden" value="{{ $item->productid }}" class="productid">
                                @if ($item->products->quantity >= $item->productquantity)
                                    <label for="Quantity">Quantity</label>
                                    <div class="input-group text-center mb-3" style="width:130px;">

                                        <input type="text" name="quantity" class="form-control qty-input text-center"
                                            value="{{ $item->productquantity }}" readonly>


                                    </div>
                                    @php
                                        $total += $item->products->selling_price * $item->productquantity; // Add to total
                                    @endphp
                                @else
                                    <h6>Out of stock</h6>
                                @endif
                            </div>
                            <div class="col-md-2 my-auto">
                                <button class="btn btn-danger delete-cart-item"> <i class="fa fa-trash"></i> Remove</button>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="card-footer">
                    <h6>Total price: Php {{ $total }}
                        <a href="{{ url('checkout') }}" class="btn btn-outline-success float-end">Inquiry Submission</a>
                    </h6>
                </div>
            @else
                <div class="card-body text-center">
                    <h2>Your <i class="fa fa-house"></i> Saved Properties is Empty</h2>
                    <a href="{{ url('category') }}" class="btn btn-outline-primary float-end">Continue Shopping</a>
                </div>
            @endif
        </div>
    </div>
@endsection
