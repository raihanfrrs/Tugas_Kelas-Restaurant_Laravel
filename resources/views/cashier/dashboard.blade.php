<div class="row">
    <div class="col-xl-4 col-lg-4 col-sm-6">
        <div class="icon-card mb-30">
            <div class="icon purple">
                <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M20 3H16.8C16.4 1.8 15.3 1 14 1C12.7 1 11.6 1.8 11.2 3H8C6.9 3 6 3.9 6 5V17C6 18.1 6.9 19 8 19H20C21.1 19 22 18.1 22 17V5C22 3.9 21.1 3 20 3M14 3C14.6 3 15 3.5 15 4C15 4.5 14.5 5 14 5C13.5 5 13 4.5 13 4C13 3.5 13.4 3 14 3M16 14H9V12H16M19 10H9V8H19M4 21H18V23H4C2.9 23 2 22.1 2 21V7H4" />
                </svg>
            </div>
            <div class="content">
                <h6 class="mb-10">Task Completed</h6>
                <h3 class="text-bold mb-10">+{{ $task_completed }}</h3>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-sm-6">
        <div class="icon-card mb-30">
            <div class="icon success">
                <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M18.06 23H19.72C20.56 23 21.25 22.35 21.35 21.53L23 5.05H18V1H16.03V5.05H11.06L11.36 7.39C13.07 7.86 14.67 8.71 15.63 9.65C17.07 11.07 18.06 12.54 18.06 14.94V23M1 22V21H16.03V22C16.03 22.54 15.58 23 15 23H2C1.45 23 1 22.54 1 22M16.03 15C16.03 7 1 7 1 15H16.03M1 17H16V19H1V17Z" />
                </svg>
            </div>
            <div class="content">
            <h6 class="mb-10">Products Sold</h6>
            @if ($products_sold->isEmpty())
                <h3 class="text-bold mb-10">+0</h3>
            @else
                <h3 class="text-bold mb-10">+{{ number_format($products_sold[0]->total_qty) }}</h3>
            @endif
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-sm-6">
        <div class="icon-card mb-30">
            <div class="icon primary">
                <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M12,5.5A3.5,3.5 0 0,1 15.5,9A3.5,3.5 0 0,1 12,12.5A3.5,3.5 0 0,1 8.5,9A3.5,3.5 0 0,1 12,5.5M5,8C5.56,8 6.08,8.15 6.53,8.42C6.38,9.85 6.8,11.27 7.66,12.38C7.16,13.34 6.16,14 5,14A3,3 0 0,1 2,11A3,3 0 0,1 5,8M19,8A3,3 0 0,1 22,11A3,3 0 0,1 19,14C17.84,14 16.84,13.34 16.34,12.38C17.2,11.27 17.62,9.85 17.47,8.42C17.92,8.15 18.44,8 19,8M5.5,18.25C5.5,16.18 8.41,14.5 12,14.5C15.59,14.5 18.5,16.18 18.5,18.25V20H5.5V18.25M0,20V18.5C0,17.11 1.89,15.94 4.45,15.6C3.86,16.28 3.5,17.22 3.5,18.25V20H0M24,20H20.5V18.25C20.5,17.22 20.14,16.28 19.55,15.6C22.11,15.94 24,17.11 24,18.5V20Z" />
                </svg>
            </div>
            <div class="content">
            <h6 class="mb-10">All Earnings</h6>
            @if ($all_earnings->isEmpty())
                <h3 class="text-bold mb-10">+0</h3>
            @else
                <h3 class="text-bold mb-10">+{{ number_format($all_earnings[0]->all_earnings) }}</h3>
            @endif
            </div>
        </div>
    </div>
</div>