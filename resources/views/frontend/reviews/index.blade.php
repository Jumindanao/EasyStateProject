@extends('layouts.front')

@section('title', 'Send a Review')

@section('content')
    <div class="contaner py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if ($verified_purchase->count() > 0)
                            <h5>You are sending a review for {{ $product->prodname }}
                                <form action="{{ url('/add-review') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <textarea class="form-control" name="user_review" rows="5" placeholder="Send a Review"></textarea>
                                    <button type="submit" class="btn btn-primary mt-3">Submit Review</button>
                                </form>
                            @else
                                <div class="alert alert-danger">
                                    <h5>You are not allowed to send a review for this property</h5>
                                    <p>
                                        Only customers who purchased are allowed
                                    </p>
                                    <a href="{{ url('/') }}" class="btn btn-primary">Go to home page</a>
                                </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
