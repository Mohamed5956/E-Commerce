@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Add Category</h4>
        </div>
        <div class="card-body">
            <form action="{{ url('categories') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" style="border-bottom: 1px solid black;">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control" name="slug" style="border-bottom: 1px solid black;">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="description">Description</label>
                        <textarea name="description" rows="3" class="form-control" style="border-bottom: 1px solid black;"></textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="status">Status</label>
                        <input type="checkbox" name="status" style="border-bottom: 1px solid black;">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="popular">Popular</label>
                        <input type="checkbox" name="popular" style="border-bottom: 1px solid black;">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="meta_title">Meta title</label>
                        <input type="text" class="form-control" name="meta_title" style="border-bottom: 1px solid black;">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="meta_keyowrds">Meta keywords</label>
                        <input type="text" class="form-control" name="meta_keywords"
                            style="border-bottom: 1px solid black;">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="meta_desc">Description</label>
                        <textarea name="meta_desc" rows="3" class="form-control" style="border-bottom: 1px solid black;"></textarea>
                    </div>

                    <div class="col-md-12">
                        <input type="file" name="image" class="form-control" >
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>


                </div>
            </form>
        </div>
    </div>
@endsection
