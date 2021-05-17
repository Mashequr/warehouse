<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Stock;
use App\Invoice;
use DateTime;

class StockController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addstock()
    {
        $clients = DB::table('clients')->get();
        $category = DB::table('categorys')->get();
        //dd($clients);
        $sid = "ST".date('Ydm')."ITM".date('ihs');
        //dd($sid);
        return view('addstock',['clients' => $clients, 'category' => $category, 'sid' => $sid]);
    }

    public function savestock(Request $request)
    {
        //dd($request->input());
        try{
            $stock = new Stock;
            $stock->stockid = $request->stockid;
            $stock->category = $request->category;
            $stock->description = $request->description;
            $stock->quantity = $request->quantity;
            $stock->amount = $request->amount;
            $stock->unit = $request->unit;
            $stock->client = $request->client;
            $stock->stockdate = $request->stockdate;
            $stock->stockuntil = $request->stockuntil;
            $stock->save();
            return redirect(route('admin_confirmstock', $request->stockid))->with('success', 'Stock Info Saved');
        }
        catch(Exception $e)
        {
            return redirect(route('admin_addstock'))->with('failed', 'DATABASE ERROR !!!');
        }
    }

    public function confirmstock($sid)
    {
        $total = 0;
        $unitcost = 0;

        $data = DB::table('stocks')->where('stockid', $sid)->get()->first();
        $client = DB::table('clients')->where('clientid', $data->client)->get()->first();
        //dd($client);
        if($data->unit == 'ltr')
        {
            $total = $data->amount * 25;
            $unitcost = 25;
        }
        else
        {
            $total = $data->amount * 20;
            $unitcost = 20;
        }
        //dd($data);
        return view('confirm_stock', ['client' => $client,'data' => $data, 'stockid' => $sid, 'total' => $total, 'unitcost' => $unitcost]);
    }

    public function confirminvoice(Request $request)
    {
        //dd($request->input());
        $status = "";
        try{
            if($request->due > 0)
            {
                $status = "Due";
            }
            else
            {
                $status = "Paid";
            }

            $invoice = new Invoice;
            $invoice->stockid = $request->stockid;
            $invoice->total = $request->total;
            $invoice->paid = $request->paid;
            $invoice->due = $request->due;
            $invoice->paymethod = $request->paymethod;
            $invoice->status = $status;
            $invoice->save();

            return redirect(route('admin_addstock'))->with('success', 'New Stock Addedd Successfully');

        }
        catch(Exception $e)
        {
            return redirect(route('admin_addstock'))->with('failed', 'Operation Error !!!');
        }
    }

    public function viewstocks()
    {
        $data = DB::table('stocks')->join('invoices','stocks.stockid','=','invoices.stockid')->join('clients','stocks.client','=','clients.clientid')->where('stocks.status','Stocked')->get();
        return view('viewstocks', ['data' => $data]);
    }

    public function deletestocks(Request $request)
    {
        try{
            DB::table('stocks')->where('stockid', $request->stockid)->delete();
            DB::table('invoices')->where('stockid', $request->stockid)->delete();
            return redirect(route('admin_viewstocks'))->with('success', 'Stock Deleted Successfully');
        }
        catch(Exception $e)
        {
            return redirect(route('admin_viewstocks'))->with('failed', 'Operation Error !!!');
        }
    }

    public function viewinvoice($stockid)
    {
        $data = DB::table('stocks')->join('invoices','stocks.stockid','=','invoices.stockid')->where('stocks.stockid',$stockid)->get()->first();
        $client = DB::table('clients')->where('clientid',$data->client)->get()->first();
       //dd($data);
        return view('viewinvoice', ['stockid' => $stockid, 'data' => $data,'client' => $client]);
    }

    public function dischargestocks(Request $request)
    {
        $stock = DB::table('stocks')->where('stockid', $request->sid)->get()->first();
        $invoice = DB::table('invoices')->where('stockid', $request->sid)->get()->first();
        $client = DB::table('clients')->where('clientid', $stock->client)->get()->first();

        $discharge_date = new DateTime($request->discharge_date);
        $stock_until = new DateTime($stock->stockuntil);
        $interval = $stock_until->diff($discharge_date)->format('%a');

        $late_fee = 20 * $interval;
        $due = $invoice->due;
        $total = $late_fee + $due;
        //dd($total);

        return view('discharge',['stockid' => $stock->stockid,'data'=>$stock,'invoice'=>$invoice,'client'=>$client,'late_fee'=>$late_fee,'due'=>$due,'total'=>$total,'discharge_date'=>$request->discharge_date ]);
    }

    public function confirmdischarge(Request $request)
    {

        try{
            //dd($request->input());
            DB::table('invoices')->where('stockid', $request->stockid)->update(['latefee'=>$request->latefee]);
            DB::table('stocks')->where('stockid', $request->stockid)->update(['discharge_date'=>$request->discharge_date,'status'=>'Discharged']);
<<<<<<< HEAD
=======

            //DB::table('stocks')->where('stockid', $request->stockid)->delete();
            //DB::table('invoices')->where('stockid', $request->stockid)->delete();
>>>>>>> 02116d1b5d7496866504006494911ea8b733644f
            // return redirect(route('admin_viewstocks'))->with('success', 'Stock Deleted Successfully');

            return redirect(route('admin_dischargedstocks'))->with('success','Stock Discharged Successfully');
        }
        catch(Exception $e)
        {
            return redirect(route('admin_viewstocks'))->with('failed', 'Operation Error !!!');
        }

    }

    public function dischargedstocks()
    {
        $data = DB::table('stocks')->join('invoices','stocks.stockid','=','invoices.stockid')->join('clients','stocks.client','=','clients.clientid')->where('stocks.status','Discharged')->get();
        return view('view_discharged', ['data' => $data] );
    }
}
