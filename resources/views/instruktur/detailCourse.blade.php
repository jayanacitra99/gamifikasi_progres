@extends('instruktur/template')
@section('title')
    Gamifikasi - Detail Course
@endsection
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{$course->courseID}} - {{$course->courseName}}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('courseLinked')}}">Course</a></li>
                <li class="breadcrumb-item active">Detail Course</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        <!-- general form elements -->
        <div class="card">
            <div class="card-header" style="background-color: #a12520; color: white">
                <div class="row">
                    <div class="col"><h3 class="card-title">Assignments</h3></div>
                    <div class="col"><a href="{{url('addAssignment/'.$course->courseID)}}" class="btn-sm btn-default" style="float: right"><i class="fas fa-plus"></i> Add</a></div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="assignments" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No. </th>
                            <th>Course</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Files</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1?>
                        @foreach ($assignment as $item)
                            @if ($item->types == 'TUGAS')
                            <tr>
                                <th>{{$no++}}</th>
                                <th>{{$item->courseName}}</th>
                                <th>{{$item->start_date}}</th>
                                <th>{{$item->end_date}}</th>
                                <th>
                                    @foreach (unserialize($item->files) as $file)
                                        <a href="{{ asset('assignments/'.$file) }}" class="btn btn-sm btn-default" download>{{$file}}</a>
                                    @endforeach
                                </th>
                                <th>
                                    <a href="{{url('detailAssignment/'.$item->courseID.'/'.$item->assignmentID)}}" class="btn btn-success">Detail Assignment</a>
                                </th>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No. </th>
                            <th>Course</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Files</th>
                            <th>Detail</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->      
        </div>
        <!-- /.card -->
        <div class="card">
            <div class="card-header" style="background-color: #a12520; color: white">
                <div class="row">
                    <div class="col"><h3 class="card-title">Quizzes</h3></div>
                    <div class="col"><a href="{{url('addAssignment/'.$course->courseID)}}" class="btn-sm btn-default" style="float: right"><i class="fas fa-plus"></i> Add</a></div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="quizzes" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No. </th>
                            <th>Course</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Files</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1?>
                        @foreach ($assignment as $item)
                            @if ($item->types == 'KUIS')
                            <tr>
                                <th>{{$no++}}</th>
                                <th>{{$item->courseName}}</th>
                                <th>{{$item->start_date}}</th>
                                <th>{{$item->end_date}}</th>
                                <th>
                                    @foreach (unserialize($item->files) as $file)
                                        <a href="{{ asset('assignments/'.$file) }}" class="btn btn-sm btn-default" download>{{$file}}</a>
                                    @endforeach
                                </th>
                                <th>
                                    <a href="" class="btn btn-success">Detail Assignment</a>
                                </th>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No. </th>
                            <th>Course</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Files</th>
                            <th>Detail</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->      
        </div>
        <!-- /.card -->
        <div class="card">
            <div class="card-header" style="background-color: #a12520; color: white">
                <div class="row">
                    <div class="col"><h3 class="card-title">Resources</h3></div>
                    <div class="col"><a href="{{url('addAssignment/'.$course->courseID)}}" class="btn-sm btn-default" style="float: right"><i class="fas fa-plus"></i> Add</a></div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="resources" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No. </th>
                            <th>Course</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Files</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1?>
                        @foreach ($assignment as $item)
                            @if ($item->types == 'MATERI')
                            <tr>
                                <th>{{$no++}}</th>
                                <th>{{$item->courseName}}</th>
                                <th>{{$item->start_date}}</th>
                                <th>{{$item->end_date}}</th>
                                <th>
                                    @foreach (unserialize($item->files) as $file)
                                        <a href="{{ asset('assignments/'.$file) }}" class="btn btn-sm btn-default" download>{{$file}}</a>
                                    @endforeach
                                </th>
                                <th>
                                    <a href="" class="btn btn-success">Detail Assignment</a>
                                </th>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No. </th>
                            <th>Course</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Files</th>
                            <th>Detail</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->      
        </div>
        <!-- /.card -->
    </div><!-- /.container-fluid -->
</div>
@endsection
@section('script')
<script>
    $(function () {
        $("#assignments").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#assignments_wrapper .col-md-6:eq(0)');
    });
    $(function () {
        $("#quizzes").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#quizzes_wrapper .col-md-6:eq(0)');
    });
    $(function () {
        $("#resources").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#resources_wrapper .col-md-6:eq(0)');
    });
</script>
@endsection