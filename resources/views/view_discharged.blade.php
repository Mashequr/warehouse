@extends('layout')


@section('title', 'Discharged Stocks')

@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">View Discharged Stocks</h1>
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
                                <th>Discharge Date</th>
                                <th>Client</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $data as $item)
                                <tr>
                                    <td>{{ $item->stockid }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->amount }} {{ $item->unit }}</td>
                                    <td>{{ $item->discharge_date }} TK</td>
                                    <td>
                                        {{ $item->clientname }}
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

@endsection
