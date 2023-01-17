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
        <form action="settings/{{ auth()->user()->id }}/profile" method="post" enctype="multipart/form-data">
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
                <div class="d-flex align-items-center mb-30">
                    <div class="profile-image">
                        @if (auth()->user()->level == 'administrator')
                            @if (auth()->user()->admin->image)
                                <img src="{{ asset('storage/'. auth()->user()->admin->image) }}" class="img-preview" />
                            @else
                                <img src="{{ asset('/') }}assets/images/profile/profile-2.png" class="img-preview" />
                            @endif
                        @elseif (auth()->user()->level == 'cashier')
                            @if (auth()->user()->cashier->image)
                                <img src="{{ asset('storage/'. auth()->user()->cashier->image) }}" class="img-preview" />
                            @else
                                <img src="{{ asset('/') }}assets/images/profile/profile-2.png" class="img-preview" />
                            @endif
                        @elseif (auth()->user()->level == 'kitchen')
                            @if (auth()->user()->kitchen->image)
                                <img src="{{ asset('storage/'. auth()->user()->kitchen->image) }}" class="img-preview" />
                            @else
                                <img src="{{ asset('/') }}assets/images/profile/profile-2.png" class="img-preview" />
                            @endif
                        @endif
                        <div class="update-image">
                            <input type="file" name="image" id="image" onchange="previewImage()">
                            <label for="image">
                                <svg style="width:20px;height:20px" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M17 17V21H19V17H21L18 14L15 17H17M11 4C8.8 4 7 5.8 7 8S8.8 12 11 12 15 10.2 15 8 13.2 4 11 4M11 6C12.1 6 13 6.9 13 8S12.1 10 11 10 9 9.1 9 8 9.9 6 11 6M11 13C8.3 13 3 14.3 3 17V20H12.5C12.2 19.4 12.1 18.8 12 18.1H4.9V17C4.9 16.4 8 14.9 11 14.9C11.5 14.9 12 15 12.5 15C12.8 14.4 13.1 13.8 13.6 13.3C12.6 13.1 11.7 13 11 13" />
                                </svg>
                            </label>
                        </div>
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
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
            </div>
            </div>
        </form>
    </div>
</div>
<div id="menu1" class="tab-pane"><br>
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
            <h6>Password</h6>
            <button class="border-0 bg-transparent" id="btn-password">
                <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12H20A8,8 0 0,1 12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4V2M18.78,3C18.61,3 18.43,3.07 18.3,3.2L17.08,4.41L19.58,6.91L20.8,5.7C21.06,5.44 21.06,5 20.8,4.75L19.25,3.2C19.12,3.07 18.95,3 18.78,3M16.37,5.12L9,12.5V15H11.5L18.87,7.62L16.37,5.12Z" />
                </svg>
            </button>
        </div>
        <div class="row">
            <div class="col-12">
            <div class="input-style-1">
                <label>Old Password <span id="message" class="text-success"></span></label>
                <input type="password" placeholder="Old Password" name="old_password" id="old_password" required/>
            </div>
            </div>
            <div class="col-12">
            <div class="input-style-1">
                <label>New Password <span id="new_password_message" class="text-success"></span></label>
                <input type="password" placeholder="New Password" name="new_password" id="new_password" required/>
            </div>
            </div>
            <div class="col-12">
            <div class="input-style-1">
                <label>Confirm Password <span id="confirm_password_message" class="text-success"></span></label>
                <input type="password" placeholder="Confirm Password" name="confirm_password" id="confirm_password" required/>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function (){
            $("#old_password").focusout(function(){
                let old_password = $('#old_password').val();

                if (old_password.length > 0) {
                    $.post(`{{ url('settings/check_password') }}`, {
                        '_token': '{{ csrf_token() }}',
                        '_method': 'post',
                        'old_password': old_password
                    })
                    .done(response => {
                        if (response == 'Invalid Password') {
                            alert(`Old Password Didn't Match!`);
                        } else {
                            $("#message").html("Valid Password");
                        }
                    })
                    .fail(errors => {
                        return;
                    })
                }
            });

            $('#confirm_password').focusout(function(){
                let new_password = $('#new_password').val();
                let confirm_password = $('#confirm_password').val();
                if (new_password != confirm_password) {
                    $("#new_password_message").html("");
                    $("#confirm_password_message").html("");
                    alert(`Password Didn't Match!`);
                } else {
                    $("#new_password_message").html("Valid Password");
                    $("#confirm_password_message").html("Valid Password");
                }

            });
        });

        $(document).on('change', '#phone', function () {
            let phone = parseInt($('#phone').val());
            if (!phone) {
                alert("Phone must be numbers");
                return;
            }
        });

        $(document).on('click', '#btn-password', function () {
            let old_password = $('#old_password').val(); 
            let new_password = $('#new_password').val();
            let confirm_password = $('#confirm_password').val();

            if (old_password.length == 0) {
                alert('Old Password Must Be Filled In!');
            }else if (new_password.length == 0) {
                alert('New Password Must Be Filled In!');
            }else if (confirm_password.length == 0) {
                alert('Confirm Password Must Be Filled In!');
            }

            $.post(`{{ url('settings/password') }}`, {
                '_token': '{{ csrf_token() }}',
                '_method': 'post',
                'old_password': old_password,
                'new_password': new_password,
                'confirm_password': confirm_password,
            })
            .done(response => {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Successfully Changed',
                    showConfirmButton: false,
                    timer: 1500
                });
                window.setTimeout(function(){
                    let timerInterval
                    Swal.fire({
                        title: 'Auto logout alert!',
                        html: 'You automatically logged out in <b></b> milliseconds.',
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading()
                            const b = Swal.getHtmlContainer().querySelector('b')
                            timerInterval = setInterval(() => {
                                b.textContent = Swal.getTimerLeft()
                            }, 100)
                        },
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                        }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                            window.location.assign("{{ url('logout') }}");
                        }
                    })
                }, 2000);
            })
            .fail(errors => {
                return;
            })
        });
    </script>
@endpush