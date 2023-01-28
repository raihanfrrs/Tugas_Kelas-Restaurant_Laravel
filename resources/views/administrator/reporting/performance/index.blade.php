@extends('layouts.main')

@section('section')
<div class="tables-wrapper">
    <div class="row">
        <div class="col-lg-6">
            <div class="card-style mb-30">
                <h6 class="mb-10">Cashier</h6>
                <div class="table-wrapper table-responsive">
                    <table id="dataPerformanceCashier" class="table" data-id="1">
                        <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Total Orders</th>
                            <th>Products Sell</th>
                            <th>Total Earnings</th>
                            <th>Status</th>
                            <th class="not-export-col">Action</th>
                        </thead>
                    </table>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card-style mb-30">
                <h6 class="mb-10">Kitchen</h6>
                <div class="table-wrapper table-responsive">
                    <table id="dataPerformanceKitchen" class="table">
                        <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Orders Accepted</th>
                            <th>Orders Rejected</th>
                            <th>Products Cooked</th>
                            <th>Status</th>
                            <th class="not-export-col">Action</th>
                        </thead>
                    </table>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection