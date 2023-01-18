<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment Receipt</title>
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendor/bootstrap-5.2.2-dist/css/bootstrap.min.css" />
</head>
<style>
*, ::before, ::after {
    box-sizing: border-box;
}

*, *::before, *::after {
    box-sizing: inherit;
}

body {
    font-family: 'Open Sauce One',sans-serif;
    font-size: 18px;
    line-height: 22px;
    color: #606060;
}

.products {
    border-top: 1px dashed black;
}
</style>
<body>
    <div class="payment-receipt w-50">
        <div class="border border-dark">
            <div class="p-3">
                <div class="row">
                    <p class="text-uppercase fw-bold text-center">Restaurant</p>
                </div>
                <div class="row gx-0 pb-2">
                    <table>
                        <tr>
                          <th>Receipt Code:</th>
                          <td class="text-end">#{{ $head[0]->id }}</td>
                        </tr>
                        <tr>
                          <th>Date:</th>
                          <td class="text-end">{{ $head[0]->created_at }}</td>
                        </tr>
                        <tr>
                          <th>Cashier:</th>
                          <td class="text-end">{{ strtok($head[0]->cashier->name, " ") }}</td>
                        </tr>
                        <tr>
                          <th>Customer:</th>
                          <td class="text-end">{{ $head[0]->customer->name }}</td>
                        </tr>
                    </table>
                </div>
                <div class="row products gx-0 pb-2">
                    <table class="mt-2">
                        @foreach ($body as $item)
                            <tr>
                                <td class="text-start">{{ $item->product->product_name }}</td>
                                <td class="text-center">{{ $item->qty }}x</td>
                                <td class="text-end">@currency($item->product->price)</td>
                            </tr>
                        @endforeach
                      </table>
                </div>
                <div class="row products gx-0 pb-5">
                    <table class="mt-2">
                        <tr>
                            <td class="text-start">Subtotal</td>
                            <td class="text-end">@currency($subtotal[0]->grand_total)</td>
                        </tr>
                        <tr>
                            <td class="text-start">Tax ({{ $head[0]->tax }}%)</td>
                            <td class="text-end">@currency($head[0]->grand_total - $subtotal[0]->grand_total)</td>
                        </tr>
                        <tr>
                            <td class="text-start">Total</td>
                            <td class="text-end">@currency($head[0]->grand_total)</td>
                        </tr>
                    </table>
                </div>
                <div class="row pb-3 gx-0">
                    <p class="text-center">Have a Nice Day</p>
                </div>
                <div class="row products gx-0">
                    <p class="text-center mt-3">Develop By Mohamad Raihan Farras</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script>
window.print();
</script>