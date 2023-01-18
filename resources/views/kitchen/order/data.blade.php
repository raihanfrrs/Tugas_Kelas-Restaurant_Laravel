<div class="row">

@if (count($transaction) === 0)
<div class="alert alert-primary" role="alert">
    <h4 class="alert-heading">
        <svg style="width:44px;height:44px" viewBox="0 0 24 24">
            <path fill="currentColor" d="M8.27,3L3,8.27V15.73L8.27,21H15.73C17.5,19.24 21,15.73 21,15.73V8.27L15.73,3M9.1,5H14.9L19,9.1V14.9L14.9,19H9.1L5,14.9V9.1M11,15H13V17H11V15M11,7H13V13H11V7" />
        </svg> 
        Order empty!
    </h4>
    <p class="mb-0 mt-2">The order will appear if the cashier has forwarded the transaction to the kitchen.</p>
    <hr>
  </div>
@endif

@php
    $number = count($transaction);
@endphp
@foreach ($transaction as $item)
    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
        <div class="card-style-1 mb-30">
        <div class="card-meta">
            <div class="image">
                @if ($item->image)
                    <img
                        src="{{ asset('storage/'. $item->image) }}"
                        alt=""
                    />
                @else
                    <img
                        src="{{ asset('/') }}assets/images/profile/profile-2.png"
                        alt=""
                    />
                @endif
            </div>
            <div class="text">
            <p class="text-sm text-medium">
                Request from : <a href="#0">{{ $item->cashier }}</a>
            </p>
            </div>
        </div>
        <div class="card-image">
            <a href="#0">
                <p class="transaction-id">
                    #{{ $number-- }}
                </p>
            </a>
        </div>
        <div class="card-content">
            <p class="fw-bold text-primary fs-5 pb-2"> Payment Details : </p>
            <table style="width:100%">
                <tr>
                    <th>Name</th>
                    <td class="text-end text-capitalize">{{ $item->customer }}</td>
                </tr>
                <tr>
                    <th>Total Items</th>
                    <td class="text-end">{{ number_format($item->total_qty) }}</td>
                </tr>
                <tr>
                    <th>Grand Total</th>
                    <td class="text-end">@currency($item->grand_total)</td>
                </tr>
                <tr>
                        @if ($item->status === 'order')
                        <th>Status</th>
                            <td class="text-end">
                                <span class="badge rounded-pill bg-warning">Pending</span>
                            </td>
                        </tr>
                        @elseif ($item->status === 'cooking')
                        <th>Status</th>
                            <td class="text-end">
                                <span class="badge rounded-pill bg-primary">Cooking</span>
                            </td>
                        </tr>
                        @elseif ($item->status === 'serve')
                        <th>Status</th>
                            <td class="text-end">
                                <span class="badge rounded-pill bg-success">Served</span>
                            </td>
                        </tr>
                        @elseif ($item->status === 'reject')
                        <th>Status</th>
                            <td class="text-end">
                                <span class="badge rounded-pill bg-danger">Rejected</span>
                            </td>
                        </tr>
                        @endif
            </table>

            <div class="row pt-3">
                @if (empty($item->kitchen_id) || $item->kitchen_id === auth()->user()->kitchen->id)
                    @if ($item->status === 'cooking')
                        <div class="col-6">
                            <button class="btn btn-sm btn-primary w-100" id="details" data-id="{{ $item->id }}">Details</button>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-sm btn-success w-100" onclick="serve({{ $item->id }})">Serve</button>
                        </div>
                    @elseif ($item->status === 'serve')
                        <div class="col-12">
                            <button class="btn btn-sm btn-success w-100" id="details" data-id="{{ $item->id }}">Served Details</button>
                        </div>
                    @elseif ($item->status === 'reject')
                        <div class="col-12">
                            <button class="btn btn-sm btn-danger w-100" id="details" data-id="{{ $item->id }}">Rejected Details</button>
                        </div>
                    @else 
                        <div class="col-6">
                            <button class="btn btn-sm btn-primary w-100" id="details" data-id="{{ $item->id }}">Details</button>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-sm btn-danger w-100" onclick="reject({{ $item->id }})">Reject Order</button>
                        </div>
                    @endif
                @else
                    <div class="col-12">
                        <button class="btn btn-sm btn-info w-100" id="details" data-id="{{ $item->id }}">Details</button>
                    </div>
                @endif
            </div>
        </div>
        </div>
    </div>    
@endforeach
</div>