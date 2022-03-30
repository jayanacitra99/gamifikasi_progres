@extends('instruktur/template')
@section('title')
    Gamifikasi - Detail Assignment
@endsection
@section('head-script')
<script>
    $(document).ready(function(){
        $(".grades").click(function() {
            const { value: grade } = await Swal.fire({
                title: 'Input Grades',
                input: 'number',
                inputPlaceholder: 'Enter grades',
                inputAttributes: {
                    min : 0,
                    max : 100
                }
            })
            if (grade) {
                var gradeurl = $(this).attr('gradeurl');
                window.location.replace(gradeurl+'/'+${grade})
            }
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
                        <th>{{$no++}}</th>
                        <th>{{$item->name}}</th>
                        <th>{{$item->email}}</th>
                        <?php $found = false?>
                        @foreach ($assignmentlog as $data)
                            @if ($data->assignmentID == $assignmentID)
                                <?php $found = true?>
                                @if ($item->id == $data->memberID)
                                    <th>{{$data->status}}</th>
                                    <th>
                                        @foreach (unserialize($data->filesubmitted) as $file)
                                            <a href="{{ asset('assignmentlog/'.$file) }}" class="btn btn-sm btn-default" download>{{$file}}</a>
                                        @endforeach
                                    </th>
                                    <th>
                                        <div class="row">
                                            <div class="col">{{$data->grades}}</div>
                                            <div class="col">
                                                <a class="btn btn-sm btn-primary grades" gradeurl="{{url('gradeAssignment/'.$data->assignmentLogID)}}"><i class="far fa-edit"></i></a>
                                            </div>
                                        </div>                                        
                                    </th>
                                @endif
                            @endif
                        @endforeach
                        @if (!$found)
                            <th>NOT SUBMITTED</th>
                            <th> - </th>
                            <th> - </th>
                        @endif
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