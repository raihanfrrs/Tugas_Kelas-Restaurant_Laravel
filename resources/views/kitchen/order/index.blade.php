@extends('layouts.main')

@section('section')
    <div id="read"></div>

    <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div id="show"></div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function (){
            read();
        });

        $(document).on('click', '#details', function () {
            let id = $(this).attr('data-id');

            $.ajax({
                type: "get",
                url: "{{ url('order/details') }}/" + id,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                success: function(data){
                    $("#show").html(data);
                    $('#detailsModal').modal('show'); 
                }
            });
        });

        function read() {
            $.get("{{ url('/order/read') }}", {}, function(order, status){
                $("#read").html(order);
            })
        }

        function accept(id) {
            $.ajax({
                type: "post",
                url: "{{ url('order/status') }}/" + id,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                    "status": "accept"
                },
                success: function(data){
                    $('#detailsModal').modal('hide'); 
                    read()
                }
            });
        }

        function reject(id) {
            $.ajax({
                type: "post",
                url: "{{ url('order/status') }}/" + id,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                    "status": "reject"
                },
                success: function(data){
                    read()
                }
            });
        }

        function serve(id) {
            $.ajax({
                type: "post",
                url: "{{ url('order/status') }}/" + id,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                    "status": "serve"
                },
                success: function(data){
                    read()
                }
            });
        }
    </script>
@endpush