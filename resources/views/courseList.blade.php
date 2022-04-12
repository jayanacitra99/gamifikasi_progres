@extends('template')
@section('title')
    Gamifikasi - Course List
@endsection
@section('head-script')
    <script>
        $(document).ready(function(){
        $(".enroll").click(function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Enroll this course!'
            }).then((result) => {
            if (result.isConfirmed) {
                var url = $(this).attr('url');
                window.location.replace(url);
            }
            })
        });
        });
    </script>
@endsection
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <?php $row=0?>
        @foreach ($course as $item)
            @if ($row == 0)
            <div class="row">
            @endif
            <?php $exist=false?>
            @foreach ($coursemember as $check)
                @if (($check->courseID == $item->courseID) && ($check->memberID == auth()->user()->id) && ($check->status == 'ONGOING'))
                    <?php $exist = true?>
                @endif
            @endforeach
            @if ($exist)
            <div class="col-md-4">
                <!-- Widget: user widget style 1 -->
                <div class="card card-widget widget-user shadow">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-info">
                        <h3 class="widget-user-username">{{$item->courseName}}</h3>
                        <h5 class="widget-user-desc">{{$item->name}}</h5>
                    </div>  
                    <div class="widget-user-image">
                        <img class="img-circle elevation-2" src="{{asset('')}}adminlte/dist/img/online-class.png" alt="User Avatar">
                    </div>
                    <div class="card-footer">
                        <div class="row">
                        <div class="col-sm-3 border-right">
                            <div class="description-block">
                                <?php $totalmember=0?>
                                @foreach ($coursemember as $data)
                                    @if ($data->courseID == $item->courseID)
                                        <?php $totalmember++ ?>
                                    @endif
                                @endforeach
                            <h5 class="description-header">{{$totalmember}}</h5>
                            <span class="description-text">Total Member</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3 border-right">
                            <div class="description-block">
                                <?php $currentmember=0?>
                                @foreach ($coursemember as $data)
                                    @if ($data->courseID == $item->courseID)
                                        @if ($data->status == 'ONGOING')
                                            <?php $currentmember++ ?>
                                        @endif
                                    @endif
                                @endforeach
                            <h5 class="description-header">{{$currentmember}}</h5>
                            <span class="description-text">Current Member</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3 border-right">
                            <div class="description-block">
                                <h5 class="description-header">{{$item->day}}</h5>
                            <span class="description-text">{{ date('H:i', strtotime($item->start_time)).' - '.date('H:i', strtotime($item->end_time))}}</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3">
                            <div class="description-block">
                                <a href="{{url('courseDetail/'.$item->courseID.'/'.auth()->user()->id)}}" class="btn btn-success"><i class="far fa-folder-open"></i> Open</a>
                                <?php
                                    date_default_timezone_set('Asia/Jakarta');
                                    $day = date('l');
                                    $time = date('H:i');
                                    $checkedin = false;
                                    $today = date('Y-m-d');
                                ?>
                                @foreach ($attend as $update)
                                    @if (date('Y-m-d', strtotime($update->timestamp)) == $today)
                                        <?php $checkedin = true;?>
                                    @endif
                                @endforeach
                                @if (($item->day == $day) && (strtotime($time) >= strtotime($item->start_time)) && (!$checkedin))
                                    <a href="{{url('attendCourse/'.$item->courseID.'/'.auth()->user()->id).'/'.strtotime($time) > strtotime($item->end_time)}}" class="btn btn-info mt-1">Check-In</a>
                                @else
                                    <button type="button" class="btn btn-info mt-1" disabled>Check-In</button>
                                @endif
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                </div>
                <!-- /.widget-user -->
            </div>
            <!-- /.col -->
            @endif
            <?php $row++ ?> 
            @if ($row == 3)
                <?php $row = 0?>
            </div>
            @endif
        @endforeach
    </div><!-- /.container-fluid -->
</div>
@endsection