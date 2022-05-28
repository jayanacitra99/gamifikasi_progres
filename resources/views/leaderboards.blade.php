@extends('template')
@section('head-script')
    <script type="text/javascript">
      const weekday = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
      const d = new Date();
      let day = weekday[d.getDay()];
      $(document).ready(function(){
        if ((day == 'Sunday')&&($("#reward").attr("claim") == false)) {
          Swal.fire({
                title: 'Congratulation!!',
                text: "You are rank #"+$("#reward").attr("rank")+" this week!",
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Claim Reward'
            }).then((result) => {
            if (result.isConfirmed) {
                var rewardurl = $("#reward").attr('rewardurl');
                window.location.replace(rewardurl);
            }
            })
        }
      }); 
    </script>
@endsection
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
                    @if (auth()->user()->id == $item->id)
                      <?php 
                        $claim = false;
                        date_default_timezone_set('Asia/Jakarta');
                        $today = date('Y-m-d');
                      ?>
                      @foreach ($pointlog as $polog)
                          @if ((auth()->user()->id == $polog->memberID) && (date('Y-m-d', strtotime($polog->timestamp)) == $today) && ($polog->info == 'REWARD'))
                              <?php $claim = true?>
                          @endif
                      @endforeach
                      @if (!$claim)
                        <?php $rank = $no?>
                          @if ($rank == 1)
                            <?php $reward = 250?>
                          @elseif ($rank == 2)
                            <?php $reward = 200?>
                          @elseif ($rank == 3)
                            <?php $reward = 150?>
                          @elseif ($rank >= 4)
                            <?php $reward = 100?>
                          @endif
                          <a id="reward" rank="{{$rank}}" claim="{{$claim}}" rewardurl="{{url('claimReward/'.auth()->user()->id.'/'.$reward)}}" style="display: none"></a>
                      @endif
                    @endif
                    <td>{{$no++}}</td>
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