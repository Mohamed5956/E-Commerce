@extends('layouts.front')

@section('title')
    Welcome to E-Shop
@endsection

@section('content')
    @include('layouts.inc.slider')

    <div class="py-5">
        <div class="container">
            <div class="row">
                <h2>Fetured Products</h2>
                <div class="owl-carousel featured-carousel owl-theme">
                    {{-- <div class="item"><h4>1</h4></div> --}}
                    @foreach ($featured_product as $prod)
                        <div class="item">
                            <div class="card">
                                <img src="{{ asset('assets/uploads/products/' . $prod->image) }}" alt="Product-image"
                                    style="width:200px">
                                <div class="card-body">
                                    <h5>{{ $prod->name }}</h5>
                                    <span class="float-start">{{ $prod->original_price }}</span>
                                    <span class="float-end"> <s> {{ $prod->selling_price }} </s> </span>
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
                <h2>Trending Categories</h2>
                <div class="owl-carousel featured-carousel owl-theme">
                    @foreach ($trending_categories as $cat)
                        <div class="item">
                            
                            <a href="{{url('view-category/'.$cat->slug)}}">
                                <div class="card">
                                    <img src="{{ asset('assets/uploads/category/' . $cat->image) }}" alt="Category-image"
                                        style="width:200px">
                                    <div class="card-body">
                                        <h5>{{ $cat->name }}</h5>
                                        <p class="float-start">{{ $cat->description }}</p>
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
            margin: 10,
            nav: true,
            dots: false,
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
