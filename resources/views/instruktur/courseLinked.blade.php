@extends('instruktur/template')
@section('title')
    Gamifikasi - Course Linked
@endsection
@section('head-script')
  <script>
    $(document).ready(function(){
      $(".buttonComplete").click(function() {
        Swal.fire({
            title: 'Are you sure?',
            text: "Complete the course for this student?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Complete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            var complete = $(this).attr('complete');
            window.location.replace(complete);
          }
        })
      });

      $(".buttonApprove").click(function() {
        Swal.fire({
            title: 'Are you sure?',
            text: "Approve the course for this student?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Approve it!'
        }).then((result) => {
          if (result.isConfirmed) {
            var approve = $(this).attr('approve');
            window.location.replace(approve);
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
                <h3 class="card-title">Course List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="courseList" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th>No. </th>
                        <th>Course ID</th>
                        <th>Course Name</th>
                        <th>Instructure</th>
                        <th>Course Members</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1 ?>
                    @foreach ($course as $item)
                      <tr>
                        <td>{{$no++}}</td>
                        <td>{{$item->courseID}}</td>
                        <td>{{$item->courseName}}</td>
                        <td>{{$item->name}}</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="{{'#modalmember'.$item->courseID}}">
                                Member Details
                            </button>
                            <div class="modal fade" id="{{'modalmember'.$item->courseID}}">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="modal-title">Member Course {{$item->courseName}}</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                      <table id="memberlist" class="table table-bordered table-striped">
                                          <thead>
                                            <tr>
                                                <th>No. </th>
                                                <th>Member Name</th>
                                                <th>Member Email</th>
                                                <th>Status</th>
                                                <th></th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <?php $noo = 1 ?>
                                            @foreach ($member as $data)
                                              @if ($data->courseID == $item->courseID)
                                                <tr>
                                                  <td>{{$noo++}}</td>
                                                  <td>{{$data->name}}</td>
                                                  <td>{{$data->email}}</td>
                                                  <td>{{$data->status}}</td>
                                                  <td>
                                                    @if ($data->status == 'ONGOING')
                                                      <a complete="{{url('completeMember/'.$data->courseMemberID)}}" class="btn btn-success buttonComplete">Complete</a>
                                                    @elseif($data->status == 'WAITING')
                                                      <a approve="{{url('approveMember/'.$data->courseMemberID)}}" class="btn btn-warning buttonApprove">Approve</a>
                                                    @endif
                                                  </td>
                                                </tr>  
                                              @endif
                                            @endforeach
                                          </tbody>
                                          <tfoot>
                                              <tr>
                                                  <th>No. </th>
                                                  <th>Member Name</th>
                                                  <th>Member Email</th>
                                                  <th>Status</th>
                                                  <th></th>
                                              </tr>
                                          </tfoot>
                                      </table>
                                  </div>
                                  <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  </div>
                                </div>
                                <!-- /.modal-content -->
                              </div>
                              <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->  
                        </td>
                        <td>
                          <a href="{{url('detailCourse/'.$item->courseID)}}" class="btn btn-success"><i class="fas fa-search"></i> Detail</a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                        <th>No. </th>
                        <th>Course ID</th>
                        <th>Course Name</th>
                        <th>Instructure</th>
                        <th>Course Members</th>
                        <th>Action</th>
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