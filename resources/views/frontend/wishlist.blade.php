@extends('layouts.front')

@section('title')
    My Cart
@endsection

@section('content')
    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6 class="mb-0">
                <a href="{{ url('/') }}">
                    Home
                </a> /
                <a href="{{ url('wishlist') }}">
                    Wishlist
                </a>
            </h6>
        </div>
    </div>

    <div class="container my-5">
        <div class="card shadow wishlistitems">
            <div class="card-body">
                @if ($wishlist->count() > 0)
                    <div class="card-body">
                        @foreach ($wishlist as $item)
                            <div class="row product_data">
                                <div class="col-md-2 my-auto">
                                    <img src="{{ asset('assets/uploads/products/' . $item->products->image) }}"
                                        height="70px" width="70px" alt="">
                                </div>
                                <div class="col-md-2 my-auto">
                                    <h5>{{ $item->products->name }}</h5>
                                </div>
                                <div class="col-md-2 my-auto">
                                    <h6>$ {{ $item->products->selling_price }}</h6>
                                </div>
                                <div class="col-md-2 my-auto">
                                    <input type="hidden" class="prod_id" value="{{ $item->prod_id }}">
                                    @if ($item->products->quantity > 0)
                                        <label for="quantity">Quantity</label>
                                        <div class="input-group text-center mb-3" style="width:130px">
                                            <button class="input-group-text decrement-btn">-</button>
                                            <input type="text" name="quantity" class="form-control text-center qty-input" value="1">
                                            <button class="input-group-text increment-btn">+</button>
                                        </div>
                                        <h6 class="badge bg-success">In Stock</h6>
                                    @else
                                        <h6 class="badge bg-danger">Out Of Stock</h6>
                                    @endif
                                </div>
                                <div class="col-md-2 my-auto">
                                    <button class="btn btn-success addToCart"> <i class="fa fa-shopping-cart"></i> Add to
                                        Cart</button>
                                </div>
                                <div class="col-md-2 my-auto">
                                    <button class="btn btn-danger remove-wishlist-item"> <i class="fa fa-trash"></i> Remove</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <h4>No Products in Your Wishlist</h4>
                @endif
            </div>
        </div>
    </div>
@endsection
