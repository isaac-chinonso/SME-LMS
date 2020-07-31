@extends('layout.master1')
@section('title')
Feedback || SME ACADEMY
@endsection

@section('content')

<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">
                    @if (date("H") < 12) 
                        <h1 style="font-size: 22px;">Good morning <i class="mdi mdi-brightness-6"></i>, {{ Auth::user()->profile->first()->fname }}</h1>
                    @elseif (date("H") >= 12 && date("H") < 16) 
                        <h1 style="font-size: 22px;">Good afternoon <i class="mdi mdi-brightness-7"></i>, {{ Auth::user()->profile->first()->fname }}</h1>
                    @elseif (date("H") >= 15)
                        <h1 style="font-size: 22px;">Good evening <i class="mdi mdi-brightness-2"></i>, {{ Auth::user()->profile->first()->fname }}</h1>
                    @endif
                </h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Feedback</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <!-- column -->
            <div class="col-lg-12">
                @include('include.success')
                @include('include.warning')
                @include('include.error')
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Write a Feedback</h4><hr>
                        <form action="{{ route('traineesavefeedback') }}" method="post">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" disabled value="{{ Auth::user()->profile->first()->fname }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" disabled value="{{ Auth::user()->profile->first()->lname }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Experience</label>
                                <textarea class="form-control" name="experience">{{ Request::old('experience')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Comments/Suggestions</label>
                                <textarea class="form-control" name="suggestions">{{ Request::old('suggestions')}}</textarea>
                            </div>
                            <div class="form-group" style="text-align: center;">
                                <button type="reset" class="btn btn-danger">Reset Form</button>
                                <button type="submit" class="btn btn-success">Submit Feedback</button>
                            </div>
                            <input type="hidden" name="_token" value="{{ Session::token() }}">
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->

    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->

@endsection