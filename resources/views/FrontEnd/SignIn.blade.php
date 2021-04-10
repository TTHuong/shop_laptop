@extends('Layout')
@section('title')    
{{ trans('home.signin') }}
@endsection
@section('content-layout')

<!-- Breadcrumb Start -->
<div class="breadcrumb-area mt-30">
    <div class="container">
        <div class="breadcrumb">
            <ul class="d-flex align-items-center">
                <li><a href="{{route('trang-chu')}}">Home</a></li>
                <li><a href="{{route('dangnhap')}}">account</a></li>
                <li class="active"><a href="{{route('dangnhap')}}">Sign In</a></li>
            </ul>
        </div>
    </div>
    <!-- Container End -->
</div>
<!-- Breadcrumb End -->
<!-- LogIn Page Start -->
<div class="log-in ptb-100 ptb-sm-60">
    <div class="container">
        <div class="row">
            <!-- New Customer Start -->
            <div class="col-md-6">
                <div class="well mb-sm-30">
                    <div class="new-customer">
                        <h3 class="custom-title">new customer</h3>
                        <p class="mtb-10"><strong>Register</strong></p>
                        <p>By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made</p>
                        <a class="customer-btn" href="{{route('dangky')}}">continue</a>
                    </div>
                </div>
            </div>
            <!-- New Customer End -->
            <!-- Returning Customer Start -->
            <div class="col-md-6">
                <div class="well">
                    <div class="return-customer">
                        <h3 class="mb-10 custom-title">returnng customer</h3>
                        <p class="mb-10"><strong>I am a returning customer</strong></p>
                        <form id="loginForm" method="POST" action="{{route('dangnhap')}}" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" placeholder="Enter your email address..." id="input-email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" placeholder="Password" id="input-password" class="form-control">
                            </div>
                            <p class="lost-password"><a href="{{url('/quen-mat-khau')}}">{{ trans('home.forgot') }}?</a></p>
                            <input type="submit" value="Login" class="return-customer-btn">
                        </form>
                    </div>
                </div>
            </div>
            <!-- Returning Customer End -->
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</div>
<!-- LogIn Page End -->
@endsection