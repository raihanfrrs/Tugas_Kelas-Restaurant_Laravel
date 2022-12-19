@extends('layouts.main')

@section('section')
<div class="row">
    @foreach ($category->product as $item)
    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
        <div class="card-style-2 mb-30">
          <div class="card-image" style="max-height: 250px; overflow: hidden;">
            <a href="/product/{{ $item->slug }}">
                @if ($item->image)
                <img src="{{ asset('storage/'. $item->image) }}" alt="product image" class="img-fluid"/>
                @else
                <img src="https://source.unsplash.com/800x400?food" alt="product image" class="img-fluid"/>
                @endif
            </a>
          </div>
          <div class="card-content">
            <h4><a href="/product/{{ $item->slug }}">{{ $item->product_name }}</a></h4>
            <p>
              Price : @currency($item->price)
            </p>
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endsection