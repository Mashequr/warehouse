@extends('layout')


@section('title', 'Dashboard')

@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add Client</h1>
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
                <div class="col-lg-4">
                    <form method="POST" action="{{ route('admin_saveclients') }}">
                        @csrf
                        <div class="form-group">
                            <label>Client Name</label>
                            <input type="text" name="clientname" placeholder="Enter Client Name.." class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Client Email</label>
                            <input type="email" name="email" placeholder="Enter Client Email.." class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Client Contact</label>
                            <input type="text" name="contact" placeholder="Enter Client Contact.." class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Client Address</label>
                            <input type="text" name="address" placeholder="Enter Client Address.." class="form-control" />
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Add Client</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-8">
                    <table id="myTable" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Client Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $data as $item)
                                <tr>
                                    <td>{{ $item->clientname }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->contact }}</td>
                                    <td>
                                        <button class="btn btn-success">Edit</button>
                                        <button class="btn btn-danger ml-2" data-target="#DeleteModal{{ $item->clientid }}" data-toggle="modal">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>


@foreach( $data as $item)
<div class="modal fade" id="DeleteModal{{ $item->clientid }}" tabindex="-1" role="dialog" aria-labelledby="DeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" action="{{ route('admin_deleteclient') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="DeleteModalLabel">Delete Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="{{ $item->clientid }}" name="cid" />
                    <h3>Are You Sure ?</h3>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endforeach

@endsection
