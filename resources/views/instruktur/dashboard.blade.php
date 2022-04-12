@extends('instruktur/template')
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
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>Courses</h3>
  
                  <p>Course List</p>
                </div>
                <div class="icon">
                  <i class="fas fa-book-open nav-icon"></i>
                </div>
                <a href="{{ route('courseLinked')}}" class="small-box-footer">
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