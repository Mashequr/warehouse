@extends('layout')


@section('title', 'Dashboard')

@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">User Profile</h1>
                </div>
                <div class="col-sm-6">
                </div>
            </div>
        </div>
    </div>
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ session('success') }}
            </div>
        @elseif(session('failed'))
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ session('failed') }}
            </div>
        @endif
    <hr>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card-body custom-back">
                        <div class="row">
                            <div class="col-lg-6">
                                @if(!Auth()->user()->avatar)
                                <img src="{{ asset('storage/user.png') }}" class="img-thumbnail mb-2" style="width: 10rem;" />
                                @else
                                <img src="{{ asset(Auth()->user()->avatar) }}" class="img-thumbnail mb-2" style="width: 10rem;"
                                @endif
                                <form method="POST" enctype="multipart/form-data" action="{{ route('admin_changeavatar') }}">
                                    @csrf
                                    <input type="file" class="form-control mb-2" name="avatar" accept="image/*" />
                                    <button class="btn btn-primary btn-block" type="submit">Change Avatar</button>
                                </form>
                            </div>
                            <div class="col-lg-6">
                                <h5>Full Name</h5>
                                <p class="mb-3">{{ Auth()->user()->name }}</p>

                                <h5>Email</h5>
                                <p>{{ Auth()->user()->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card-body custom-back">
                        <form method="POST" action="{{ route('admin_changepassword') }}">
                            @csrf
                            <div class="form-group">
                                <label>Current Password</label>
                                <input required type="password" class="form-control" name="curr_pass" />
                            </div>
                            <div class="form-group">
                                <label>New Password</label>
                                <input required type="password" class="form-control" name="new_pass" />
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input required type="password" class="form-control" name="conf_pass" />
                            </div>
                            <button type="submit" class="btn btn-info btn-block">Change Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
