@extends('Layout')
@section('title')    
{{ trans('home.signup') }}
@endsection
@section('content-layout')

<!-- Breadcrumb Start -->
<div class="breadcrumb-area mt-30">
    <div class="container">
        <div class="breadcrumb">
            <ul class="d-flex align-items-center">
                <li><a href="{{route('trang-chu')}}">Home</a></li>
                <li><a href="{{route('dangnhap')}}">account</a></li>
                <li class="active"><a href="{{route('dangky')}}">Sign Out</a></li>
            </ul>
        </div>
    </div>
    <!-- Container End -->
</div>
<!-- Breadcrumb End -->
<!-- Register Account Start -->
<div class="register-account ptb-100 ptb-sm-60">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="register-title">
                    <h3 class="mb-10">REGISTER ACCOUNT</h3>
                    <p class="mb-10">If you already have an account with us, please login at the login page.</p>
                </div>
            </div>
        </div>
        <!-- Row End -->
        <div class="row">
            <div class="col-sm-12">
                <form class="form-register" method="POST" action="{{route('dangky')}}" novalidate="novalidate">
                    @csrf
                    <fieldset>
                        <legend>Your Personal Details</legend>
                        <div class="form-group d-md-flex align-items-md-center">
                            <label class="control-label col-md-2" for="f-name"><span class="require">*</span>Full Name</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" id="fullname" name="fullname" placeholder="First Name">
                            </div>
                        </div>
                        <div class="form-group d-md-flex align-items-md-center">
                            <label class="control-label col-md-2" for="email"><span class="require">*</span>Email</label>
                            <div class="col-md-10">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter you email address here...">
                            </div>
                        </div>
                        <div class="form-group d-md-flex align-items-md-center">
                            <label class="control-label col-md-2" for="number"><span class="require">*</span>Telephone</label>
                            <div class="col-md-10">
                                <input type="email" class="form-control" id="phone" name="phone" placeholder="Telephone">
                            </div>
                        </div>
                        <div class="form-group d-md-flex align-items-md-center">
                            <label class="control-label col-md-2" for="number"><span class="require">*</span>Địa Chỉ</label>
                            <div class="col-md-10">
                                <textarea class="form-control" placeholder="Địa chỉ" id="adress" name="adress"></textarea>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>Your Password</legend>
                        <div class="form-group d-md-flex align-items-md-center">
                            <label class="control-label col-md-2" for="pwd"><span class="require">*</span>Password:</label>
                            <div class="col-md-10">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group d-md-flex align-items-md-center">
                            <label class="control-label col-md-2" for="pwd-confirm"><span class="require">*</span>Confirm Password</label>
                            <div class="col-md-10">
                                <input type="password" class="form-control" id="re_password" name="re_password" placeholder="Confirm password">
                            </div>
                        </div>
                    </fieldset>
                   
                    <div class="terms">
                        <div class="float-md-right">
                            <input type="submit" value="Continue" class="return-customer-btn">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</div>
<!-- Register Account End -->
@endsection