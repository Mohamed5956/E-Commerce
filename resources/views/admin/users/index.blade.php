@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">
        <h3>Registered Users</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <th>id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach ($users as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->name.' '.$item->lname}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->phone}}</td>
                    <td>
                        <a class="btn btn-warning" href="{{url('view-user/'.$item['id'])}}">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

