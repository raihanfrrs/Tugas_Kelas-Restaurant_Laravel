@extends('layouts.main')

@section('section')
<div class="row">
    <div class="col-12">
        <div class="invoice-card card-style mb-30">
        <div class="invoice-header">
            <div class="invoice-for">
                <h2 class="mb-10">Restaurant</h2>
                <p class="text-sm">
                    Thank you for placing your order!
                </p>
            </div>
            <div class="invoice-date">
                <p><span>Cashier:</span> {{ strtok($head[0]->cashier->name, " ") }}</p>
                <p><span>Order ID:</span> #{{ $head[0]->id }}</p>
                <p><span>Date Transaction:</span> {{ date('d/m/Y', strtotime($head[0]->created_at)); }}</p>
            </div>
        </div>
        <div class="invoice-address">
            <div class="address-item">
            <h5 class="text-bold">To</h5>
            <h1 class="text-capitalize">{{ $head[0]->customer->name }}</h1>
            </div>
        </div>
        <div class="table-responsive">
            <table class="invoice-table table">
            <thead>
                <tr>
                <th class="product">
                    <h6 class="text-sm text-medium">Product</h6>
                </th>
                <th class="category">
                    <h6 class="text-sm text-medium">Category</h6>
                </th>
                <th class="qty">
                    <h6 class="text-sm text-medium">Qty</h6>
                </th>
                <th class="amount">
                    <h6 class="text-sm text-medium">Amounts</h6>
                </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($body as $item)
                <tr>
                    <td>
                        <p class="text-sm">
                            {{ $item->product->product_name }}
                        </p>
                    </td>
                    <td>
                        <p class="text-sm">
                            {{ $item->product->category->category }}
                        </p>
                    </td>
                    <td>
                        <p class="text-sm">{{ $item->qty }}</p>
                    </td>
                    <td>
                        <p class="text-sm">@currency($item->subtotal)</p>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <h6 class="text-sm text-medium">Subtotal</h6>
                    </td>
                    <td>
                        <h6 class="text-sm text-bold">@currency($subtotal[0]->grand_total)</h6>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <h6 class="text-sm text-medium">Tax</h6>
                    </td>
                    <td>
                        <h6 class="text-sm text-bold">{{ $head[0]->tax }}%</h6>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <h4>Grand Total</h4>
                    </td>
                    <td>
                        <h4>@currency($head[0]->grand_total)</h4>
                    </td>
                </tr>
            </tbody>
            </table>
        </div>
        <div class="invoice-action mt-5">
            <ul
            class="
                d-flex
                flex-wrap
                align-items-center
                justify-content-center
            "
            >
            <li class="m-2">
                <a
                href="@if(auth()->user()->level === 'administrator') /invoice/{{ $head[0]->id }}/download @else /invoice/download/{{ $head[0]->id }} @endif"
                class="main-btn primary-btn-outline btn-hover"
                >
                Download Invoice
                </a>
            </li>
            <li class="m-2">
                <a href="@if(auth()->user()->level === 'administrator') /invoice/{{ $head[0]->id }}/print @else /invoice/print/{{ $head[0]->id }} @endif" target="_blank" 
                class="main-btn primary-btn btn-hover"
                >
                Print Invoice
                </a>
            </li>
            </ul>
        </div>
        </div>
        <!-- End Card -->
    </div>
    <!-- ENd Col -->
</div>
@endsection