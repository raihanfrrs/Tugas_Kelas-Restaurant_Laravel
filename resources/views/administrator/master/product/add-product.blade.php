@extends('layouts.main')

@section('section')
<!-- ========== form-elements-wrapper start ========== -->
<div class="form-elements-wrapper">
    <form action="/product" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
    <div class="col-lg-6">
        <!-- input style start -->
        <div class="card-style mb-30">
        <h6 class="mb-25">Food Form</h6>
        <div class="input-style-1">
            <label for="product_name">Product Name</label>
            <input type="text" class="@error('product_name') is-invalid @enderror text-capitalize" placeholder="Product Name" name="product_name" id="product_name" value="{{ old('product_name') }}" required/>
            @error('product_name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="input-style-1">
            <label for="price">Price</label>
            <input type="text" class="@error('price') is-invalid @enderror" placeholder="Price" name="price" id="price" value="{{ old('price') }}" required/>
            @error('price')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="select-style-1">
            <label>Category</label>
            <div class="select-position">
                <select name="category_id">
                @foreach ($category as $categories)
                @if (old('category_id') == $categories->id)
                    <option value="{{ $categories->id }}" selected>{{ $categories->category }}</option>
                @else
                    <option value="{{ $categories->id }}">{{ $categories->category }}</option>
                @endif
                @endforeach
                </select>
            </div>
        </div>
        <div class="input-style-1">
            <label for="description">Description <sup class="text-danger">*optional</sup></label>
            <textarea placeholder="Description" rows="10" name="description">{{ old('description') }}</textarea>
        </div>
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
    <div class="col-lg-6">
        <!-- ======= textarea style start ======= -->
        <div class="card-style mb-30">
        <h6 class="mb-25">Image</h6>
        <div class="input-style-1">
            <label for="image">Product Image</label>
            <img class="img-preview img-fluid d-block mb-3">
            <input type="file" class="@error('image') is-invalid @enderror" placeholder="Product Image" name="image" id="image" onchange="previewImage()"/>
            @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button class="btn btn-primary" type="submit">
            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                <path fill="currentColor" d="M17 3H5C3.89 3 3 3.9 3 5V19C3 20.11 3.9 21 5 21H12.81C12.45 20.38 12.2 19.7 12.08 19L12 19C10.34 19 9 17.66 9 16S10.34 13 12 13C12.68 13 13.34 13.23 13.87 13.65C15 12.59 16.46 12 18 12C19.05 12 20.09 12.28 21 12.81V7L17 3M15 9H5V5H15V9M17 14V17H14V19H17V22H19V19H22V17H19V14H17Z" />
            </svg>
             Save
        </button>
        </div>
    </div>
    <!-- end col -->
    </div>
    </form>
    <!-- end row -->
</div>
@endsection