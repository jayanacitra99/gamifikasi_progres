@extends('admin/template')
@section('title')
    Gamifikasi - Dashboard
@endsection
@section('head-script')
@endsection
@section('content')
<div class="content-header">
    <div class="container-fluid"> 
        <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small card -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>Register New User</h3>
  
                  <p>Register New User</p>
                </div>
                <div class="icon">
                  <i class="nav-icon fas fa-user-plus"></i>
                </div>
                <a href="{{route('register')}}" class="small-box-footer">
                  More info <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small card -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>User List</h3>
  
                  <p>User List</p>
                </div>
                <div class="icon">
                  <i class="fas fa-user-friends nav-icon"></i>
                </div>
                <a href="{{route('userList')}}" class="small-box-footer">
                  More info <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small card -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>Add New Course</h3>
  
                  <p>Add New Course</p>
                </div>
                <div class="icon">
                  <i class="fas fa-book-open nav-icon"></i>
                </div>
                <a href="{{ route('addcourse')}}" class="small-box-footer">
                  More info <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small card -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>Course List</h3>
  
                  <p>Course List</p>
                </div>
                <div class="icon">
                  <i class="fas fa-list nav-icon"></i>
                </div>
                <a href="{{ route('coursesList')}}" class="small-box-footer">
                  More info <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection
@section('script')
@endsection