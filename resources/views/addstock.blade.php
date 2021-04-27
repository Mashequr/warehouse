@extends('layout')


@section('title', 'Add Stock')

@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add Stock</h1>
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
            <form method="POST" action="{{ route('admin_savestock') }}">
                @csrf
                <input type="hidden" value="{{ $sid }}" name="stockid" />
                <div class="row">
                    <div class="col-lg-4">
                        <label>Category  <span style="color: red">*</span></label>
                        <select id="category" class="custom-select" required name="category">
                            <option value="" selected>--Select One Option--</option>
                            @foreach($category as $item)
                                <option value="{{ $item->catname }}">{{ $item->catname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-8">
                        <label>Item Description <span style="color: red">*</span></label>
                        <input required type="text" class="form-control" name="description" />
                    </div>
                    <div class="col-lg-4 mt-3">
                        <label>Quantity <span style="color: red">*</span></label>
                        <input id="qty" required type="number" class="form-control" name="quantity" />
                    </div>
                    <div class="col-lg-4 mt-3">
                        <label>Amount <span style="color: red">*</span></label>
                        <input id="amount" required type="number" class="form-control" name="amount" />
                    </div>
                    <div class="col-lg-4 mt-3">
                        <label>Unit <span style="color: red">*</span></label>
                        <select required class="custom-select" name="unit" id="unit">
                            <option value="" selected>--Select One Option--</option>
                            <option value="kg">Kg</option>
                            <option value="ltr">Liter</option>
                        </select>
                    </div>

                    <div class="col-lg-4 mt-3">
                        <label>Client <span style="color: red">*</span></label>
                        <select required class="custom-select" name="client">
                            <option value="" selected>--Select One Option--</option>
                            @foreach($clients as $item)
                                <option value="{{ $item->clientid }}">{{ $item->clientname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-4 mt-3">
                        <label>Stock Date </label>
                        <input type="date" class="form-control" name="stockdate" />
                    </div>
                    <div class="col-lg-4 mt-3">
                        <label>Stock Untill <span style="color: red">*</span></label>
                        <input required type="date" class="form-control" name="stockuntil" />
                    </div>

                    <div class="col-lg-12 mt-3 text-center">
                        <button type="submit" class="btn btn-lg btn-primary">Save Stock</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

</div>


<script src="{{ asset('storage/js/custom.js') }}"></script>

@endsection
