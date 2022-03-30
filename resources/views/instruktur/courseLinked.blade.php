@extends('instruktur/template')
@section('title')
    Gamifikasi - Course Linked
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
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">
                                Member Details
                            </button>
                            @section('modal-title')
                                Member Course {{$item->courseName}}
                            @endsection
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
              <div class="modal fade" id="modal-lg">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">@yield('modal-title')</h4>
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
                              </tr>
                            </thead>
                            <tbody>
                              <?php $no = 1 ?>
                              @foreach ($member as $data)
                                @if ($data->courseID == $item->courseID)
                                    <td>{{$no++}}</td>
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->email}}</td>
                                    <td>{{$data->status}}</td>
                                @endif
                              @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No. </th>
                                    <th>Member Name</th>
                                    <th>Member Email</th>
                                    <th>Status</th>
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
        </div>
        <!-- /.card -->
    </div><!-- /.container-fluid -->
</div>
@endsection