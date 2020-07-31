@extends('layout.master')
@section('title')
Lessons || SME ACADEMY
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
                    @if (date("H") < 12) <h1 style="font-size: 22px;">Good morning <i class="mdi mdi-brightness-6"></i>, Admin</h1>
                        @elseif (date("H") >= 12 && date("H") < 16) <h1 style="font-size: 22px;">Good afternoon <i class="mdi mdi-brightness-7"></i>, Admin</h1>
                            @elseif (date("H") >= 15)
                            <h1 style="font-size: 22px;">Good evening <i class="mdi mdi-brightness-2"></i>, Admin</h1>
                            @endif
                </h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Lesson</li>
                        <button type="button" class="btn btn-info btn-sm m-l-15" data-toggle="modal" data-target="#myModal"><i class="icon-plus"></i> Add New Lesson</button>
                    </ol>

                </div>
            </div>
        </div>
        <!-- sample modal content -->
        <div id="myModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Add New Lesson</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <form action="{{ route('adminsavelesson') }}" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Select Course</label>
                                <select class="form-control" name="course_id" required>
                                    <option selected disabled>Select Course</option>
                                    @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Lesson Title</label>
                                <input type="text" class="form-control" placeholder="Enter lesson title" name="title" value="{{ Request::old('title')}}" required>
                            </div>
                            <div class="form-group">
                                <label>Lesson Abstract</label>
                                <textarea class="form-control" name="abstract" placeholder="enter lesson abstract" required>{{ Request::old('abstract')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Video Lesson</label>
                                <input type="file" class="form-control" name="content" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success waves-effect">Add Lesson</button>
                        </div>
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
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
                        <h4 class="card-title">All Lesson</h4>
                        <div class="table-responsive">
                            <table id="demo-foo-addrow" class="table no-wrap table-bordered m-t-30 table-hover contact-list" data-paging="true" data-paging-size="7">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Course</th>
                                        <th>Lesson Title</th>
                                        <th>Lesson Abstract</th>
                                        <th>Video Lesson</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($lesson as $lesson )
                                    <tr>
                                        <td>{{ $lesson->course->title }}</td>
                                        <td>{{ $lesson->title }}</td>
                                        <td>{{ $lesson->abstract }}</td>
                                        <td>{{ $lesson->content }}</td>
                                        <td><button class="btn btn-info btn-sm"><i class="icon-pencil"></i> Edit</button> <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{ $lesson->id }}"><i class="icon-trash"></i> Delete</button></td>
                                        <!-- sample modal content -->
                                        <div id="delete{{ $lesson->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3><strong>Delete Lesson</strong></h3> <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h4><strong>Confirm Deletion</strong></h4>
                                                        <p>Are you sure you want to Delete ( {{ $lesson->title }} ) </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">No</button>
                                                        <a href="{{ route('deletelesson',$lesson->id) }}" class="btn btn-success waves-effect waves-light">Yes</a>
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