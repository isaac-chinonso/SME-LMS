@extends('layout.header')
@section('title')
Login || SME ACADEMY
@endsection

@section('content')

<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<section id="wrapper" class="login-register login-sidebar" style="background-image:url(assets/images/background/login-register.jpg);">
    <div class="login-box card">
        @include('include.success')
        @include('include.warning')
        @include('include.error')
        <div class="card-body"><br><br>
            <form class="form-horizontal form-material" action="{{ route('signin') }}" method="post">
                <div class="text-center">
                    <h4><strong><i class="icon-login"></i> LOGIN FORM</strong></h4>
                </div>
                <div class="form-group m-t-40">
                    <div class="col-xs-12">
                        <label>Email Address</label>
                        <input type="email" class="form-control"  name="email" required placeholder="Enter Email">
                    </div>
                </div><br>
                <div class="form-group">
                    <label>Password</label>
                    <div class="col-xs-12">
                        <input type="password" class="form-control" name="password" requiredplaceholder="Password">
                    </div>
                </div>
                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button class="btn btn-info btn-lg btn-block text-uppercase btn-rounded" type="submit">Sign In</button>
                    </div>
                </div>

                <p class="text-center" style="font-size: 16px;">
                    <span>Crafted with&nbsp;<i class="mdi mdi-heart" style="color:#000;"></i>&nbsp;by&nbsp;<a href="http://wa.me/2349035820637">Dcode Arena</a></span>
                </p>
        </div>
        <input type="hidden" name="_token" value="{{ Session::token() }}">
        </form>
    </div>
    </div>
</section>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
@endsection