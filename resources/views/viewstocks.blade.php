@extends('layout')


@section('title', 'View Stocks')

@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">View Stocks</h1>
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
                <div class="col-lg-12">
                    <table id="myTable" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Stock ID</th>
                                <th>Description</th>
                                <th>Amount</th>
                                <th>Total</th>
                                <th>Client</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $data as $item)
                                <tr>
                                    <td>{{ $item->stockid }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->amount }} {{ $item->unit }}</td>
                                    <td>{{ $item->total }} TK</td>
                                    <td>
                                        <a href="#" data-target="#ClientModal{{ $item->clientid }}" data-toggle="modal">{{ $item->clientname }}</a>
                                    </td>
                                    <td>
                                        <button class="btn btn-custom-1" data-target="#DischargeModal{{ $item->stockid }}" data-toggle="modal">Discharge</button>
                                        <a target="_blank" href="{{ route('admin_viewinvoice', $item->stockid ) }}" class="btn btn-success">Invoice</a>
                                        <button class="btn btn-danger ml-2" data-target="#DeleteModal{{ $item->stockid }}" data-toggle="modal">Delete</button>
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
<div class="modal fade" id="DeleteModal{{ $item->stockid }}" tabindex="-1" role="dialog" aria-labelledby="DeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" action="{{ route('admin_deletestocks') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="DeleteModalLabel">Delete Stock</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="{{ $item->stockid }}" name="stockid" />
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

<div class="modal fade" id="ClientModal{{ $item->clientid }}" tabindex="-1" role="dialog" aria-labelledby="ClientModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ClientModalLabel">Client Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <h5>Client Name</h5>
                        <p>{{ $item->clientname }}</p>
                    </div>
                    <div class="col-lg-6">
                        <h5>Contact</h5>
                        <p>{{ $item->contact }}</p>
                    </div>
                    <div class="col-lg-12">
                        <h5>Email</h5>
                        <p>{{ $item->email }}</p>
                    </div>
                    <div class="col-lg-12">
                        <h5>Address</h5>
                        <p>{{ $item->address }}</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="DischargeModal{{ $item->stockid }}" tabindex="-1" role="dialog" aria-labelledby="DischargeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="DischargeModalLabel">Discharge Stock</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="dischargeForm" method="POST" action="{{ route('admin_dischargestocks') }}">
                    @csrf
                    <input type="hidden" name="sid" value="{{ $item->stockid }}" />
                    <div class="form-group">
                        <label>Discharge Date</label>
                        <input type="date" required name="discharge_date" class="form-control" />
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="dischargeForm" class="btn btn-primary">Discharge Stock</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection
