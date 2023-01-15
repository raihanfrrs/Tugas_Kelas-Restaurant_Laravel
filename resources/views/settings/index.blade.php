@extends('layouts.main')

@section('section')
<ul class="nav nav-pills nav-justified" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" data-bs-toggle="pill" href="#home">Profile Settings</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="pill" href="#menu1">Change Password</a>
    </li>
</ul>
    
<div class="tab-content">
    <div id="home" class="tab-pane active"><br>
        <form action="settings/{{ auth()->user()->id }}/profile" method="post">
        @csrf
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
                <h6>My Profile</h6>
                <button class="border-0 bg-transparent">
                    <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12H20A8,8 0 0,1 12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4V2M18.78,3C18.61,3 18.43,3.07 18.3,3.2L17.08,4.41L19.58,6.91L20.8,5.7C21.06,5.44 21.06,5 20.8,4.75L19.25,3.2C19.12,3.07 18.95,3 18.78,3M16.37,5.12L9,12.5V15H11.5L18.87,7.62L16.37,5.12Z" />
                    </svg>
                </button>
            </div>
            <div class="profile-info">
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                <div class="d-flex align-items-center mb-30">
                    <div class="profile-image">
                        <img src="assets/images/profile/profile-1.png" alt="" />
                        <div class="update-image">
                        <input type="file" name="image" id="image">
                        <label for="image">
                            <svg style="width:14px;height:14px" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M17 17V21H19V17H21L18 14L15 17H17M11 4C8.8 4 7 5.8 7 8S8.8 12 11 12 15 10.2 15 8 13.2 4 11 4M11 6C12.1 6 13 6.9 13 8S12.1 10 11 10 9 9.1 9 8 9.9 6 11 6M11 13C8.3 13 3 14.3 3 17V20H12.5C12.2 19.4 12.1 18.8 12 18.1H4.9V17C4.9 16.4 8 14.9 11 14.9C11.5 14.9 12 15 12.5 15C12.8 14.4 13.1 13.8 13.6 13.3C12.6 13.1 11.7 13 11 13" />
                            </svg>
                        </label>
                        </div>
                    </div>
                    <div class="profile-meta">
                        <h5 class="text-bold text-dark mb-10">
                            @if (auth()->user()->level == 'administrator')
                                {{ auth()->user()->admin->name }}
                            @elseif (auth()->user()->level == 'cashier')
                                {{ auth()->user()->cashier->name }}
                            @elseif (auth()->user()->level == 'kitchen')
                                {{ auth()->user()->kitchen->name }}
                            @endif
                        </h5>
                        <p class="text-sm text-gray text-capitalize">{{ auth()->user()->level }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="input-style-1">
                        <label>Full Name</label>
                        @if (auth()->user()->level == 'administrator')
                            <input
                                type="text"
                                placeholder="Full Name"
                                value="{{ old('name', auth()->user()->admin->name) }}"
                                name="name"
                                class="@error('name') is-invalid @enderror"
                                autocomplete="off"
                                required
                            />
                        @elseif (auth()->user()->level == 'cashier')
                            <input
                                type="text"
                                placeholder="Full Name"
                                value="{{ old('name', auth()->user()->cashier->name) }}"
                                name="name"
                                class="@error('name') is-invalid @enderror"
                                autocomplete="off"
                                required
                            />
                        @elseif (auth()->user()->level == 'kitchen')
                            <input
                                type="text"
                                placeholder="Full Name"
                                value="{{ old('name', auth()->user()->kitchen->name) }}"
                                name="name"
                                class="@error('name') is-invalid @enderror"
                                autocomplete="off"
                                required
                            />
                        @endif
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="input-style-1">
                        <label>Email</label>
                        @if (auth()->user()->level == 'administrator')
                            <input
                                type="email"
                                placeholder="Email"
                                value="{{ old('email', auth()->user()->admin->email) }}"
                                name="email"
                                class="@error('email') is-invalid @enderror"
                                autocomplete="off"
                                required
                            />
                        @elseif (auth()->user()->level == 'cashier')
                            <input
                                type="email"
                                placeholder="Email"
                                value="{{ old('email', auth()->user()->cashier->email) }}"
                                name="email"
                                class="@error('email') is-invalid @enderror"
                                autocomplete="off"
                                required
                            />
                        @elseif (auth()->user()->level == 'kitchen')
                            <input
                                type="email"
                                placeholder="Email"
                                value="{{ old('email', auth()->user()->kitchen->email) }}"
                                name="email"
                                class="@error('email') is-invalid @enderror"
                                autocomplete="off"
                                required
                            />
                        @endif
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <div class="input-style-1">
                            <label>Username</label>
                                <input 
                                    type="text"
                                    placeholder="Username"
                                    value="{{ old('username', auth()->user()->username) }}"
                                    name="username"
                                    class="@error('username') is-invalid @enderror"
                                    autocomplete="off"
                                    required
                                />
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-style-1">
                            <label>Phone</label>
                            @if (auth()->user()->level == 'administrator')
                                <input 
                                    type="text"
                                    placeholder="Phone"
                                    value="{{ old('phone', auth()->user()->admin->phone) }}"
                                    name="phone"
                                    id="phone"
                                    class="@error('phone') is-invalid @enderror"
                                    autocomplete="off"
                                    required
                                />
                            @elseif (auth()->user()->level == 'cashier')
                                <input 
                                    type="text"
                                    placeholder="Phone"
                                    value="{{ old('phone', auth()->user()->cashier->phone) }}"
                                    name="phone"
                                    id="phone"
                                    class="@error('phone') is-invalid @enderror"
                                    autocomplete="off"
                                    required
                                />
                            @elseif (auth()->user()->level == 'kitchen')
                                <input 
                                    type="text"
                                    placeholder="Phone"
                                    value="{{ old('phone', auth()->user()->kitchen->phone) }}"
                                    name="phone"
                                    id="phone"
                                    class="@error('phone') is-invalid @enderror"
                                    autocomplete="off"
                                    required
                                />
                            @endif
                            @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </form>
            </div>
            </div>
        </form>
    </div>
</div>
<div id="menu1" class="tab-pane"><br>
    <h3>CHANGE PASSWORD</h3>
    <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
</div>
@endsection

@push('scripts')
    <script>
        $(document).on('change', '#phone', function () {
            let phone = parseInt($('#phone').val());
            if (!phone) {
                alert("Phone must be numbers");
                return;
            }
        })
    </script>
@endpush