@extends('template')
@section('title')
    Gamifikasi - Learn More
@endsection
@section('head-script')
@endsection
@section('content')
<div class="content-header">
    <div class="container-fluid d-flex justify-content-center"> 
        <div id="carouselExampleIndicators" class="carousel slide w-50" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active" style="background-color: rgba(0, 0, 0, 0.1); border-radius: 20px">
                <img class="d-flex w-75" src="{{asset('')}}adminlte/dist/img/scene 5.png" alt="First slide">
                <div class="carousel-caption d-none d-md-block" style="background-color: rgba(0, 0, 0, 0.5); border-radius: 20px">
                    <h1>Enroll Course</h1>
                    <p>Get More Knowledge, More Points and More Experience</p>
                </div>
              </div>
              <div class="carousel-item" style="background-color: rgba(0, 0, 0, 0.1); border-radius: 20px">
                <img class="d-block w-75" src="{{asset('')}}adminlte/dist/img/scene 6.png" alt="Second slide">
                <div class="carousel-caption d-none d-md-block" style="background-color: rgba(0, 0, 0, 0.5); border-radius: 20px">
                    <h1>Submit Assignment</h1>
                    <p>Get More Knowledge, More Points and More Experience</p>
                </div>
              </div>
              <div class="carousel-item" style="background-color: rgba(0, 0, 0, 0.1); border-radius: 20px">
                <img class="d-block w-75 " src="{{asset('')}}adminlte/dist/img/scene 12.png" alt="Third slide">
                <div class="carousel-caption d-none d-md-block" style="background-color: rgba(0, 0, 0, 0.5); border-radius: 20px">
                    <h1>Attend Every Course</h1>
                    <p>Get More Knowledge, More Points and More Experience</p>
                </div>
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
    </div>
    <!-- /.container-fluid -->
</div>
@endsection
@section('script')
@endsection