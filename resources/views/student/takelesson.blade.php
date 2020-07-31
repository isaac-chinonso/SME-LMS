@extends('layout.master2')
@section('title')
Take Lesson || SME ACADEMY
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
                    @if (date("H") < 12) <h1 style="font-size: 22px;">Good morning <i class="mdi mdi-brightness-6"></i>, {{ Auth::user()->profile->first()->fname }}</h1>
                        @elseif (date("H") >= 12 && date("H") < 16) <h1 style="font-size: 22px;">Good afternoon <i class="mdi mdi-brightness-7"></i>, {{ Auth::user()->profile->first()->fname }}</h1>
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
        <div class="row">
            <div class="col-md-12">
                @include('include.success')
                @include('include.warning')
                @include('include.error')
                <div class="" oncontextmenu="return false" onselectstart="return false" ondragstart="return false">
                    <video controls style="width: 100%;max-height:450px;" controlsList="nodownload" id="video">
                        <source src="../../upload/lesson/{{ $lessons->content }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video><br>
                </div>
                <div class="card">
                    <div class="card-header card-header-large bg-light d-flex align-items-center">
                        <div class="flex">
                            <h4 class="card-header__title">Lesson Outline</h4>
                        </div>
                    </div>
                    <div class="card-body">

                        <h4><strong>Course: {{ $lessons->course->title }}</strong></h4><br>
                        <h4><strong>Lesson Title: {{ $lessons->title }}</strong></h4><br>
                        <h4><strong><u>Abstract</u></strong></h4>
                        <p>{{ $lessons->abstract }}</p>
                    </div>
                </div>
            </div>


        </div>
    </div>

    @endsection