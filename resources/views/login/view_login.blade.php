@extends('layouts.main')


@section('section')
<div class="row g-0 auth-row">
    <div class="col-lg-6">
    <div class="auth-cover-wrapper bg-primary-100">
        <div class="auth-cover">
        <div class="title text-center">
            <h1 class="text-primary mb-10">Welcome Back</h1>
            <p class="text-medium">
            Sign in to your Existing account to continue
            </p>
        </div>
        <div class="cover-image">
            <img src="{{ asset('/') }}assets/images/auth/signin-image.svg" alt="" />
        </div>
        <div class="shape-image">
            <img src="{{ asset('/') }}assets/images/auth/shape.svg" alt="" />
        </div>
        </div>
    </div>
    </div>
    <!-- end col -->
    <div class="col-lg-6">
    <div class="signin-wrapper">
        <div class="form-wrapper">
        <h6 class="mb-15">Sign In Form</h6>
        <p class="text-sm mb-25">
            Start creating the best possible user experience for you
            customers.
        </p>
        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="row">
            <div class="col-12">
                <div class="input-style-1">
                <label id="username">Username</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" placeholder="Type your username here" id="username" name="username" required value="{{ old('username') }}"/>
                @error('username')
                    <span class="text-danger"> {{ $message }} </span>
                @enderror
                </div>
            </div>
            <!-- end col -->
            <div class="col-12">
                <div class="input-style-1">
                <label id="password">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Type your password here" id="password" name="password" required/>
                </div>
            </div>
            <div class="col-12">
                <div
                class="
                    button-group
                    d-flex
                    justify-content-center
                    flex-wrap
                "
                >
                <button
                    class="
                    main-btn
                    primary-btn
                    btn-hover
                    w-100
                    text-center
                    "
                >
                    Sign In
                </button>
                </div>
            </div>
            </div>
            <!-- end row -->
        </form>
        </div>
    </div>
    </div>
    <!-- end col -->
</div>
@endsection