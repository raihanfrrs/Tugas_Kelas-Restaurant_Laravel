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
                    <span class="text-sm text-medium text-gray">Moved in {{ $item->updated_at->diffForHumans() }}</span>
                </a>
                </div>
                <div class="action">
                    <form action="/recycle/{{ $item->slug }}" method="post" id="delete-form-{{ $item->slug }}">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="product" value="1">
                        <button type="submit" id="delete-btn" class="delete-btn" value="{{ $item->slug }}">
                            <i class="lni lni-trash-can"></i>
                        </button>
                    </form>
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
                        <form action="recycle/{{ $item->slug }}" method="post">
                            @csrf
                            @method('put')
                            <input type="hidden" name="product" value="1">
                            <button type="submit" name="restore" class="recyle-archive text-gray" value="1">Restore</button>
                        </form>
                    </li>
                    <li class="dropdown-item">
                        <form action="recycle/{{ $item->slug }}" method="post">
                            @csrf
                            @method('put')
                            <input type="hidden" name="product" value="1">
                            <button type="submit" name="archive" class="recyle-archive text-gray" value="1">Archive</button>
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
                    <span class="text-sm text-medium text-gray">Moved in {{ $item->updated_at->diffForHumans() }}</span>
                </a>
                </div>
                <div class="action">
                    <form action="/recycle/{{ $item->slug }}" method="post" id="delete-form-{{ $item->slug }}">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="category" value="1">
                        <button type="submit" id="delete-btn" class="delete-btn" value="{{ $item->slug }}">
                            <i class="lni lni-trash-can"></i>
                        </button>
                    </form>
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
                        <form action="recycle/{{ $item->slug }}" method="post">
                            @csrf
                            @method('put')
                            <input type="hidden" name="category" value="1">
                            <button type="submit" name="restore" class="recyle-archive text-gray" value="1">Restore</button>
                        </form>
                    </li>
                    <li class="dropdown-item">
                        <form action="recycle/{{ $item->slug }}" method="post">
                            @csrf
                            @method('put')
                            <input type="hidden" name="category" value="1">
                            <button type="submit" name="archive" class="recyle-archive text-gray" value="1">Archive</button>
                        </form>
                    </li>
                </ul>
                </div>
            </div>
        @endforeach
    @endif

    @if ($customer->count() != 0)
        <p class="fs-3 fw-bold mt-3">
            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                <path fill="currentColor" d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,14C16.42,14 20,15.79 20,18V20H4V18C4,15.79 7.58,14 12,14Z" />
            </svg>
            Customer
        </p>
        <span class="divider"><hr></span>
        @foreach ($customer as $item)
            <div class="single-notification">
                <div class="notification">
                <div class="image success-bg">
                    <span>{{ mb_substr($item->name, 0, 1) }}</span>
                </div>
                <a href="#" class="content">
                    <h6>{{ $item->name }}</h6>
                    <span class="text-sm text-medium text-gray">Moved in {{ $item->updated_at->diffForHumans() }}</span>
                </a>
                </div>
                <div class="action">
                    <form action="/recycle/{{ $item->slug }}" method="post" id="delete-form-{{ $item->slug }}">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="customer" value="1">
                        <button type="submit" id="delete-btn" class="delete-btn" value="{{ $item->slug }}">
                            <i class="lni lni-trash-can"></i>
                        </button>
                    </form>
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
                    <form action="recycle/{{ $item->slug }}" method="post">
                        @csrf
                        @method('put')
                        <input type="hidden" name="customer" value="1">
                        <button type="submit" name="restore" class="recyle-archive text-gray" value="1">Restore</button>
                    </form>
                </li>
                </ul>
                </div>
            </div>
        @endforeach
    @endif

    @if ($cashier->count() != 0)
        <p class="fs-3 fw-bold mt-3">
            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                <path fill="currentColor" d="M11 9C11 10.66 9.66 12 8 12C6.34 12 5 10.66 5 9C5 7.34 6.34 6 8 6C9.66 6 11 7.34 11 9M14 20H2V18C2 15.79 4.69 14 8 14C11.31 14 14 15.79 14 18M22 12V14H13V12M22 8V10H13V8M22 4V6H13V4Z" />
            </svg>
            Cashier
        </p>
        <span class="divider"><hr></span>
        @foreach ($cashier as $item)
            <div class="single-notification">
                <div class="notification">
                <div class="image success-bg">
                    <span>{{ mb_substr($item->name, 0, 1) }}</span>
                </div>
                <a href="/cashier/{{ $item->id }}" class="content">
                    <h6>{{ $item->name }}</h6>
                    <span class="text-sm text-medium text-gray">Moved in {{ $item->user->updated_at->diffForHumans() }}</span>
                </a>
                </div>
                <div class="action">
                    <form action="/recycle/{{ $item->slug }}" method="post" id="delete-form-{{ $item->slug }}">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="cashier" value="1">
                        <button type="submit" id="delete-btn" class="delete-btn" value="{{ $item->slug }}">
                            <i class="lni lni-trash-can"></i>
                        </button>
                    </form>
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
                    <form action="recycle/{{ $item->slug }}" method="post">
                        @csrf
                        @method('put')
                        <input type="hidden" name="cashier" value="1">
                        <button type="submit" name="restore" class="recyle-archive text-gray" value="1">Restore</button>
                    </form>
                </li>
                </ul>
                </div>
            </div>
        @endforeach
    @endif

    @if ($kitchen->count() != 0)
        <p class="fs-3 fw-bold mt-3">
            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                <path fill="currentColor" d="M12.5,1.5C10.73,1.5 9.17,2.67 8.67,4.37C8.14,4.13 7.58,4 7,4A4,4 0 0,0 3,8C3,9.82 4.24,11.41 6,11.87V19H19V11.87C20.76,11.41 22,9.82 22,8A4,4 0 0,0 18,4C17.42,4 16.86,4.13 16.33,4.37C15.83,2.67 14.27,1.5 12.5,1.5M12,10.5H13V17.5H12V10.5M9,12.5H10V17.5H9V12.5M15,12.5H16V17.5H15V12.5M6,20V21A1,1 0 0,0 7,22H18A1,1 0 0,0 19,21V20H6Z" />
            </svg>
            Kitchen
        </p>
        <span class="divider"><hr></span>
        @foreach ($kitchen as $item)
            <div class="single-notification">
                <div class="notification">
                <div class="image warning-bg">
                    <span>{{ mb_substr($item->name, 0, 1) }}</span>
                </div>
                <a href="/kitchen/{{ $item->id }}" class="content">
                    <h6>{{ $item->name }}</h6>
                    <span class="text-sm text-medium text-gray">Moved in {{ $item->user->updated_at->diffForHumans() }}</span>
                </a>
                </div>
                <div class="action">
                    <form action="/recycle/{{ $item->slug }}" method="post" id="delete-form-{{ $item->slug }}">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="kitchen" value="1">
                        <button type="submit" id="delete-btn" class="delete-btn" value="{{ $item->slug }}">
                            <i class="lni lni-trash-can"></i>
                        </button>
                    </form>
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
                        <form action="recycle/{{ $item->slug }}" method="post">
                            @csrf
                            @method('put')
                            <input type="hidden" name="kitchen" value="1">
                            <button type="submit" name="restore" class="recyle-archive text-gray" value="1">Restore</button>
                        </form>
                    </li>
                </ul>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection