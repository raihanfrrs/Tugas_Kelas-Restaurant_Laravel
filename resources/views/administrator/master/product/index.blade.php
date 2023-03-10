@extends('layouts.main')

@section('section')
<div class="tables-wrapper">
    <div class="row">
    <div class="col-lg-12">
        <div class="card-style mb-30">
            <p class="text-sm mb-30">
                <a href="product/create" class="main-btn primary-btn btn-sm rounded-md btn-hover">
                    <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M3 16H10V14H3M18 14V10H16V14H12V16H16V20H18V16H22V14M14 6H3V8H14M14 10H3V12H14V10Z" />
                    </svg>
                    Product
                </a>
            </p>
        <div class="table-wrapper table-responsive">
            <table id="dataProduct" class="table">
                <thead>
                    <th>ID</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Action</th>
                </thead>
            </table>
            </table>
        </div>
        </div>
    </div>
    </div>
</div>
@endsection