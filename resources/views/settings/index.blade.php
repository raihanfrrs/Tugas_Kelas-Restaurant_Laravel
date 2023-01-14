@extends('layouts.main')

@section('section')
<div class="card-style">
    <ul class="nav nav-pills nav-justified" role="tablist">
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="pill" href="#home">Profile Settings</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" data-bs-toggle="pill" href="#menu1">Change Password</a>
        </li>
    </ul>
    
    <div class="tab-content">
        <div id="home" class="tab-pane active"><br>
            <form action="settings/{{ auth()->user()->id }}/profile" method="post">
            @csrf
            <div class="row">
                <div class="col-6">
                <div class="input-style-1">
                    <label>Full Name</label>
                    @if (auth()->user()->level == 'administrator')
                        <input type="text" name="name" placeholder="Full Name" class="@error('name') is-invalid @enderror" value="{{ old('name', auth()->user()->admin->name) }}" autocomplete="off" required/>
                    @elseif (auth()->user()->level == 'cashier')
                        <input type="text" name="name" placeholder="Full Name" class="@error('name') is-invalid @enderror" value="{{ old('name', auth()->user()->cashier->name) }}" autocomplete="off" required/>
                    @elseif (auth()->user()->level == 'kitchen')
                        <input type="text" name="name" placeholder="Full Name" class="@error('name') is-invalid @enderror" value="{{ old('name', auth()->user()->kitchen->name) }}" autocomplete="off" required/>
                    @endif
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $msg }}
                        </div>
                    @enderror
                </div>
                </div>
                <div class="col-6">
                <div class="input-style-1">
                    <label>Username</label>
                    <input type="text" name="username" placeholder="Username" class="@error('username') is-invalid @enderror" value="{{ old('username', auth()->user()->username) }}" autocomplete="off" required/>
                </div>
                </div>
                <div class="col-6">
                <div class="input-style-1">
                    <label>Phone</label>
                    @if (auth()->user()->level == 'administrator')
                        <input type="text" name="phone" id="phone" placeholder="Phone" class="@error('phone') is-invalid @enderror" value="{{ old('phone', auth()->user()->admin->phone) }}" autocomplete="off" required/>
                    @elseif (auth()->user()->level == 'cashier')
                        <input type="text" name="phone" id="phone" placeholder="Phone" class="@error('phone') is-invalid @enderror" value="{{ old('phone', auth()->user()->cashier->phone) }}" autocomplete="off" required/>
                    @elseif (auth()->user()->level == 'kitchen')
                        <input type="text" name="phone" id="phone" placeholder="Phone" class="@error('phone') is-invalid @enderror" value="{{ old('phone', auth()->user()->kitchen->phone) }}" autocomplete="off" required/>
                    @endif
                </div>
                </div>
                <div class="col-6">
                <div class="input-style-1">
                    <label>Email</label>
                    @if (auth()->user()->level == 'administrator')
                        <input type="email" name="email" placeholder="Email" class="@error('email') is-invalid @enderror" value="{{ old('email', auth()->user()->admin->email) }}" autocomplete="off" required/>
                    @elseif (auth()->user()->level == 'cashier')
                        <input type="email" name="email" placeholder="Email" class="@error('email') is-invalid @enderror" value="{{ old('email', auth()->user()->cashier->email) }}" autocomplete="off" required/>
                    @elseif (auth()->user()->level == 'kitchen')
                        <input type="email" name="email" placeholder="Email" class="@error('email') is-invalid @enderror" value="{{ old('email', auth()->user()->kitchen->email) }}" autocomplete="off" required/>
                    @endif
                </div>
                </div>
                <div class="col-12">
                <button class="main-btn primary-btn btn-hover">
                    Update Profile
                </button>
                </div>
            </div>
            </form>
        </div>
        <div id="menu1" class="tab-pane fade"><br>
          <h3>CHANGE PASSWORD</h3>
          <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        </div>
    </div>
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