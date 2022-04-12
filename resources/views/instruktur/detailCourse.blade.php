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
        <div class="card ">
            <div class="card-header" style="background-color: #a12520; color: white">
                <div class="row">
                    <div class="col"><h3 class="card-title">Assignments</h3></div>
                    <div class="col"><a href="{{url('addAssignment/'.$course->courseID)}}" class="btn-sm btn-default" style="float: right"><i class="fas fa-plus"></i> Add</a></div>
                    <div class="card-tools">
                        <button type="button" class="btn-sm btn-default" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="assignments" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No. </th>
                            <th>Course</th>
                            <th>Subject</th>
                            <th>Due Date</th>
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
                                <th>{{$item->title.' - '.$item->description}}</th>
                                <th>{{date("l d/M/y", strtotime($item->start_date)).' - '.date("l d/M/y", strtotime($item->end_date))}}</th>
                                <th>
                                    @foreach (unserialize($item->files) as $file)
                                        <a href="{{ asset('assignments/'.$file) }}" class="btn btn-sm btn-default" download>{{$file}}</a>
                                    @endforeach

                                    @if ($item->link != NULL)
                                       <br> Link : <a href="{{$item->link}}"><i class="fas fa-paperclip"></i> {{$item->link}}</a>
                                    @endif
                                </th>
                                <th>
                                    <a href="{{url('detailAssignment/'.$item->courseID.'/'.$item->assignmentID)}}" class="btn btn-success"><i class="fas fa-user-check"></i> Check</a>
                                </th>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No. </th>
                            <th>Course</th>
                            <th>Subject</th>
                            <th>Due Date</th>
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
                    <div class="card-tools">
                        <button type="button" class="btn-sm btn-default" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="quizzes" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No. </th>
                            <th>Course</th>
                            <th>Subject</th>
                            <th>Due Date</th>
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
                                <th>{{$item->title.' - '.$item->description}}</th>
                                <th>{{date("l d/M/y", strtotime($item->start_date)).' - '.date("l d/M/y", strtotime($item->end_date))}}</th>
                                <th>
                                    @foreach (unserialize($item->files) as $file)
                                        <a href="{{ asset('assignments/'.$file) }}" class="btn btn-sm btn-default" download>{{$file}}</a>
                                    @endforeach

                                    @if ($item->link != NULL)
                                       <br> Link : <a href="{{$item->link}}"><i class="fas fa-paperclip"></i> {{$item->link}}</a>
                                    @endif
                                </th>
                                <th>
                                    <a href="{{url('detailAssignment/'.$item->courseID.'/'.$item->assignmentID)}}" class="btn btn-success"><i class="fas fa-user-check"></i> Check</a>
                                </th>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No. </th>
                            <th>Course</th>
                            <th>Subject</th>
                            <th>Due Date</th>
                            <th>Files</th>
                            <th>Detail</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->      
        </div>
        <!-- /.card -->
        <div class="card ">
            <div class="card-header" style="background-color: #a12520; color: white">
                <div class="row">
                    <div class="col"><h3 class="card-title">Resources</h3></div>
                    <div class="col"><a href="{{url('addAssignment/'.$course->courseID)}}" class="btn-sm btn-default" style="float: right"><i class="fas fa-plus"></i> Add</a></div>
                    <div class="card-tools">
                        <button type="button" class="btn-sm btn-default" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="resources" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No. </th>
                            <th>Course</th>
                            <th>Subject</th>
                            <th>Due Date</th>
                            <th>Files</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1?>
                        @foreach ($assignment as $item)
                            @if ($item->types == 'MATERI')
                            <tr>
                                <th>{{$no++}}</th>
                                <th>{{$item->courseName}}</th>
                                <th>{{$item->title.' - '.$item->description}}</th>
                                <th>{{date("l d/M/y", strtotime($item->start_date)).' - '.date("l d/M/y", strtotime($item->end_date))}}</th>
                                <th>
                                    @foreach (unserialize($item->files) as $file)
                                        <a href="{{ asset('assignments/'.$file) }}" class="btn btn-sm btn-default" download>{{$file}}</a>
                                    @endforeach

                                    @if ($item->link != NULL)
                                       <br> Link : <a href="{{$item->link}}"><i class="fas fa-paperclip"></i> {{$item->link}}</a>
                                    @endif
                                </th>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No. </th>
                            <th>Course</th>
                            <th>Subject</th>
                            <th>Due Date</th>
                            <th>Files</th>
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

        $("#quizzes").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#quizzes_wrapper .col-md-6:eq(0)');

        $("#resources").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#resources_wrapper .col-md-6:eq(0)');
    });
</script>
@endsection