<table class="table">
    <thead class="text-center">
        <th>No</th>
        <th></th>
        <th>Product</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Amounts</th>
        <th></th>
    </thead>
    <tbody>
        @if ($cart->isEmpty())
            <tr>
                <td colspan="7">
                    <div class="alert alert-warning text-center" role="alert">
                        There are no products added to the cart!
                    </div>
                </td>
            </tr>
        @else 
            @foreach ($cart as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td style="width: 20%;">
                        <div style="max-height: 150px; overflow: hidden;">
                            @if ($item->product->image)
                            <img src="{{ asset('storage/'.$item->product->image) }}" class="img-thumbnail rounded" alt="product image">
                            @else
                                <img src="https://source.unsplash.com/800x400?food" class="img-fluid rounded" alt="product image">
                            @endif
                        </div>
                    </td>
                    <td class="text-center fs-5">
                        {{ $item->product->product_name }}
                    </td>
                    <td class="text-center fs-5">
                        @currency($item->product->price)
                    </td>
                    <td class="text-center">
                        <a href="test"></a>
                        <input type="number" class="form-control d-inline w-50 text-center qty" data-key="{{ $item->id }}" id="qty_{{ $item->id }}" value="{{ $item->qty }}" min="1" max="10000">
                    </td>
                    <td class="text-center fs-5">
                        @currency($item->product->price*$item->qty)
                    </td>
                    <td>
                        <button class="btn" onClick="destroy({{ $item->product_id }})">
                            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M14.1 8.5L12 6.4L9.9 8.5L8.5 7.1L10.6 5L8.5 2.9L9.9 1.5L12 3.6L14.1 1.5L15.5 2.9L13.4 5L15.5 7.1L14.1 8.5M7 18C8.1 18 9 18.9 9 20S8.1 22 7 22 5 21.1 5 20 5.9 18 7 18M17 18C18.1 18 19 18.9 19 20S18.1 22 17 22 15 21.1 15 20 15.9 18 17 18M7.2 14.8C7.2 14.9 7.3 15 7.4 15H19V17H7C5.9 17 5 16.1 5 15C5 14.6 5.1 14.3 5.2 14L6.5 11.6L3 4H1V2H4.3L8.6 11H15.6L19.5 4L21.2 5L17.3 12C17 12.6 16.3 13 15.6 13H8.1L7.2 14.6V14.8Z" />
                            </svg>
                        </button>
                    </td>
                </tr>
            @endforeach
                <tr>
                    <td colspan="5" class="text-end fs-5">Subtotal</td>
                    <td class="text-center fs-5">@currency($grand_total[0]->grand_total)</td>
                </tr>
                <tr>
                    <td colspan="5" class="text-end fs-5">Tax</td>
                    @if ($tax->count() > 0)
                        <td class="text-center fs-5">{{ $tax[0]->tax }}%</td>
                    @else
                        <td class="text-center fs-5">0%</td>
                    @endif
                </tr>
                <tr>
                    <td colspan="5" class="text-end fs-5 fw-bold">Grand Total</td>
                    @if ($tax->count() > 0)
                        <td class="text-center fs-5 fw-bold">@currency($grand_total[0]->grand_total + ($grand_total[0]->grand_total * $tax[0]->tax / 100))</td>
                    @else
                        <td class="text-center fs-5 fw-bold">@currency($grand_total[0]->grand_total + ($grand_total[0]->grand_total * 0 / 100))</td>
                    @endif
                </tr>
                <tr>
                    <td colspan="5"></td>
                    <td class="d-flex justify-content-center">
                        <button class="btn btn-lg btn-primary checkout">
                            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M9,20A2,2 0 0,1 7,22A2,2 0 0,1 5,20A2,2 0 0,1 7,18A2,2 0 0,1 9,20M17,18A2,2 0 0,0 15,20A2,2 0 0,0 17,22A2,2 0 0,0 19,20A2,2 0 0,0 17,18M7.2,14.63C7.19,14.67 7.19,14.71 7.2,14.75A0.25,0.25 0 0,0 7.45,15H19V17H7A2,2 0 0,1 5,15C5,14.65 5.07,14.31 5.24,14L6.6,11.59L3,4H1V2H4.27L5.21,4H20A1,1 0 0,1 21,5C21,5.17 20.95,5.34 20.88,5.5L17.3,12C16.94,12.62 16.27,13 15.55,13H8.1L7.2,14.63M9,9.5H13V11.5L16,8.5L13,5.5V7.5H9V9.5Z" />
                            </svg>
                            Place Order
                        </button>
                    </td>
                </tr>
        @endif
    </tbody>
</table>