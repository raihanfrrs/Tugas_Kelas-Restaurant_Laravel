@extends('layouts.main')

@section('section')
<!-- ========== form-elements-wrapper start ========== -->
<div class="form-elements-wrapper">
    <form action="/cashier/{{ $cashier->id }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="row">
    <div class="col-lg-6">
        <!-- input style start -->
        <div class="card-style mb-30">
        <h6 class="mb-25">Cashier Form</h6>
        <div class="input-style-1">
            <label for="cashier">Cashier Name</label>
            <input type="text" class="@error('name') is-invalid @enderror text-capitalize" placeholder="Cashier Name" name="name" id="cashier" value="{{ old('name', $cashier->name) }}" required/>
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="input-style-1">
            <label for="phone">Phone</label>
            <input type="text" class="@error('phone') is-invalid @enderror" placeholder="Type Phone" name="phone" id="phone" value="{{ old('phone', $cashier->phone) }}" required/>
            @error('phone')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="input-style-1">
            <label for="email">Email</label>
            <input type="email" class="@error('email') is-invalid @enderror" placeholder="Type Email" name="email" id="email" value="{{ old('email', $cashier->email) }}" required/>
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="input-style-1">
            <label for="username">Username</label>
            <input type="text" class="@error('username') is-invalid @enderror" placeholder="Type Username" name="username" id="username" value="{{ old('username', $cashier->user->username) }}" required/>
            @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="input-style-1">
            <label for="password">Password <sup class="text-danger">*if you want to change the password then fill the field</sup></label>
            <input type="password" class="@error('password') is-invalid @enderror" placeholder="Type Password" name="password" id="password"/>
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <h6 class="mb-25">Status</h6>
        <div class="form-check radio-style mb-20">
            <input class="form-check-input" type="radio" name="status" id="active" @if(old('status', $cashier->user->status) == 'active') checked @endif value="active">
            <label class="form-check-label" for="active">
              Active
            </label>
        </div>
        <div class="form-check radio-style mb-20">
            <input class="form-check-input" type="radio" name="status" id="non-active" @if(old('status', $cashier->user->status) == 'non-active') checked @endif value="non-active">
            <label class="form-check-label" for="non-active">
              Non-Active
            </label>
        </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card-style mb-30">
        <h6 class="mb-25">Picture</h6>
        <div class="input-style-1">
            <label for="image">Cashier Picture</label>
            @if ($cashier->image)
                <img src="{{ asset('storage/'.$cashier->image) }}" class="img-preview img-fluid d-block mb-3" alt="Cashier Image">
            @else
                <img class="img-preview img-fluid d-block mb-3">
            @endif
            <input type="file" class="@error('image') is-invalid @enderror" placeholder="Cashier Picture" name="image" id="image" onchange="previewImage()"/>
            @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button class="btn btn-primary" type="submit">
            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                <path fill="currentColor" d="M17 3H5C3.89 3 3 3.9 3 5V19C3 20.11 3.9 21 5 21H12.81C12.45 20.38 12.2 19.7 12.08 19L12 19C10.34 19 9 17.66 9 16S10.34 13 12 13C12.68 13 13.34 13.23 13.87 13.65C15 12.59 16.46 12 18 12C19.05 12 20.09 12.28 21 12.81V7L17 3M15 9H5V5H15V9M17 14V17H14V19H17V22H19V19H22V17H19V14H17Z" />
            </svg>
             Save
        </button>
        </div>
    </div>
    </div>
    </form>
</div>
@endsection