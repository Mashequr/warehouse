<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Category;
use Exception;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addcategory()
    {
        $data = DB::table('categorys')->get();
        //dd($data);
        return view('add_category', ['catdata' => $data]);
    }

    public function savecategory(Request $request)
    {
        //dd($request->input());

        try{
            $cat = new Category;
            $cat->catname = $request->catname;
            $cat->save();

            return redirect(route('admin_addcategory'))->with('success', 'Category Addess Successfully');
        }
        catch(Exception $e)
        {
            return redirect(route('admin_addcategory'))->with('failed', 'DATABASE ERROR !!!');
        }

    }

    public function deletecategory(Request $request)
    {
        try{

            $id = $request->catid;
            DB::table('categorys')->where('catid', $id)->delete();
            return redirect(route('admin_addcategory'))->with('success', 'Category Deleted Successfully');
        }
        catch(Exception $e)
        {
            return redirect(route('admin_addcategory'))->with('failed', 'DATABASE ERROR !!!');
        }

    }

}
