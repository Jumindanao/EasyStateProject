@extends('layouts.front')

@section('title', "Edit your Review")
    
@section('content')
<div class="contaner py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5>You are sending a review for {{ $review->product->prodname }}
                    <form action="{{ url('/update-review') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="review_id" value="{{ $review->id }}">
                        <textarea class="form-control" name="user_review" rows="5" placeholder="Send a Review">{{ $review->user_review }}</textarea>
                        <button type="submit" class="btn btn-primary mt-3">Update Review</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection