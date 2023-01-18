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
            <div class="icon danger">
                <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M19 3H14.82C14.4 1.84 13.3 1 12 1S9.6 1.84 9.18 3H5C3.9 3 3 3.9 3 5V19C3 20.11 3.9 21 5 21H19C20.11 21 21 20.11 21 19V5C21 3.9 20.11 3 19 3M12 3C12.55 3 13 3.45 13 4S12.55 5 12 5 11 4.55 11 4 11.45 3 12 3M19 19H5V5H7V7H17V5H19V19M15.54 10.88L13.41 13L15.54 15.12L14.12 16.54L12 14.41L9.88 16.54L8.47 15.12L10.59 13L8.47 10.88L9.88 9.47L12 11.59L14.12 9.47L15.54 10.88Z" />
                </svg>
            </div>
            <div class="content">
            <h6 class="mb-10">Task Rejected</h6>
                <h3 class="text-bold mb-10">+{{ $task_rejected }}</h3>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-sm-6">
        <div class="icon-card mb-30">
            <div class="icon primary">
                <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M18.06 23H19.72C20.56 23 21.25 22.35 21.35 21.53L23 5.05H18V1H16.03V5.05H11.06L11.36 7.39C13.07 7.86 14.67 8.71 15.63 9.65C17.07 11.07 18.06 12.54 18.06 14.94V23M1 22V21H16.03V22C16.03 22.54 15.58 23 15 23H2C1.45 23 1 22.54 1 22M16.03 15C16.03 7 1 7 1 15H16.03M1 17H16V19H1V17Z" />
                </svg>
            </div>
            <div class="content">
            <h6 class="mb-10">Products Cooked</h6>
            @if (empty($products_cooked[0]->products_cooked))
                <h3 class="text-bold mb-10">+0</h3>
            @else
                <h3 class="text-bold mb-10">+{{ $products_cooked[0]->products_cooked }}</h3>
            @endif
            </div>
        </div>
    </div>
</div>