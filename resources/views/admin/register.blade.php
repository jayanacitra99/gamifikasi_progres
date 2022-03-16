@extends('admin/template')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <!-- general form elements -->
        <div class="card">
            <div class="card-header" style="background-color: #a12520; color: white">
            <h3 class="card-title">Register New User</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Name">
                    </div>
                    @error('name')
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-exclamation-triangle"></i> {{ $message}}</h5>
                    </div>
                    @enderror
                    <div class="form-group">
                        <label>Role</label>
                        <select name="role" class="form-control">
                            <option value="ADMIN">ADMIN</option>
                            <option value="PESERTA">MEMBER</option>
                            <option value="INSTRUKTUR">INSTRUKTUR</option>
                        </select>
                    </div>
                    @error('role')
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-exclamation-triangle"></i> {{ $message}}</h5>
                    </div>
                    @enderror
                    <div class="form-group">
                        <label>Email address</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter email">
                    </div>
                    @error('email')
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-exclamation-triangle"></i> {{ $message}}</h5>
                    </div>
                    @enderror
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="Password" name="password" value="{{ old('password') }}">
                    </div>
                    @error('password')
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-exclamation-triangle"></i> {{ $message}}</h5>
                    </div>
                    @enderror
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" placeholder="Retype password" id="password-confirm" name="password_confirmation" autocomplete="new-password" value="{{ old('password_confirmation') }}">
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" name="submit" class="btn btn-primary">Register</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div><!-- /.container-fluid -->
</div>
@endsection