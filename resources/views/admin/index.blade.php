@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="card" style="height: 500px">
            <div class="row">
                <div class="col-md-3 m-5">
                    <div class="card bg-danger">
                        <div class="card-body">
                            <h5 class="card-title">Total Orders </h5>
                            <p class="card-text" style="color: black"><b> Orders On Progress: {{$ordersProgress->count()}}</b></p>
                            <p class="card-text" style="color: black"><b> Orders Finished: {{$ordersFinished->count()}}</b></p>
                            <a href="{{url('/orders')}}" class="card-link">Orders</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 m-5">
                    <div class="card bg-warning" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Total Users : </h5>
                            <p class="card-text" style="color: black"><b>{{$users->count()}}</b></p>
                            <a href="{{url('/users')}}" class="card-link">users</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 m-5">
                    <div class="card bg-danger" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Total Products : </h5>
                            <p class="card-text" style="color: black"><b>{{$products->count()}}</b></p>
                            <a href="{{url('/products')}}" class="card-link">Products</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mx-5">
                    <div class="card bg-primary" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Total Categories : </h5>
                            <p class="card-text" style="color: black"><b>{{$category->count()}}</b></p>
                            <a href="{{url('/categories')}}" class="card-link">Categories</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
