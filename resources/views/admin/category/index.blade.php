@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">
        <h3>Category</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Image</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td>{{$item['id']}}</td>
                    <td>{{$item['name']}}</td>
                    <td>{{$item['description']}}</td>
                    <td>
                        <img src="{{asset('assets/uploads/category/'.$item['image'])}}" alt="" class="cat-image">
                    </td>
                    <td>
                        <a class="btn btn-warning" href="{{url('categories/'.$item['id'].'/edit')}}">Edit</a>
                        <form action="{{url('categories/'.$item['id'])}}" method="post">
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

