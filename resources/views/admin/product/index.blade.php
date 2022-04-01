@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">
        <h3>Category</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <th>id</th>
                <th>Category</th>
                <th>Name</th>
                <th>Original Price</th>
                <th>Selling Price</th>
                <th>Quantity</th>
                <th>Image</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach ($products as $item)
                {{-- @dd($item->category->name) --}}
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->category->name}}</td>
                    <td>{{$item['name']}}</td>
                    <td>{{$item['original_price']}}</td>
                    <td>{{$item['selling_price']}}</td>
                    <td>{{$item['quantity']}}</td>
                    <td>
                        <img src="{{asset('assets/uploads/products/'.$item['image'])}}" alt="" class="cat-image">
                    </td>
                    <td>
                        <a class="btn btn-warning" href="{{url('products/'.$item['id'].'/edit')}}">Edit</a>
                        <form action="{{url('products/'.$item['id'])}}" method="post">
                            @method('DELETE')
                            @csrf
                            <input type="submit" class="btn btn-danger" value="Delete" />
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

