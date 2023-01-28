<div class="row">
    <div class="col-xl-3 col-lg-4 col-sm-6">
    <div class="icon-card mb-30">
        <div class="icon purple">
            <i class="lni lni-cart-full"></i>
        </div>
        <div class="content">
            <h6 class="mb-10">Total Orders</h6>
            <h3 class="text-bold mb-10">{{ $total_orders }}</h3>
        </div>
    </div>
    <!-- End Icon Cart -->
    </div>
    <!-- End Col -->
    <div class="col-xl-3 col-lg-4 col-sm-6">
    <div class="icon-card mb-30">
        <div class="icon success">
            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                <path fill="currentColor" d="M5,6H23V18H5V6M14,9A3,3 0 0,1 17,12A3,3 0 0,1 14,15A3,3 0 0,1 11,12A3,3 0 0,1 14,9M9,8A2,2 0 0,1 7,10V14A2,2 0 0,1 9,16H19A2,2 0 0,1 21,14V10A2,2 0 0,1 19,8H9M1,10H3V20H19V22H1V10Z" />
            </svg>
        </div>
        <div class="content">
        <h6 class="mb-10">Total Income </h6>
        <h3 class="text-bold mb-10">@currency($total_income)</h3>
        </div>
    </div>
    </div>
    <div class="col-xl-3 col-lg-4 col-sm-6">
        <div class="icon-card mb-30">
            <div class="icon primary">
                <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M12,5.5A3.5,3.5 0 0,1 15.5,9A3.5,3.5 0 0,1 12,12.5A3.5,3.5 0 0,1 8.5,9A3.5,3.5 0 0,1 12,5.5M5,8C5.56,8 6.08,8.15 6.53,8.42C6.38,9.85 6.8,11.27 7.66,12.38C7.16,13.34 6.16,14 5,14A3,3 0 0,1 2,11A3,3 0 0,1 5,8M19,8A3,3 0 0,1 22,11A3,3 0 0,1 19,14C17.84,14 16.84,13.34 16.34,12.38C17.2,11.27 17.62,9.85 17.47,8.42C17.92,8.15 18.44,8 19,8M5.5,18.25C5.5,16.18 8.41,14.5 12,14.5C15.59,14.5 18.5,16.18 18.5,18.25V20H5.5V18.25M0,20V18.5C0,17.11 1.89,15.94 4.45,15.6C3.86,16.28 3.5,17.22 3.5,18.25V20H0M24,20H20.5V18.25C20.5,17.22 20.14,16.28 19.55,15.6C22.11,15.94 24,17.11 24,18.5V20Z" />
                </svg>
            </div>
            <div class="content">
            <h6 class="mb-10">Total Customer</h6>
            <h3 class="text-bold mb-10">{{ $total_customers }}</h3>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-4 col-sm-6">
    <div class="icon-card mb-30">
        <div class="icon orange">
            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                <path fill="currentColor" d="M1 22C1 22.54 1.45 23 2 23H15C15.56 23 16 22.54 16 22V21H1V22M8.5 9C4.75 9 1 11 1 15H16C16 11 12.25 9 8.5 9M3.62 13C4.73 11.45 7.09 11 8.5 11S12.27 11.45 13.38 13H3.62M1 17H16V19H1V17M18 5V1H16V5H11L11.23 7H20.79L19.39 21H18V23H19.72C20.56 23 21.25 22.35 21.35 21.53L23 5H18Z" />
            </svg>
        </div>
        <div class="content">
        <h6 class="mb-10">Total Product</h6>
        <h3 class="text-bold mb-10">{{ $total_products }}</h3>
        </div>
    </div>
    <!-- End Icon Cart -->
    </div>
    <!-- End Col -->
</div>
<div class="row">
    <div class="col-xl-6 col-lg-6 col-sm-6">
        <div class="card-style mb-30 p-3">
            <div id="monthly-income"></div>
        </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-sm-6">
        <div class="card-style mb-30 p-3">
            <div id="customer"></div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function (){
            var monthly_income = @php echo json_encode($income) @endphp;
            Highcharts.chart('monthly-income', {
                title : {
                    text : 'Monthly Sales/Revenue'
                },
                xAxis : {
                    categories: [
                    'Jan',
                    'Feb',
                    'Mar',
                    'Apr',
                    'May',
                    'Jun',
                    'Jul',
                    'Aug',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dec'
                    ],
                },
                yAxis : {
                    title : {
                        text : 'Monthly Sales/Revenue'
                    }
                },
                plotOptions : {
                    series : {
                        allowPointSelect : true
                    }
                },
                series : [
                    {
                        name : 'Nominal',
                        data : [monthly_income]
                    }
                ]
            })
        });
    </script>

    <script>
        $(document).ready(function () {
            var moonthly_visitors = @php echo json_encode($visitors) @endphp;
            Highcharts.chart('customer', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Monthly Visitors'
                },
                xAxis: {
                    categories: [
                    'Jan',
                    'Feb',
                    'Mar',
                    'Apr',
                    'May',
                    'Jun',
                    'Jul',
                    'Aug',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dec'
                    ],
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Number of Visitors'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"> <b>{point.y}</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                    }
                },
                series: [{
                    name: 'Visitor',
                    data: [moonthly_visitors]
                }]
            });
        })
    </script>
@endpush