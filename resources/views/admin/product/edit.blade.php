@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Add Product</h4>
        </div>
        <div class="card-body">
            <form action="{{ url('products/' . $product->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">

                    <div class="col-md-12 mb-3">
                        <select class="form-select">
                            <option>{{ $product->category->name }}</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $product->name }}"
                            style="border-bottom: 1px solid black;">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control" name="slug" value="{{ $product->slug }}"
                            style="border-bottom: 1px solid black;">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="description">small Description</label>
                        <textarea name="small_description" rows="3" class="form-control" style="border-bottom: 1px solid black;">
                            {{ $product->small_description }}
                        </textarea>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="description">Description</label>
                        <textarea name="description" rows="3" class="form-control" style="border-bottom: 1px solid black;">
                            {{ $product->description }}
                        </textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="original_price">Original Price</label>
                        <input class="form-control" type="number" name="original_price"
                            value="{{ $product->original_price }}" style="border-bottom: 1px solid black;">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="selling_price">Selling Price</label>
                        <input class="form-control" type="number" name="selling_price"
                            value="{{ $product->selling_price }}" style="border-bottom: 1px solid black;">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="tax">Tax</label>
                        <input class="form-control" type="number" name="tax" value="{{ $product->tax }}"
                            style="border-bottom: 1px solid black;">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="quantity">Quantity</label>
                        <input class="form-control" type="number" name="quantity" value="{{ $product->quantity }}"
                            style="border-bottom: 1px solid black;">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="status">Status</label>
                        <input type="checkbox" name="status" {{ $product->status== '1' ? 'checked' : '' }}
                            style="border-bottom: 1px solid black;">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="trending">Trending</label>
                        <input type="checkbox" name="trending" {{ $product->trending== '1' ? 'checked' : '' }}
                            style="border-bottom: 1px solid black;">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="meta_title">Meta title</label>
                        <input type="text" class="form-control" name="meta_title" value="{{ $product->meta_title }}"
                            style="border-bottom: 1px solid black;">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="meta_keyowrds">Meta keywords</label>
                        <input type="text" class="form-control" name="meta_keywords" value="{{ $product->meta_title }}"
                            style="border-bottom: 1px solid black;">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="meta_desc">Description</label>
                        <textarea name="meta_desc" rows="3" class="form-control" style="border-bottom: 1px solid black;">
                            {{ $product->meta_desc }}
                        </textarea>
                    </div>
                    @if ($product->image)
                        <img src="{{ asset('assets/uploads/products/' . $product->image) }}" alt="product-image"
                            class="cat-image">
                    @endif
                    <div class="col-md-12">
                        <input type="file" name="image" class="form-control">
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>


                </div>
            </form>
        </div>
    </div>
@endsection
