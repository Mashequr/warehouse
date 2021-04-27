<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>Invoice | Warehouse</title>

    <style>
        .custom-input{
            text-align: right;
            width: 50%;
            margin: 0 auto;
        }
    </style>

  </head>
  <body>

    <div class="container">
            <input type="hidden" value="{{ $stockid }}" name="stockid" />
            <div class="row mt-3">
                <div class="col-lg-4">
                    <img src="{{ asset('storage/logo.png') }}" class="img-thumbnail" style="border: none" />
                </div>
                <div class="col-lg-8 text-right">
                    <h3>BD WareHouse</h3>
                    <h5>Shah Makhdum Avenue, Uttara, Dhaka - 1230</h5>
                    <h5>Phone: 123456, 9874622</h5>
                    <h5>Email: noreply@warehouse.xyz</h5>
                </div>
                <div class="col-lg-12"><hr></div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-6">
                    <h4><u>Billed To:</u></h4>
                    <h5>{{ $client->clientname }}</h5>
                    <h5>{{ $client->address }}</h5>
                    <h5>Phone: {{ $client->contact }}</h5>
                </div>
                <div class="col-lg-6 text-right">
                    <h4><u>Invoice:</u></h4>
                    <h5>StockID: {{ $stockid }}</h5>
                    <h5>Stock Date: {{ $data->stockdate }}</h5>
                    <h5>Stock Until: {{ $data->stockuntil }}</h5>
                </div>
            </div>
            <div class="row mt-2">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Item Description</th>
                            <th>Category</th>
                            <th>Unit Price</th>
                            <th>Qty</th>
                            <th>Total(TK)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>{{ $data->description }}<br> Items: {{ $data->quantity }}</td>
                            <td>{{ $data->category }}</td>
                            <td>20</td>
                            <td>{{ $data->amount }} {{ $data->unit }}</td>
                            <td style="width: 25%">{{ $data->total }}</td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-right"><b>Total</b></td>
                            <td><input type="number" id="total" name="total" class="form-control custom-input" readonly value="{{ $data->total }}" /></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <h5>Payment Method: {{ $data->paymethod }}</h5>
                            </td>
                            <td colspan="3" class="text-right"><b>Paid Amount</b></td>
                            <td><input type="number" readonly id="paid" name="paid" class="form-control custom-input" value="{{ $data->paid }}" /></td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-right"><b>Due Amount</b></td>
                            <td><input type="number" required readonly id="due" name="due" class="form-control custom-input" value="{{ $data->due }}" /></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row mt-3 mb-3">
                <div class="col-lg-12">
                    <button class="btn btn-secondary btn-block">Print</button>
                </div>
            </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

  </body>
</html>
