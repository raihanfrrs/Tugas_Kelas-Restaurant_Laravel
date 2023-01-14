@extends('layouts.main')

@section('section')
@foreach ($product as $outerKey => $outerValue)
    <div class="title mb-15 text-center">
        <h3>
            {{ $outerValue[0]->category->category }}
        </h3>
    </div>
    <div class="row">
        @foreach ($outerValue as $innerKey => $item)
        @csrf
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
            <form action="/cart/{{ $item->slug }}/store" method="post">
              @csrf
              <div class="card-style-2 mb-30">
                <div class="card-image" style="max-height: 250px; overflow: hidden;">
                  @if ($item->image)
                  <img src="{{ asset('storage/'. $item->image) }}" alt="product image" class="img-fluid"/>
                  @else
                  <img src="https://source.unsplash.com/800x400?food" alt="product image" class="img-fluid"/>
                  @endif
                </div>
                <div class="card-content">
                  <h4><a href="#">{{ $item->product_name }}</a></h4>
                  <p>
                    Price : @currency($item->price)
                  </p>
                  <button class="btn btn-primary btn-sm col-md-12 mt-3 fw-bold">
                      Add To Cart
                      <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                          <path fill="currentColor" d="M11 9H13V6H16V4H13V1H11V4H8V6H11M7 18C5.9 18 5 18.9 5 20S5.9 22 7 22 9 21.1 9 20 8.1 18 7 18M17 18C15.9 18 15 18.9 15 20S15.9 22 17 22 19 21.1 19 20 18.1 18 17 18M7.2 14.8V14.7L8.1 13H15.5C16.2 13 16.9 12.6 17.2 12L21.1 5L19.4 4L15.5 11H8.5L4.3 2H1V4H3L6.6 11.6L5.2 14C5.1 14.3 5 14.6 5 15C5 16.1 5.9 17 7 17H19V15H7.4C7.3 15 7.2 14.9 7.2 14.8Z" />
                      </svg>
                  </button>
                </div>
              </div>
            </form>
          </div>
        @endforeach
    </div>
@endforeach
@endsection