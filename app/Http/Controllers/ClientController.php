<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Client;
use Exception;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addclient()
    {
        $data = DB::table('clients')->get();
        return view('add_client', ['data' => $data]);
    }

    public function saveclient(Request $request)
    {
        //dd($request->input());

        try{
            $client = new Client;
            $client->clientname = $request->clientname;
            $client->email = $request->email;
            $client->contact = $request->contact;
            $client->address = $request->address;
            $client->save();

            return redirect(route('admin_addclients'))->with('success', 'Client Addess Successfully');
        }
        catch(Exception $e)
        {
            return redirect(route('admin_addclients'))->with('failed', 'DATABASE ERROR !!!');
        }

    }

    public function deleteclient(Request $request)
    {
        try{

            $id = $request->cid;
            DB::table('clients')->where('clientid', $id)->delete();
            return redirect(route('admin_addclients'))->with('success', 'Client Deleted Successfully');
        }
        catch(Exception $e)
        {
            return redirect(route('admin_addclients'))->with('failed', 'DATABASE ERROR !!!');
        }

    }

}
