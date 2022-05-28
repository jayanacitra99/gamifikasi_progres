@extends('admin/template')
@section('title')
    Gamifikasi - Add New Course
@endsection
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <!-- general form elements -->
        <div class="card">
            <div class="card-header" style="background-color: #a12520; color: white">
            <h3 class="card-title">Add New Course</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('addNewCourse') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Course ID</label>
                        <input type="text" name="id" class="form-control" placeholder="Enter Course ID" value="{{old('id')}}">
                    </div>
                    @error('id')
                    <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
                    <script> window.addEventListener("load",clickNotif);</script>	
                    @enderror
                    <div class="form-group">
                        <label>Course Name</label>
                        <input type="text" name="courseName" class="form-control" placeholder="Enter Course Name" value="{{old('courseName')}}">
                    </div>
                    @error('courseName')
                    <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
                    <script> window.addEventListener("load",clickNotif);</script>	
                    @enderror
                    <div class="form-group">
                        <label>Instruktur</label>
                        <select name="instruktur" class="form-control" value="{{old('instruktur')}}">
                            @foreach ($instruktur as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('instruktur')
                    <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
                    <script> window.addEventListener("load",clickNotif);</script>
                    @enderror
                    <div class="row">
                        <div class="form-group col">
                            <label>Day</label>
                            <select name="day" class="form-control" value="{{old('day')}}">
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                            </select>
                        </div>
                        @error('day')
                        <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
                        <script> window.addEventListener("load",clickNotif);</script>
                        @enderror
                        <div class="form-group col">
                            <label>Start Time </label>
                            <input type="time" name="start" class="form-control" value="{{old('start')}}">
                        </div>
                        @error('start')
                        <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
                        <script> window.addEventListener("load",clickNotif);</script>	
                        @enderror
                        <div class="form-group col">
                            <label>End Time </label>
                            <input type="time" name="end" class="form-control" value="{{old('end')}}">
                        </div>
                        @error('end')
                        <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
                        <script> window.addEventListener("load",clickNotif);</script>	
                        @enderror
                        <div class="form-group col">
                            <label>Start Date </label>
                            <input type="date" id="date" name="date" class="form-control" value="{{old('date')}}">
                        </div>
                        @error('date')
                        <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
                        <script> window.addEventListener("load",clickNotif);</script>	
                        @enderror
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" name="submit" class="btn btn-primary">Add New Course</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div><!-- /.container-fluid -->
</div>
@endsection
@section('script')
    <script>
        date.min = new Date().toISOString().split("T")[0];
    </script>
@endsection