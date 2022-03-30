
@extends('admin/template')
@section('title')
    Gamifikasi - Edit Course : {{$course->courseName}}
@endsection
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <!-- general form elements -->
        <div class="card">
            <div class="card-header" style="background-color: #a12520; color: white">
            <h3 class="card-title">Edit Course : {{$course->courseName}}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ url('editCourseData/'.$course->courseID) }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Course ID</label>
                        <input type="text" name="id" class="form-control" placeholder="Enter Course ID" value="{{$course->courseID}}">
                    </div>
                    @error('id')
                    <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
                    <script> window.addEventListener("load",clickNotif);</script>	
                    @enderror
                    <div class="form-group">
                        <label>Course Name</label>
                        <input type="text" name="courseName" class="form-control" placeholder="Enter Course Name" value="{{$course->courseName}}">
                    </div>
                    @error('courseName')
                    <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
                    <script> window.addEventListener("load",clickNotif);</script>	
                    @enderror
                    <div class="form-group">
                        <label>Instruktur</label>
                        <select name="instruktur" class="form-control" value="{{old('instruktur')}}">
                            @foreach ($instruktur as $item)
                                <option value="{{$item->id}}" {{($course->instrukturID === $item->id) ? 'selected' : ''}}>{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('instruktur')
                    <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
                    <script> window.addEventListener("load",clickNotif);</script>
                    @enderror
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" name="submit" class="btn btn-primary">Edit Course</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div><!-- /.container-fluid -->
</div>
@endsection