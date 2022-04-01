@extends('layouts.front')

@section('title')
    My Profile
@endsection

@section('content')
    <div class="container py-5 mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>My Profile</h3>
                        <hr>
                    </div>
                    <div class="card-body">
                        <form class="containerForm" action="{{url('edit/'.$user->id)}}" method="POST">
                        <div class="row">
                                @method('PUT')
                                @csrf
                            <div class="col-md-4">
                                <label for="fname">First Name</label>
                                <div class="p-2 border"> <input type="text" name="name" class="form-control"
                                    value="{{old('name',$user->name)}}" >
                                    <span class="text-danger">{{$errors->first('name')}}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="lname">Last Name</label>
                                <div class="p-2 border"> <input type="text" name="lname" class="form-control"
                                    value="{{old('lname',$user->lname)}}" >
                                    <span class="text-danger">{{$errors->first('lname')}}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="email">Email</label>
                                <div class="p-2 border"> <input type="text" name="email" class="form-control"
                                    value="{{old('email',$user->email)}}" >
                                    <span class="text-danger">{{$errors->first('email')}}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="phone">Phone</label>
                                <div class="p-2 border"> <input type="text" name="phone" class="form-control"
                                    value="{{old('phone',$user->phone)}}" >
                                    <span class="text-danger">{{$errors->first('phone')}}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="address1">Address 1</label>
                                <div class="p-2 border"> <input type="text" name="address1" class="form-control"
                                    value="{{old('address1',$user->address1)}}" >
                                    <span class="text-danger">{{$errors->first('address1')}}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="address2">Address 2</label>
                                <div class="p-2 border"> <input type="text" name="address2" class="form-control"
                                    value="{{old('address2',$user->address2)}}">
                                    <span class="text-danger">{{$errors->first('address2')}}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="city">City</label>
                                <div class="p-2 border"> <input type="text" name="city" class="form-control"
                                     value="{{old('city',$user->city)}}">
                                    <span class="text-danger">{{$errors->first('city')}}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="state">State</label>
                                <div class="p-2 border"> <input type="text" name="state" class="form-control"
                                    value="{{old('state',$user->state)}}">
                                    <span class="text-danger">{{$errors->first('state')}}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="country">Country</label>
                                <div class="p-2 border"> <input type="text" name="country" class="form-control"
                                    value="{{old('country',$user->country)}}">
                                    <span class="text-danger">{{$errors->first('country')}}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="pincode">Zip Code</label>
                                <div class="p-2 border">
                                     <input type="text" name="pincode" class="form-control"
                                    value="{{old('pincode',$user->pincode)}}">
                                    <span class="text-danger">{{$errors->first('pincode')}}</span>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="float-end btn btn-warning">Update</button>
                    </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
@endsection
