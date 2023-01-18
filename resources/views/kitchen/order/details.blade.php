<div class="modal-header border-0">
    <h5 class="modal-title" id="exampleModalLabel">Details Order For {{ $details[0]->transaction->customer->name }}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body pt-0">
    <table class="table table-hover">
        <thead>
          <tr class="text-center">
            <th scope="col">No</th>
            <th scope="col">Product</th>
            <th scope="col">Quantity</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($details as $item)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->product->product_name }}</td>
                    <td>{{ $item->qty }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if (!empty($details[0]->transaction->kitchen_id))
        <hr>
        <span class="fw-bold">Handled by :</span> <span class="text-end">{{ $details[0]->transaction->kitchen->name }}</span>
    @endif
</div>
@if ($details[0]->transaction->status === 'order')
    <div class="modal-footer border-0">
        <button type="button" class="btn btn-primary" onclick="accept({{ $details[0]->transaction_id }})">Accept Order</button>
    </div>
@endif