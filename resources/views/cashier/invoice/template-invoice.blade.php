<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $fileName }}</title>
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendor/bootstrap-5.2.2-dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/main.css" />
    <style>
        .card-style {
            box-sizing: none;
            border: none;
            box-shadow: none;
            border-radius: none;
        }
    </style>
</head>
<body style="background-color: #FFFFFF">
<div class="row">
    <div class="col-12">
        <div class="invoice-card card-style" style="padding-top: 50px">
            <div class="invoice-for" style="position: absolute;">
                <h2 class="mb-10">Restaurant</h2>
                <p class="text-sm">
                    Thank you for placing your order!
                </p>
            </div>
            <div class="invoice-date" style="float: right;">
                <p style="font-size: 12px"><span>Cashier: {{ strtok($head[0]->cashier->name, " ") }}</span></p>
                <p style="font-size: 12px"><span>Order ID: #{{ $head[0]->id }}</span> </p>
                <p style="font-size: 12px"><span>Date Transaction: {{ date('d/m/Y', strtotime($head[0]->created_at)); }}</span></p>
            </div>
        <div class="invoice-address" style="padding-top: 100px">
            <hr>
            <div class="address-item">
                <h5 class="text-bold">To</h5>
                <h1 class="text-capitalize">{{ $head[0]->customer->name }}</h1>
            </div>
        </div>
        <div class="table-responsive">
            <table class="invoice-table table">
            <thead>
                <tr>
                <th class="product" style="text-align: center">
                    <h6 class="text-sm text-medium">Product</h6>
                </th>
                <th class="category" style="text-align: center">
                    <h6 class="text-sm text-medium">Category</h6>
                </th>
                <th class="qty" style="text-align: center">
                    <h6 class="text-sm text-medium">Qty</h6>
                </th>
                <th class="amount" style="text-align: center">
                    <h6 class="text-sm text-medium">Amounts</h6>
                </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($body as $item)
                <tr>
                    <td style="text-align: left">
                        <p>
                            {{ $item->product->product_name }}
                        </p>
                    </td>
                    <td style="text-align: center">
                        <p>
                            {{ $item->product->category->category }}
                        </p>
                    </td>
                    <td style="text-align: center">
                        <p>{{ $item->qty }}</p>
                    </td>
                    <td style="text-align: right">
                        <p>@currency($item->subtotal)</p>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <h6 class="text-sm text-medium">Subtotal</h6>
                    </td>
                    <td style="text-align: right">
                        <h6>@currency($subtotal[0]->grand_total)</h6>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <h6 class="text-sm text-medium">Tax</h6>
                    </td>
                    <td style="text-align: right">
                        <h6>{{ $head[0]->tax }}%</h6>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <h4>Grand Total</h4>
                    </td>
                    <td style="text-align: right">
                        <h4>@currency($head[0]->grand_total)</h4>
                    </td>
                </tr>
            </tbody>
            </table>
        </div>
        </div>
        <!-- End Card -->
    </div>
    <!-- ENd Col -->
</div>
</body>
</html>