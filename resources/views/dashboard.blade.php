@extends('template')
@section('title')
    Gamifikasi - Dashboard
@endsection
@section('head-script')
@endsection
@section('content')
<div class="content-header">
    <div class="container-fluid"> 
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box bg-gradient-info">
                <span class="info-box-icon"><img class="img-size-50" src="{{asset('')}}adminlte/dist/img/level.png" alt=""></span>
  
                <div class="info-box-content">
                  <span class="info-box-text">Member Level</span>
                  <span class="info-box-number">{{auth()->user()->levels}} / 20</span>
  
                  <div class="progress">
                      <?php
                            $progress = (auth()->user()->levels / 20) * 100;
                        ?>
                    <div class="progress-bar" style="width: {{$progress}}"></div>
                  </div>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box bg-gradient-success">
                <span class="info-box-icon"><img class="img-size-50" src="{{asset('')}}adminlte/dist/img/exp.png" alt=""></span>
  
                <div class="info-box-content">
                  <span class="info-box-text">Member Experience</span>
                  <span class="info-box-number">{{auth()->user()->exp}} / 1000</span>
  
                  <div class="progress">
                    <?php
                            $progress = (auth()->user()->exp / 1000) * 100;
                        ?>
                    <div class="progress-bar" style="width: {{$progress}}%"></div>
                  </div>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box bg-gradient-danger">
                <span class="info-box-icon"><img class="img-size-50" src="{{asset('')}}adminlte/dist/img/point.png" alt=""></span>
  
                <div class="info-box-content">
                  <span class="info-box-text">Member Points</span>
                  <span class="info-box-number">{{auth()->user()->point}}</span>
  
                  <div class="progress" style="display: hide">
                  </div>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box bg-gradient-warning">
                <span class="info-box-icon">
                    @if (auth()->user()->badges == 'BRONZE')
                        <img class="img-circle img-size-50" src="{{asset('')}}adminlte/dist/img/bronze-medal.png" alt="">
                    @elseif (auth()->user()->badges == 'SILVER')
                        <img class="img-circle img-size-50" src="{{asset('')}}adminlte/dist/img/silver-medal.png" alt="">
                    @elseif (auth()->user()->badges == 'GOLD')
                        <img class="img-circle img-size-50" src="{{asset('')}}adminlte/dist/img/gold-medal.png" alt="">
                    @elseif (auth()->user()->badges == 'DIAMOND')
                        <img class="img-circle img-size-50" src="{{asset('')}}adminlte/dist/img/diamond.png" alt="">
                    @endif
                </span>
  
                <div class="info-box-content">
                  <span class="info-box-text">Member Badge</span>
                  <span class="info-box-number">{{auth()->user()->badges}}</span>
  
                  <div class="progress">
                    @if (auth()->user()->badges == 'BRONZE')
                        <?PHP $progress = 25?>
                    @elseif (auth()->user()->badges == 'SILVER')
                        <?PHP $progress = 50?>
                    @elseif (auth()->user()->badges == 'GOLD')
                        <?PHP $progress = 75?>
                    @elseif (auth()->user()->badges == 'DIAMOND')
                        <?PHP $progress = 100?>
                    @endif
                    <div class="progress-bar" style="width: {{$progress}}%"></div>
                  </div>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small card -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>Course List</h3>
  
                  <p>Course List</p>
                </div>
                <div class="icon">
                  <i class="fas fa-list nav-icon"></i>
                </div>
                <a href="{{route('courseList')}}" class="small-box-footer">
                  More info <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small card -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>Enroll Course</h3>
  
                  <p>Enroll Course</p>
                </div>
                <div class="icon">
                  <i class="fab fa-discourse nav-icon"></i>
                </div>
                <a href="{{route('enrollCourse')}}" class="small-box-footer">
                  More info <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small card -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>Leaderboards</h3>
  
                  <p>Leaderboards</p>
                </div>
                <div class="icon">
                  <i class="nav-icon fas fa-award"></i>
                </div>
                <a href="{{ route('leaderboards')}}" class="small-box-footer">
                  More info <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small card -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>Learn Guide</h3>
  
                  <p>Learn Guide</p>
                </div>
                <div class="icon">
                  <i class="nav-icon fas fa-walking"></i>
                </div>
                <a href="{{ route('learnMore')}}" class="small-box-footer">
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