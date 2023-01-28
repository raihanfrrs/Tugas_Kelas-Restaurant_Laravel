@extends('layouts.main')

@section('section')
<div class="tables-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="card-style mb-30">
                <div class="table-wrapper table-responsive">
                    <table id="dataDetailTax" class="table" data-id="{{ $tax }}">
                        <thead>
                            <th>Tax (%)</th>
                            <th>Total Income</th>
                            <th>Month</th>
                            <th>Year</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection