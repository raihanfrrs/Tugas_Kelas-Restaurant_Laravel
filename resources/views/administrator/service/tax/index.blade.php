@extends('layouts.main')

@section('section')
<div class="row">
    <div class="col-lg-3">
      <div class="card-style settings-card-1 mb-30">
        <div
          class="
            title
            mb-30
            d-flex
            justify-content-between
            align-items-center
          "
        >
          <h6>Tax</h6>
        </div>
        <form action="/service/tax/store" method="post">
            @csrf
            <div class="input-style-2">
                <input type="number" class="@error('tax') is-invalid @enderror" id="tax" name="tax" min="0" max="100" value="{{ old("tax", "0") }}"/>
                @error('tax')
                    <div class="invalid-feedback">
                        {{ $msg }}
                    </div>
                @enderror
                <span class="icon">
                    <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M18.5 3.5L20.5 5.5L5.5 20.5L3.5 18.5L18.5 3.5M7 4C8.66 4 10 5.34 10 7C10 8.66 8.66 10 7 10C5.34 10 4 8.66 4 7C4 5.34 5.34 4 7 4M17 14C18.66 14 20 15.34 20 17C20 18.66 18.66 20 17 20C15.34 20 14 18.66 14 17C14 15.34 15.34 14 17 14M7 6C6.45 6 6 6.45 6 7C6 7.55 6.45 8 7 8C7.55 8 8 7.55 8 7C8 6.45 7.55 6 7 6M17 16C16.45 16 16 16.45 16 17C16 17.55 16.45 18 17 18C17.55 18 18 17.55 18 17C18 16.45 17.55 16 17 16Z" />
                    </svg>
                </span>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="main-btn primary-btn btn-sm rounded-full btn-hover" id="btn-tax">
                    <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M14 12.8C13.5 12.31 12.78 12 12 12C10.34 12 9 13.34 9 15C9 16.31 9.84 17.41 11 17.82C11.07 15.67 12.27 13.8 14 12.8M11.09 19H5V5H16.17L19 7.83V12.35C19.75 12.61 20.42 13 21 13.54V7L17 3H5C3.89 3 3 3.9 3 5V19C3 20.1 3.89 21 5 21H11.81C11.46 20.39 11.21 19.72 11.09 19M6 10H15V6H6V10M15.75 21L13 18L14.16 16.84L15.75 18.43L19.34 14.84L20.5 16.25L15.75 21" />
                    </svg>
                    Save
                </button>
            </div>
        </form>
      </div>
    </div>

    <div class="col-lg-9">
      <div class="card-style settings-card-2 mb-30">
        <div class="table-wrapper table-responsive">
            <table id="dataTax" class="table text-center">
                <thead>
                    <th>Tax Amount (%)</th>
                    <th>Status</th>
                    <th>Action</th>
                </thead>            
            </table>
        </div>
      </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).on('change', '#tax', function () {
            let tax = $('#tax').val();
            
            if (tax < 0){
                $(this).val(0);
                alert('Tax cannot be less than 0');
                return;
            }
            
            if (tax > 100){
                $(this).val(100);
                alert('Tax cannot be more than 100');
                return;
            }
        });
    </script>
@endpush