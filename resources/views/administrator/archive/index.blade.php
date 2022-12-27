@extends('layouts.main')

@section('section')
<div class="card-style">
    @if ($count == 0)
        <div class="alert alert-primary mb-0" role="alert">
            <span class="fw-bold">Sorry,</span> You don't have one recycle data!
        </div>
    @endif
    
    @if ($product->count() != 0)
        <p class="fs-3 fw-bold">
            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                <path fill="currentColor" d="M18.06 23H19.72C20.56 23 21.25 22.35 21.35 21.53L23 5.05H18V1H16.03V5.05H11.06L11.36 7.39C13.07 7.86 14.67 8.71 15.63 9.65C17.07 11.07 18.06 12.54 18.06 14.94V23M1 22V21H16.03V22C16.03 22.54 15.58 23 15 23H2C1.45 23 1 22.54 1 22M16.03 15C16.03 7 1 7 1 15H16.03M1 17H16V19H1V17Z" />
            </svg>
            Product
        </p>
        <span class="divider"><hr></span>
        @foreach ($product as $item)
            <div class="single-notification">
                <div class="notification">
                <div class="image info-bg">
                    <span>{{ mb_substr($item->product_name, 0, 1) }}</span>
                </div>
                <a href="/product/{{ $item->slug }}" class="content">
                    <h6>{{ $item->product_name }}</h6>
                    <p class="text-sm text-gray">
                        {{ Str::words($item->description, '25') }}
                    </p>
                    <p class="text-sm text-gray">
                        @currency($item->price)
                    </p>
                    <span class="text-sm text-medium text-gray">Archived {{ $item->updated_at->diffForHumans() }}</span>
                </a>
                </div>
                <div class="action">
                <button
                    class="more-btn dropdown-toggle"
                    id="moreAction"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                >
                    <i class="lni lni-more-alt"></i>
                </button>
                <ul
                    class="dropdown-menu dropdown-menu-end"
                    aria-labelledby="moreAction"
                >
                    <li class="dropdown-item">
                        <form action="/archive/{{ $item->slug }}" method="post">
                            @csrf
                            @method('put')
                            <input type="hidden" name="product" value="1">
                            <button type="submit" name="restore" class="recyle-archive text-gray" value="1">Restore</button>
                        </form>
                    </li>
                    <li class="dropdown-item">
                        <form action="/archive/{{ $item->slug }}" method="post">
                            @csrf
                            @method('put')
                            <input type="hidden" name="product" value="1">
                            <button type="submit" name="recycle" class="recyle-archive text-gray" value="1">Delete</button>
                        </form>
                    </li>
                </ul>
                </div>
            </div>
        @endforeach
    @endif

    @if ($category->count() != 0)
        <p class="fs-3 fw-bold mt-3">
            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                <path fill="currentColor" d="M11,13.5V21.5H3V13.5H11M9,15.5H5V19.5H9V15.5M12,2L17.5,11H6.5L12,2M12,5.86L10.08,9H13.92L12,5.86M17.5,13C20,13 22,15 22,17.5C22,20 20,22 17.5,22C15,22 13,20 13,17.5C13,15 15,13 17.5,13M17.5,15A2.5,2.5 0 0,0 15,17.5A2.5,2.5 0 0,0 17.5,20A2.5,2.5 0 0,0 20,17.5A2.5,2.5 0 0,0 17.5,15Z" />
            </svg>
            Category
        </p>
        <span class="divider"><hr></span>
        @foreach ($category as $item)
            <div class="single-notification">
                <div class="notification">
                <div class="image primary-bg">
                    <span>{{ mb_substr($item->category, 0, 1) }}</span>
                </div>
                <a href="/category/{{ $item->slug }}" class="content">
                    <h6>{{ $item->category }}</h6>
                    <p class="text-sm text-gray">
                        Have {{ $item->product->count() }} product.
                    </p>
                    <span class="text-sm text-medium text-gray">Archived {{ $item->updated_at->diffForHumans() }}</span>
                </a>
                </div>
                <div class="action">
                <button
                    class="more-btn dropdown-toggle"
                    id="moreAction"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                >
                    <i class="lni lni-more-alt"></i>
                </button>
                <ul
                    class="dropdown-menu dropdown-menu-end"
                    aria-labelledby="moreAction"
                >
                    <li class="dropdown-item">
                        <form action="/archive/{{ $item->slug }}" method="post">
                            @csrf
                            @method('put')
                            <input type="hidden" name="category" value="1">
                            <button type="submit" name="restore" class="recyle-archive text-gray" value="1">Restore</button>
                        </form>
                    </li>
                    <li class="dropdown-item">
                        <form action="/archive/{{ $item->slug }}" method="post">
                            @csrf
                            @method('put')
                            <input type="hidden" name="category" value="1">
                            <button type="submit" name="recycle" class="recyle-archive text-gray" value="1">Delete</button>
                        </form>
                    </li>
                </ul>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection