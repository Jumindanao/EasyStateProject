@extends('layouts.front')

@section('title')
    EasyEstate: Simplifying Your Home Search
@endsection

@section('content')
    @include('layouts.navbar.slider')

    <div class="py-5">
        <div class="container">
            <div class="row">
                <h2>Featured State</h2>
                <div class="owl-carousel featured-carousel owl-theme">
                    @foreach ($featured_products as $prod)
                        <div class="item">
                            <div class="card">
                                <img src="{{ asset('assets/uploads/products/' . $prod->image) }}" alt="Product Image">
                                <div class="card-body">
                                    <h5>{{ $prod->prodname }}</h5>
                                    <span class="float-start">{{ $prod->selling_price }}</span>
                                    <span class="float-end"><s>{{ $prod->original_price }}</s></span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="py-5">
        <div class="container">
            <div class="row">
                <h2>Trending Place</h2>
                <div class="owl-carousel trending-carousel owl-theme">
                    @foreach ($trending_category as $tcat)
                        <div class="item">
                            <a href="{{ url('view-category/' . $tcat->name) }}">
                                <div class="card">
                                    <img src="{{ asset('assets/uploads/category/' . $tcat->image) }}" alt="Product Image">
                                    <div class="card-body">
                                        <h5>{{ $tcat->name }}</h5>
                                        <p>
                                            {{ $tcat->description }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('.featured-carousel').owlCarousel({
            loop: true,
            autoplay: true,
            margin: 10,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 3
                }
            }
        })
        $('.trending-carousel').owlCarousel({
            loop: true,
            autoplay: true,
            rtl: true,
            margin: 10,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 3
                }
            }
        })
    </script>
@endsection
