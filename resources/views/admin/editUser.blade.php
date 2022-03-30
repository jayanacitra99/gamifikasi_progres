@extends('admin/template')
@section('title')
    Gamifikasi - Edit User : {{$user->name}}
@endsection
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <!-- general form elements -->
        <div class="card">
            <div class="card-header" style="background-color: #a12520; color: white">
            <h3 class="card-title">Edit User : {{$user->name}}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ url('editUserData/'.$user->id) }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{$user->name}}">
                    </div>
                    @error('name')
                    <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
                    <script> window.addEventListener("load",clickNotif);</script>	
                    @enderror
                    <div class="form-group">
                        <label>Role</label>
                        <select name="role" class="form-control">
                            <option value="ADMIN" {{($user->role === 'ADMIN') ? 'selected' : ''}}>ADMIN</option>
                            <option value="PESERTA" {{($user->role === 'PESERTA') ? 'selected' : ''}}>MEMBER</option>
                            <option value="INSTRUKTUR" {{($user->role === 'INSTRUKTUR') ? 'selected' : ''}}>INSTRUKTUR</option>
                        </select>
                    </div>
                    @error('role')
                    <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
                    <script> window.addEventListener("load",clickNotif);</script>
                    @enderror
                    <div class="form-group">
                        <label>Email address</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter email" value="{{$user->email}}">
                    </div>
                    @error('email')
                    <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
                    <script> window.addEventListener("load",clickNotif);</script>	
                    @enderror
                    <div class="form-group">
                        <label>Badges</label>
                        <select name="badges" class="form-control">
                            <option value="BRONZE" {{($user->badges === 'BRONZE') ? 'selected' : ''}}>BRONZE</option>
                            <option value="SILVER" {{($user->badges === 'SILVER') ? 'selected' : ''}}>SILVER</option>
                            <option value="GOLD" {{($user->badges === 'GOLD') ? 'selected' : ''}}>GOLD</option>
                            <option value="DIAMOND" {{($user->badges === 'DIAMOND') ? 'selected' : ''}}>DIAMOND</option>
                        </select>
                    </div>
                    @error('badges')
                    <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
                    <script> window.addEventListener("load",clickNotif);</script>
                    @enderror
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Level</label>
                                <input type="number" name="level" class="form-control" min="0" max="99" placeholder="Enter Level" value="{{$user->levels}}">
                            </div>
                            @error('level')
                                <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
                                <script> window.addEventListener("load",clickNotif);</script>	
                            @enderror
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Point</label>
                                <input type="number" name="point" class="form-control" min="0" max="10000" placeholder="Enter Point" value="{{$user->point}}">
                            </div>
                            @error('point')
                                <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
                                <script> window.addEventListener("load",clickNotif);</script>	
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" name="submit" class="btn btn-primary">Edit User</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div><!-- /.container-fluid -->
</div>
@endsection