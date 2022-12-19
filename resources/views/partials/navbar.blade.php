<header class="header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-5 col-md-5 col-6">
          <div class="header-left d-flex align-items-center">
            <div class="menu-toggle-btn mr-20">
              <button
                id="menu-toggle"
                class="main-btn primary-btn btn-hover"
              >
                <i class="lni lni-chevron-left me-2"></i> Menu
              </button>
            </div>
          </div>
        </div>
        <div class="col-lg-7 col-md-7 col-6">
          <div class="header-right">
            <!-- notification start -->
            {{-- <div class="notification-box ml-15 d-none d-md-flex">
              <button
                class="dropdown-toggle"
                type="button"
                id="notification"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <i class="lni lni-alarm"></i>
                <span>2</span>
              </button>
              <ul
                class="dropdown-menu dropdown-menu-end"
                aria-labelledby="notification"
              >
                <li>
                  <a href="#0">
                    <div class="image">
                      <img src="assets/images/lead/lead-6.png" alt="" />
                    </div>
                    <div class="content">
                      <h6>
                        John Doe
                        <span class="text-regular">
                          comment on a product.
                        </span>
                      </h6>
                      <p>
                        Lorem ipsum dolor sit amet, consect etur adipiscing
                        elit Vivamus tortor.
                      </p>
                      <span>10 mins ago</span>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="#0">
                    <div class="image">
                      <img src="assets/images/lead/lead-1.png" alt="" />
                    </div>
                    <div class="content">
                      <h6>
                        Jonathon
                        <span class="text-regular">
                          like on a product.
                        </span>
                      </h6>
                      <p>
                        Lorem ipsum dolor sit amet, consect etur adipiscing
                        elit Vivamus tortor.
                      </p>
                      <span>10 mins ago</span>
                    </div>
                  </a>
                </li>
              </ul>
            </div>
            <!-- notification end -->
            <!-- message start -->
            
            <!-- message end -->
            <!-- filter start -->
             --}}
            <!-- filter end -->
            <!-- profile start -->
            <div class="ml-15 d-none d-md-flex">
              <a href="/archive">
                <button class="" type="button" id="filter">
                  <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M18 11.18V10H20V11.03C19.84 11 19.67 11 19.5 11C19 11 18.5 11.07 18 11.18M15 11.5C15 11.22 14.78 11 14.5 11H9.5C9.22 11 9 11.22 9 11.5V13H14.82C14.88 12.94 14.94 12.88 15 12.82V11.5M6 19V10H4V21H14.03C13.64 20.39 13.35 19.72 13.18 19H6M21 9H3V3H21V9M19 5H5V7H19V5M19 13.5V12L16.75 14.25L19 16.5V15C20.38 15 21.5 16.12 21.5 17.5C21.5 17.9 21.41 18.28 21.24 18.62L22.33 19.71C22.75 19.08 23 18.32 23 17.5C23 15.29 21.21 13.5 19 13.5M19 20C17.62 20 16.5 18.88 16.5 17.5C16.5 17.1 16.59 16.72 16.76 16.38L15.67 15.29C15.25 15.92 15 16.68 15 17.5C15 19.71 16.79 21.5 19 21.5V23L21.25 20.75L19 18.5V20Z" />
                  </svg>
                  @if (Session::get('archive') != 0)
                    <span>{{ Session::get('archive'); }}</span>
                  @endif
                </button>
              </a>
            </div>
            <div class="ml-15 d-none d-md-flex">
              <a href="/recycle">
                <button class="" type="button" id="filter">
                  <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M21.82,15.42L19.32,19.75C18.83,20.61 17.92,21.06 17,21H15V23L12.5,18.5L15,14V16H17.82L15.6,12.15L19.93,9.65L21.73,12.77C22.25,13.54 22.32,14.57 21.82,15.42M9.21,3.06H14.21C15.19,3.06 16.04,3.63 16.45,4.45L17.45,6.19L19.18,5.19L16.54,9.6L11.39,9.69L13.12,8.69L11.71,6.24L9.5,10.09L5.16,7.59L6.96,4.47C7.37,3.64 8.22,3.06 9.21,3.06M5.05,19.76L2.55,15.43C2.06,14.58 2.13,13.56 2.64,12.79L3.64,11.06L1.91,10.06L7.05,10.14L9.7,14.56L7.97,13.56L6.56,16H11V21H7.4C6.47,21.07 5.55,20.61 5.05,19.76Z" />
                  </svg>
                  @if (Session::get('recycle') != 0)
                    <span>{{ Session::get('recycle'); }}</span>
                  @endif
                </button>
              </a>
            </div>
            <div class="profile-box ml-15">
              <button
                class="dropdown-toggle bg-transparent border-0"
                type="button"
                id="profile"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <div class="profile-info">
                  <div class="info">
                    <h6>{{ Str::ucfirst(auth()->user()->level) }}</h6>
                  </div>
                </div>
                <i class="lni lni-chevron-down"></i>
              </button>
              <ul
                class="dropdown-menu dropdown-menu-end"
                aria-labelledby="profile"
              >
                <li>
                  <a href="#0"> <i class="lni lni-cog"></i> Settings </a>
                </li>
                <li>
                  <a href="/logout"> <i class="lni lni-exit"></i> Sign Out </a>
                </li>
              </ul>
            </div>
            <!-- profile end -->
          </div>
        </div>
      </div>
    </div>
</header>