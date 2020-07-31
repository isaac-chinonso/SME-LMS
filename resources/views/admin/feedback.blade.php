@extends('layout.master')
@section('title')
Feedbacks || SME ACADEMY
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
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Feedbacks</h4>
                        <div class="table-responsive">
                            <table id="demo-foo-addrow" class="table no-wrap table-bordered m-t-30 table-hover" data-paging="true" data-paging-size="7">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Fulname</th>
                                        <th>Email</th>
                                        <th>Experience</th>
                                        <th>Suggestions</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ($feedback as $feed)
                                    <tr>
                                        <td>{{ $feed->user->profile->first()->fname }} {{ $feed->user->profile->first()->lname }}</td>
                                        <td>{{ $feed->user->first()->email }}</td>
                                        <td>{{ $feed->experience }}</td>
                                        <td>{{ $feed->suggestions }}</td>
                                        <td><button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{ $feed->id }}"><i class="icon-trash"></i> Delete</button></td>
                                         <!-- sample modal content -->
                                         <div id="delete{{ $feed->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3><strong>Delete Feedback</strong></h3> <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h4><strong>Confirm Deletion</strong></h4>
                                                        <p>Are you sure you want to Delete {{ $feed->user->profile->first()->fname }} feedback </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">No</button>
                                                        <a href="{{ route('deletefeedback',$feed->id) }}" class="btn btn-success waves-effect waves-light">Yes</a>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
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