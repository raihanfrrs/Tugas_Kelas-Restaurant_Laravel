<div class="title-wrapper pt-30">
    <div class="row align-items-center">
    <div class="col-md-6">
        <div class="title mb-30">
        <h2>
            @if (count(Request::segments()) == 0)
                Dashboard
            @else 
                {{ isset($title) ? $title : Str::ucfirst(Request::segment(1)) }}
            @endif
        </h2>
        </div>
    </div>
    <div class="col-md-6">
        <div class="breadcrumb-wrapper mb-30">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/" class="@if(request()->root() === url()->current()) text-primary @endif">Dashboard</a>
                </li>
                @if (count(Request::segments()) >= 1)
                @if (request()->is(Request::segment(1)."/*"))
                <li class="breadcrumb-item" aria-current="page">
                    <a href="{{ url()->previous() }}">{{ Str::ucfirst(Request::segment(1)) }}</a>
                </li>
                @endif
                <li class="breadcrumb-item" aria-current="page">
                    <a href="{{ url()->current() }}" 
                        class="@if(request()->segment(count(request()->segments()))) text-primary @endif">
                        {{ isset($subtitle) ? Str::ucfirst($subtitle) : Str::ucfirst(request()->segment(count(request()->segments()))) }}
                    </a>
                </li>
                @endif
            </ol>
        </nav>
        </div>
    </div>
    </div>
</div>