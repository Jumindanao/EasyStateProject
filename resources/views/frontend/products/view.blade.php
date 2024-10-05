@extends('layouts.front')

@section('title', $products->prodname)

@section('content')

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ '/add-rating' }}" method="GET">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $products->id }}">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Rate {{ $products->prodname }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="rating-css">
                            <div class="star-icon">
                                @if ($user_rating)
                                    @for ($i = 1; $i <= $user_rating->stars; $i++)
                                        <input type="radio" value="{{ $i }}" name="product_rating" checked
                                            id="rating{{ $i }}">
                                        <label for="rating{{ $i }}" class="fa fa-star"></label>
                                    @endfor
                                    @for ($j = $user_rating->stars + 1; $j <= 5; $j++)
                                        <input type="radio" value="{{ $j }}" name="product_rating"
                                            id="rating{{ $j }}">
                                        <label for="rating{{ $j }}" class="fa fa-star"></label>
                                    @endfor
                                @else
                                    <input type="radio" value="1" name="product_rating" checked id="rating1">
                                    <label for="rating1" class="fa fa-star"></label>
                                    <input type="radio" value="2" name="product_rating" id="rating2">
                                    <label for="rating2" class="fa fa-star"></label>
                                    <input type="radio" value="3" name="product_rating" id="rating3">
                                    <label for="rating3" class="fa fa-star"></label>
                                    <input type="radio" value="4" name="product_rating" id="rating4">
                                    <label for="rating4" class="fa fa-star"></label>
                                    <input type="radio" value="5" name="product_rating" id="rating5">
                                    <label for="rating5" class="fa fa-star"></label>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6 class="mb-0">Collections / {{ $products->category->name }} / {{ $products->prodname }} </h6>
        </div>
    </div>

    <div class="container pb-5">
        <div class="card shadow product_data">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 border-right">
                        <img src="{{ asset('assets/uploads/products/' . $products->image) }}" class="w-100"
                            alt="">
                    </div>
                    <div class="col-md-8">
                        <h2 class="mb-0">
                            {{ $products->prodname }}
                            @if ($products->trending == '1')
                                <label style="font-size: 16px;"
                                    class="float-end badge bg-danger trending_tag">Trending</label>
                            @endif
                        </h2>

                        <hr>
                        <label class="me-3">Original Price : <s> Php {{ $products->original_price }}</s></label>
                        <label class="fw-bold">Selling Price : Php {{ $products->selling_price }}</label>
                        @php $starrates=number_format($ratingvalue)@endphp
                        <div class="rating">
                            @for ($i = 1; $i <= $starrates; $i++)
                                <i class="fa fa-star checked"></i>
                            @endfor

                            @for ($j = $starrates + 1; $j <= 5; $j++)
                                <i class="fa fa-star"></i>
                            @endfor
                            <span>
                                @if ($ratings->count() > 0)
                                    {{ $ratings->count() }} Ratings
                                @else
                                    Not rated yet
                                @endif
                            </span>
                        </div>

                        <p class="mt-3">
                            {!! $products->small_description !!}
                        </p>
                        <hr>
                        @if ($products->quantity > 0)
                            <label class="badge bg-success">Available</label>
                        @else
                            <label class="badge bg-danger">Not Available</label>
                        @endif
                        <div class="row mt-3">
                            <input type="hidden" value="{{ $products->id }}" class="productid">
                            <div class="col-md-2">
                                <label for="Quantity">Quantity</label>
                                <div class="input-group text-center mb-3">
                                    <button class="input-group-text decrement-btn">-</button>
                                    <input type="text" name="quantity" class="form-control qty-input" value="1"
                                        id="quantity-input" />
                                    <button class="input-group-text increment-btn">+</button>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <br />
                                @if ($products->quantity > 0)
                                    <button type="button" class="btn btn-primary me-3 addToCartBtn float-start">Add to
                                        Saved Properties <i class="fa fa-house"></i></button>
                                @endif
                                <button type="button" class="btn btn-success me-3  addToWishlist float-start">Add to
                                    Favorites <i class="fa fa-heart"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <hr>
                        <h3>Description</h3>
                        <p class="mt-3">
                            {!! $products->description !!}
                        </p>
                    </div>
                    <hr>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <button type="button" class="btn btn-link" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Rate {{ $products->prodname }}
                        </button>
                        <a href="{{ url('add-review/' . $products->prodname . '/userreview') }}" class="btn btn-link">
                            Send A Review
                        </a>
                    </div>
                    <div class="col-md-8">
                        @foreach ($reviews as $item)
                            <div class="user-review">
                                <label for="">{{ $item->user->name . ' ' . $item->user->lastname }}</label>
                                @if ($item->user_id == Auth::id())
                                    <a href="{{ url('edit-review/' . $products->prodname . '/userreview') }}">Edit</a>
                                @endif
                                <br>
                                @php
                                    $rating = App\Models\Rating::where('productid', $products->id)
                                        ->where('user_id', $item->user->id)
                                        ->first();
                                @endphp
                                @if ($rating)
                                    @php $user_rated = $rating->stars @endphp
                                    @for ($i = 1; $i <= $user_rated; $i++)
                                        <i class="fa fa-star checked"></i>
                                    @endfor
                                    @for ($j = $user_rated + 1; $j <= 5; $j++)
                                        <i class="fa fa-star"></i>
                                    @endfor
                                @endif
                                <small>Reviewed On {{ $item->created_at->format('d M Y') }}</small>
                                <p>
                                    {{ $item->user_review }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
