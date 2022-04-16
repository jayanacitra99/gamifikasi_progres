@extends('instruktur/template')
@section('title')
    Gamifikasi - Detail Course
@endsection
@section('head-script')
<script>
    $(document).ready(function(){
      $(".buttonDelete").click(function() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            var delurl = $(this).attr('delurl');
            window.location.replace(delurl);
          }
        })
      });
    });
  </script>
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
                            <th>Exp / Point</th>
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
                                    @if ($item->files != NULL)
                                        @foreach (unserialize($item->files) as $file)
                                            <a href="{{ asset('assignments/'.$file) }}" class="btn btn-sm btn-default" download>{{$file}}</a>
                                        @endforeach
                                    @else
                                        - NO FILES SUBMITTED -
                                    @endif

                                    @if ($item->link != NULL)
                                       <br> Link : <a href="{{$item->link}}"><i class="fas fa-paperclip"></i> {{$item->link}}</a>
                                    @endif
                                </th>
                                <th>{{$item->a_exp.' / '.$item->a_point}}</th>
                                <th>
                                    <a href="{{url('detailAssignment/'.$item->courseID.'/'.$item->assignmentID)}}" class="btn btn-block btn-success"><i class="fas fa-user-check"></i> Check</a>
                                    <a href="{{url('editAssignment/'.$item->assignmentID)}}" class="btn btn-block btn-warning"><i class="far fa-edit"></i> Edit </a>
                                    <a delurl="{{url('deleteAssignment/'.$item->assignmentID)}}" class="btn btn-block btn-danger buttonDelete">Delete</a>
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
                            <th>Exp / Point</th>
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
                            <th>Exp / Point</th>
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
                                    @if ($item->files != NULL)
                                        @foreach (unserialize($item->files) as $file)
                                            <a href="{{ asset('assignments/'.$file) }}" class="btn btn-sm btn-default" download>{{$file}}</a>
                                        @endforeach
                                    @else
                                        - NO FILES SUBMITTED -
                                    @endif

                                    @if ($item->link != NULL)
                                       <br> Link : <a href="{{$item->link}}"><i class="fas fa-paperclip"></i> {{$item->link}}</a>
                                    @endif
                                </th>
                                <th>{{$item->a_exp.' / '.$item->a_point}}</th>
                                <th>
                                    <a href="{{url('detailAssignment/'.$item->courseID.'/'.$item->assignmentID)}}" class="btn btn-block btn-success"><i class="fas fa-user-check"></i> Check</a>
                                    <a href="{{url('editAssignment/'.$item->assignmentID)}}" class="btn btn-block btn-warning"><i class="far fa-edit"></i> Edit </a>
                                    <a delurl="{{url('deleteAssignment/'.$item->assignmentID)}}" class="btn btn-block btn-danger buttonDelete">Delete</a>
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
                            <th>Exp / Point</th>
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
                            <th></th>
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
                                    @if ($item->files != NULL)
                                        @foreach (unserialize($item->files) as $file)
                                            <a href="{{ asset('assignments/'.$file) }}" class="btn btn-sm btn-default" download>{{$file}}</a>
                                        @endforeach
                                    @else
                                        - NO FILES SUBMITTED -
                                    @endif

                                    @if ($item->link != NULL)
                                       <br> Link : <a href="{{$item->link}}"><i class="fas fa-paperclip"></i> {{$item->link}}</a>
                                    @endif
                                </th>
                                <th>
                                    <a href="{{url('editAssignment/'.$item->assignmentID)}}" class="btn btn-block btn-warning"><i class="far fa-edit"></i> Edit </a>
                                    <a delurl="{{url('deleteAssignment/'.$item->assignmentID)}}" class="btn btn-block btn-danger buttonDelete">Delete</a>
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
                            <th></th>
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