@extends('template')

@section('content')
<!-- Main content -->
<section class="content-header">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header" style="background-color: #a12520; color: white">
          <h1 class="card-title"><i class="fas fa-medal"></i> Leaderboards</h1>
        </div>
        <div class="card-body">
          <table id="leaderboards" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Rank</th>
                <th>Name</th>
                <th>Total Points</th>
                <th>Level</th>
                <th>Badge</th>
              </tr>
            </thead>
            <tbody>
              <?php $no=1?>
              @foreach ($user as $item)
                @if ($item->role == 'PESERTA')
                  <tr>
                    <td>#{{$no++}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->point}}</td>
                    <td>{{$item->levels}}</td>
                    <td>{{$item->badges}}</td>
                  </tr>
                @endif
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div><!--/. container-fluid -->
</section>
<!-- /.content -->
@endsection
@section('script')
  <script>
    $(function () {
      $("#leaderboards").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#leaderboards_wrapper .col-md-6:eq(0)');
    });
  </script>
@endsection