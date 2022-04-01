@extends('layouts.front')

@section('title')
    Write Review
@endsection
@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if ($verified_purchase->count() > 0)
                    <h4>You are writing review for {{$product->name}}</h4>
                    <form action="{{url('/add-review')}}" method="POST">
                        @csrf
                        <input type="hidden" name="prod_id" value="{{$product->id}}">
                        <textarea name="user_review" class="form-control" rows="5" placeholder="Write a Review"></textarea>
                        <button type="submit" class="btn btn-primary mt-3">Submit Review</button>
                    </form>
                    @else
                    <div class="alert alert-danger">
                        <h5>You are not eligable to review this product </h5>
                        <p>
                            For the trustthowrthiness of the review , only customers who purchased
                            the product can write a review about the product.
                        </p>
                        <a href="{{url('/')}}" class="btn btn btn-primary mt-3">Go to home page </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
