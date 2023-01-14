@extends('layouts.main')

@section('section')
<div class="tables-wrapper">
    @include('cashier.cart.customer-modal')

    <div class="row">
    <div class="col-lg-12">
        <div class="card-style mb-30">
            <div class="table-wrapper table-responsive">
                <div id="read"></div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            read()
        });

        function read() {
            $.get("{{ url('/cart/read') }}", {}, function(cart, status){
                $("#cart").load(location.href + " #cart");
                $("#read").html(cart);
            })
        }

        $(document).on('input', '.qty', function () {
            let key = $(this).attr('data-key');
            let qty = $('#qty_' + key).val();

            if (qty < 1){
                $(this).val(1);
                alert('Quantity cannot be less than 1');
                return;
            }
            
            if (qty > 10000){
                $(this).val(10000);
                alert('Quantity cannot be more than 10000');
                return;
            }

            $.post(`{{ url('cart/update') }}`, {
                '_token': '{{ csrf_token() }}',
                '_method': 'put',
                'id': key,
                'qty': qty 
            })
            .done(response => {
                $(this).on('mouseout', function () {
                    read()
                });
            })
            .fail(errors => {
                return;
            })
        })

        $(document).on('click', '.checkout', function () {
            $('#customer').modal('show');
        });

        $(document).on('click', '#continue_checkout', function () {
            let name = $('#customer_name').val();
            
            if(name.length < 1){
                alert('Customer name must have at least 1 letter');
                return;
            }

            $.post(`{{ url('transaction') }}`, {
                '_token': '{{ csrf_token() }}',
                '_method': 'post',
                'customer_name': name
            })
            .done(response => {
                $('#customer').modal('hide')
                read()
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Transaction Successfuly',
                    showConfirmButton: false,
                    timer: 2000
                })
                window.setTimeout(function(){
                    window.open("{{ url('invoice') }}/" + response + "/read");
                }, 2500);
                return;
            })
            .fail(errors => {
                return;
            })
        });

        // $(document).on('change', '.qty', function(e){
        //     let key = $(this).attr('data-key');
        //     let qty = $('#qty_' + key).val();
            
        // });

        function destroy(id) {
            $.ajax({
                type: "delete",
                url: "{{ url('cart') }}/" + id,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                success: function(data){
                    read()
                }
            });
        }
    </script>
@endpush