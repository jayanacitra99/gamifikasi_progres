@extends('instruktur/template')
@section('title')
    Gamifikasi - Add Assignment
@endsection
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <!-- general form elements -->
        <div class="card">
            <div class="card-header" style="background-color: #a12520; color: white">
                <h3 class="card-title">Add Assignment for {{$course->courseName}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{ url('addAssignmentData/'.$course->courseID) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Enter Title" value="{{old('title')}}">
                        </div>
                        @error('title')
                        <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
                        <script> window.addEventListener("load",clickNotif);</script>	
                        @enderror
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" name="desc" class="form-control" placeholder="Enter Description" value="{{old('desc')}}">
                        </div>
                        @error('desc')
                        <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
                        <script> window.addEventListener("load",clickNotif);</script>	
                        @enderror
                        <div class="form-group">
                            <label>Type of Assignment</label>
                            <select name="type" class="form-control" id="type" value="{{old('type')}}" onchange="hideDate()">
                                <option disabled selected>--SELECT TYPE OF ASSIGNMENT--</option>
                                <option value="MATERI">RESOURCE/MODULE</option>
                                <option value="TUGAS">ASSIGNMENT</option>
                                <option value="KUIS">QUIZ</option>
                            </select>
                        </div>
                        @error('type')
                        <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
                        <script> window.addEventListener("load",clickNotif);</script>
                        @enderror
                        <label>Due Date :</label>
                        <div class="row">
                            <div class="col" id="startdate">
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <input type="date" id="start" onchange="changeEnd()" name="start" class="form-control" value="{{old('start')}}">
                                </div>
                                @error('start')
                                <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
                                <script> window.addEventListener("load",clickNotif);</script>	
                                @enderror
                            </div>
                            <div class="col" id="enddate">
                                <div class="form-group">
                                    <label>End Date</label>
                                    <input type="date" id="end" name="end" class="form-control" value="{{old('end')}}" disabled>
                                </div>
                                @error('end')
                                <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
                                <script> window.addEventListener("load",clickNotif);</script>	
                                @enderror
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>File</label>
                                    <div class="input-group">
                                      <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="files[]" value="{{old('files[]')}}" multiple>
                                        <label class="custom-file-label">Choose file</label>
                                      </div>
                                    </div>
                                </div>
                                @error('files[]')
                                <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
                                <script> window.addEventListener("load",clickNotif);</script>	
                                @enderror
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>URL Link</label>
                                    <div class="input-group">
                                        <input type="url" name="url" class="form-control">
                                        <div class="input-group-append">
                                          <span class="input-group-text"><i class="fas fa-paperclip"></i></span>
                                        </div>
                                    </div>
                                </div>
                                @error('url')
                                <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
                                <script> window.addEventListener("load",clickNotif);</script>	
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-2" id="a_exp">
                                <label>Exp</label>
                                <input type="number" min="0"  name="a_exp" class="form-control" placeholder="Enter Exp" value="{{old('a_exp')}}">
                            </div>
                            @error('a_exp')
                            <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
                            <script> window.addEventListener("load",clickNotif);</script>	
                            @enderror
                            <div class="form-group col-2" id="a_point">
                                <label>Point</label>
                                <input type="number" min="0" name="a_point" class="form-control" placeholder="Enter Point" value="{{old('a_point')}}">
                            </div>
                            @error('a_point')
                            <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
                            <script> window.addEventListener("load",clickNotif);</script>	
                            @enderror
                        </div>
                    </div>
                    <!-- /.card-body -->
    
                    <div class="card-footer">
                        <button type="submit" name="submit" class="btn btn-primary">Add New Assignment</button>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->    
        </div>
        <!-- /.card -->
    </div><!-- /.container-fluid -->
</div>
@endsection
@section('script')
    <script>
        function hideDate() {
            var x = document.getElementById("type").value;
            if (x == "MATERI") {
                document.getElementById("startdate").style.display = 'none';
                document.getElementById("enddate").style.display = 'none';
                document.getElementById("a_exp").style.display = 'none';
                document.getElementById("a_point").style.display = 'none';
            } else {
                document.getElementById("startdate").style.display = 'block';
                document.getElementById("enddate").style.display = 'block';
                document.getElementById("a_exp").style.display = 'block';
                document.getElementById("a_point").style.display = 'block';
            }
        }
        start.min = new Date().toISOString().split("T")[0];
        function changeEnd(){
            document.getElementById('end').disabled = false;
            end.min = start.value;
        }
    </script>
@endsection