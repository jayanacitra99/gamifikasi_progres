@extends('template')
@section('title')
    Gamifikasi - Course Detail
@endsection
@section('head-script')
    <!-- dropzonejs -->
    <link rel="stylesheet" href="{{ asset('') }}adminlte/plugins/dropzone/min/dropzone.min.css">
@endsection
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header" style="background-color: #a12520; color: white">
                <h3 class="card-title">Course List</h3>
            </div>    
            <div class="card-body">
                <div class="row">
                  <div class="col-5 col-sm-3">
                    <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                      <a class="nav-link active" id="vert-tabs-assignment-tab" data-toggle="pill" href="#vert-tabs-assignment" role="tab" aria-controls="vert-tabs-assignment" aria-selected="true">Assignment</a>
                      <a class="nav-link" id="vert-tabs-module-tab" data-toggle="pill" href="#vert-tabs-module" role="tab" aria-controls="vert-tabs-module" aria-selected="false">Module</a>
                      <a class="nav-link" id="vert-tabs-quiz-tab" data-toggle="pill" href="#vert-tabs-quiz" role="tab" aria-controls="vert-tabs-quiz" aria-selected="false">Quiz</a>
                      <a class="nav-link" id="vert-tabs-submitted-tab" data-toggle="pill" href="#vert-tabs-submitted" role="tab" aria-controls="vert-tabs-submitted" aria-selected="false">Submitted</a>
                    </div>
                  </div>
                  <div class="col-7 col-sm-9">
                    <div class="tab-content" id="vert-tabs-tabContent">
                      <div class="tab-pane text-left fade show active" id="vert-tabs-assignment" role="tabpanel" aria-labelledby="vert-tabs-assignment-tab">
                        <table class="table table-sm">
                            <thead>
                              <tr>
                                <th style="width: 5%">#</th>
                                <th style="width: 55%">Title</th>
                                <th style="width: 15%">Start Date</th>
                                <th style="width: 15%"  >End Date</th>
                                <th style="width: 10%">Detail</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php $no=1?>
                                @foreach ($assignment as $item)
                                    <?php $exist=false?>
                                    @foreach ($asslog as $data)
                                        @if ($item->assignmentID == $data->assignmentID)
                                            @if ($data->memberID == $memberID)
                                                <?php $exist=true?>
                                            @endif
                                        @endif
                                    @endforeach 
                                    @if ((!$exist) && ($item->types == 'TUGAS'))
                                        <tr>
                                            <td>{{$no++}}</td>
                                            <td>{{$item->title}}</td>
                                            <td>{{$item->start_date}}</td>
                                            <td>{{$item->end_date}}</td>
                                            <td>
                                                <?php 
                                                    date_default_timezone_set('Asia/Jakarta');
                                                    $today = date('Y-m-d');
                                                ?>
                                                @if ($today < $item->start_date)
                                                    <a href="#" class="btn btn-sm btn-danger"><i class="far fa-folder"></i> Soon</a>    
                                                @else
                                                    <a href="" class="btn btn-sm btn-warning" data-toggle="modal" data-target="{{'#modal-assignment'.$item->assignmentID}}"><i class="far fa-folder-open"></i> Open</a>
                                                @endif
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="{{'modal-assignment'.$item->assignmentID}}">
                                            <div class="modal-dialog modal-lg">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h4 class="modal-title">
                                                    {{$item->title}}
                                                  </h4>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                                    <div class="modal-body">
                                                        <div>
                                                            <p>{{$item->description}}</p>
                                                        </div>
                                                        <div>
                                                            Files : <br>
                                                            @foreach (unserialize($item->files) as $file)
                                                                <a href="{{ asset('assignments/'.$file) }}" class="btn btn-sm btn-default" download>{{$file}}</a>
                                                            @endforeach
                                                        </div>
                                                        <div>
                                                            Link : <br>
                                                            <a href="{{$item->link}}"><i class="fas fa-paperclip"></i> {{$item->link}}</a>
                                                        </div>
                                                        <form action="{{url('addSubmission/'.$item->courseID.'/'.$item->assignmentID.'/'.$memberID)}}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label>File</label>
                                                                <div class="input-group">
                                                                    <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" name="files[]" value="{{old('files[]')}}" multiple>
                                                                    <label class="custom-file-label">Choose file</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @if ($today > $item->end_date)
                                                                <input type="text" style="display: none" name="status" value="DONE LATE">
                                                            @else
                                                                <input type="text" style="display: none" name="status" value="DONE">
                                                            @endif
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="submit" name="submit" class="btn btn-primary">Upload</button>
                                                        </form>
                                                    </div>
                                              </div>
                                              <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- /.modal -->
                                        @error('files')
                                            <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
                                            <script> window.addEventListener("load",clickNotif);</script>	
                                        @enderror
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                      </div>
                      <div class="tab-pane fade" id="vert-tabs-module" role="tabpanel" aria-labelledby="vert-tabs-module-tab">
                        <table class="table table-sm">
                            <thead>
                              <tr>
                                <th style="width: 5%">#</th>
                                <th style="width: 55%">Title</th>
                                <th style="width: 10%">Detail</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php $no=1?>
                                @foreach ($assignment as $item)
                                    <?php $exist=false?>
                                    @foreach ($asslog as $data)
                                        @if ($item->assignmentID == $data->assignmentID)
                                            @if ($data->memberID == $memberID)
                                                <?php $exist=true?>
                                            @endif
                                        @endif
                                    @endforeach 
                                    @if ((!$exist) && ($item->types == 'MATERI'))
                                        <tr>
                                            <td>{{$no++}}</td>
                                            <td>{{$item->title}}</td>
                                            <td>
                                                <a href="" class="btn btn-sm btn-warning" data-toggle="modal" data-target="{{'#modal-module'.$item->assignmentID}}"><i class="far fa-folder-open"></i> Open</a>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="{{'modal-module'.$item->assignmentID}}">
                                            <div class="modal-dialog modal-lg">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h4 class="modal-title">
                                                    {{$item->title}}
                                                  </h4>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                                    <div class="modal-body">
                                                        <div>
                                                            <p>{{$item->description}}</p>
                                                        </div>
                                                        <div>
                                                            Files : <br>
                                                            @foreach (unserialize($item->files) as $file)
                                                                <a href="{{ asset('assignments/'.$file) }}" class="btn btn-sm btn-default" download>{{$file}}</a>
                                                            @endforeach
                                                        </div>
                                                        <div>
                                                            Link : <br>
                                                            <a href="{{$item->link}}"><i class="fas fa-paperclip"></i> {{$item->link}}</a>
                                                        </div>
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
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                      </div>
                      <div class="tab-pane fade" id="vert-tabs-quiz" role="tabpanel" aria-labelledby="vert-tabs-quiz-tab">
                        <table class="table table-sm">
                            <thead>
                              <tr>
                                <th style="width: 5%">#</th>
                                <th style="width: 55%">Title</th>
                                <th style="width: 15%">Start Date</th>
                                <th style="width: 15%">End Date</th>
                                <th style="width: 10%">Detail</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php $no=1?>
                                @foreach ($assignment as $item)
                                    <?php $exist=false?>
                                    @foreach ($asslog as $data)
                                        @if ($item->assignmentID == $data->assignmentID)
                                            @if ($data->memberID == $memberID)
                                                <?php $exist=true?>
                                            @endif
                                        @endif
                                    @endforeach 
                                    @if ((!$exist) && ($item->types == 'KUIS'))
                                        <tr>
                                            <td>{{$no++}}</td>
                                            <td>{{$item->title}}</td>
                                            <td>{{$item->start_date}}</td>
                                            <td>{{$item->end_date}}</td>
                                            <td>
                                                <?php 
                                                    date_default_timezone_set('Asia/Jakarta');
                                                    $today = date('Y-m-d');
                                                ?>
                                                @if ($today < $item->start_date)
                                                    <a href="#" class="btn btn-sm btn-danger"><i class="far fa-folder"></i> Soon</a>    
                                                @else
                                                    <a href="" class="btn btn-sm btn-warning" data-toggle="modal" data-target="{{'#modal-quiz'.$item->assignmentID}}"><i class="far fa-folder-open"></i> Open</a>
                                                @endif
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="{{'modal-quiz'.$item->assignmentID}}">
                                            <div class="modal-dialog modal-lg">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h4 class="modal-title">
                                                    {{$item->title}}
                                                  </h4>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                                    <div class="modal-body">
                                                        <div>
                                                            <p>{{$item->description}}</p>
                                                        </div>
                                                        <div>
                                                            Files : <br>
                                                            @foreach (unserialize($item->files) as $file)
                                                                <a href="{{ asset('assignments/'.$file) }}" class="btn btn-sm btn-default" download>{{$file}}</a>
                                                            @endforeach
                                                        </div>
                                                        <div>
                                                            Link : <br>
                                                            <a href="{{$item->link}}"><i class="fas fa-paperclip"></i> {{$item->link}}</a>
                                                        </div>
                                                        <form action="{{url('addSubmission/'.$item->courseID.'/'.$item->assignmentID.'/'.$memberID)}}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label>File</label>
                                                                <div class="input-group">
                                                                    <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" name="files[]" value="{{old('files[]')}}" multiple>
                                                                    <label class="custom-file-label">Choose file</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @if ($today > $item->end_date)
                                                                <input type="text" style="display: none" name="status" value="DONE LATE">
                                                            @else
                                                                <input type="text" style="display: none" name="status" value="DONE">
                                                            @endif
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="submit" name="submit" class="btn btn-primary">Upload</button>
                                                        </form>
                                                    </div>
                                              </div>
                                              <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- /.modal -->
                                        @error('files')
                                            <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
                                            <script> window.addEventListener("load",clickNotif);</script>	
                                        @enderror
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                      </div>
                      <div class="tab-pane fade" id="vert-tabs-submitted" role="tabpanel" aria-labelledby="vert-tabs-submitted-tab">
                        <table class="table table-sm">
                            <thead>
                              <tr>
                                <th style="width: 5%">#</th>
                                <th style="width: 45%">Title</th>
                                <th style="width: 15%">Submit Date</th>
                                <th style="width: 15%">Graded at</th>
                                <th style="width: 10%">Grades</th>
                                <th style="width: 10%">Status</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php $no=1?>
                                @foreach ($assignment as $item)
                                    <?php $exist=false?>
                                    @foreach ($asslog as $data)
                                        @if ($item->assignmentID == $data->assignmentID)
                                            @if ($data->memberID == $memberID)
                                                <?php 
                                                    $exist=true;
                                                    $grades = $data->grades;
                                                    if ($grades == NULL) {
                                                        $grades = '-';
                                                    }
                                                    $status = $data->status;
                                                    $submitted = $data->created_at;
                                                    $graded = $data->updated_at;
                                                ?>
                                            @endif
                                        @endif
                                    @endforeach 
                                    @if ($exist)
                                        <tr>
                                            <td>{{$no++}}</td>
                                            <td>{{$item->title}}</td>
                                            <td>{{$submitted}}</td>
                                            <td>{{$graded}}</td>
                                            <td>{{$grades}}</td>
                                            <td>{{$status}}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <!-- /.card -->            
        </div>
        <!-- /.card -->   
    </div>
    <!-- /.container-fluid -->
</div>
@endsection
@section('script')
<!-- bs-custom-file-input -->
<script src="{{ asset('') }}adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- dropzonejs -->
<script src="{{ asset('') }}adminlte/plugins/dropzone/min/dropzone.min.js"></script>
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
    $(function () {
        bsCustomFileInput.init();
    });
</script>
@endsection