@extends('layout.master1')
@section('title')
Courses || SME ACADEMY
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
                        <li class="breadcrumb-item active">Class</li>
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
                        <h4 class="card-title">All Courses</h4>
                        <div class="table-responsive">
                            <table class="table  table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Course Title</th>
                                        <th>Course Focus</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($courses as $course)
                                    <tr>
                                        <td>{{ $course->title }}</td>
                                        <td>{{ $course->focus }}</td>
                                        <td><span class="alert alert-success alert-rounded"> Active</span></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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