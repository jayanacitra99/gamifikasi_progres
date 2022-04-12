@extends('instruktur/template')
@section('title')
    Gamifikasi - Detail Assignment
@endsection
@section('head-script')
<script>
    $(document).ready(function(){
        $(".grades").click(function() {
            Swal.fire({
                title: 'Grade this Assignment',
                icon: 'question',
                input: 'number',
                inputValidator: (value) => {
                    if ((value > 100)||(value < 0)||(!value)) {
                    return 'Grade from 0-100!'+value
                    }
                },
                inputAttributes:{
                    min: 0,
                    max: 100,
                },
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Grade!',
                focusConfirm: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    var gradeurl = $(this).attr('gradeurl');
                    window.location.replace(gradeurl+'/'+result.value);
                }
            })
        });
    });
</script>
@endsection
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <!-- general form elements -->
        <div class="card">
            <div class="card-header" style="background-color: #a12520; color: white">
                <h3 class="card-title">Detail Assignment</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="courseList" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th>No. </th>
                        <th>Member Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Files</th>
                        <th>Grades</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1 ?>
                    @foreach ($member as $item)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <?php $found = false?>
                            @foreach ($assignmentlog as $data)
                                @if ($data->assignmentID == $assignmentID)
                                    @if ($item->id == $data->memberID)
                                        <?php $found = true?>
                                        <td>{{$data->status}}</td>
                                        <td>
                                            @foreach (unserialize($data->filesubmitted) as $file)
                                                <a href="{{ asset('assignmentlog/'.$file) }}" class="btn btn-sm btn-default" download>{{$file}}</a>
                                            @endforeach
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col">{{$data->grades}}</div>
                                                <div class="col">
                                                    <a class="btn btn-sm btn-primary grades" gradeurl="{{url('gradeAssignment/'.$data->assignmentLogID)}}"><i class="far fa-edit"></i></a>
                                                </div>
                                            </div>                                        
                                        </td>
                                    @endif
                                @endif
                            @endforeach
                            @if (!$found)
                                <td>NOT SUBMITTED</td>
                                <td> - </td>
                                <td> - </td>
                            @endif
                        </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                        <th>No. </th>
                        <th>Member Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Files</th>
                        <th>Grades</th>
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
    
@endsection