@extends('layouts.main')

@section('section')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="row g-0">
              <div class="col-md-4">
                @if ($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}" class="img-fluid rounded-start w-100 h-100" alt="product image" style="max-height: 400px; overflow:hidden;">
                @else
                    <img src="https://source.unsplash.com/800x400?food" class="img-fluid rounded-start w-100 h-100" alt="product image">
                @endif
              </div>
              <div class="col-md-8">
                <div class="card-body mb-5">
                  <h1 class="card-title text-capitalize fw-bolder">{{ $product->product_name }}</h1>
                  <p class="card-text fs-6 fw-semibold text-capitalize">Category : <a href="/category/{{ $product->category->slug }}">{{ $product->category->category }}</a></p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item fs-4 fw-semibold text-primary">Price : @currency($product->price)</li>
                    @if ($product->description != null)
                        <li class="list-group-item">{{ $product->description }}</li>
                    @endif
                    <li class="list-group-item text-end"><small class="text-muted">Last updated {{ $product->updated_at->diffForHumans() }}</small></li>
                </ul>
              </div>
            </div>
        </div>
    </div>

</div>
@endsection