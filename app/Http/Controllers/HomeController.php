<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;

class HomeController extends Controller
{
    public function index(){

        $home_content = DB::table('home')->where('id',1)->first();
        return view('home.index',['home_content'=>$home_content]);
    }
    public function locality(){
        return view('admin.locality');
    }

    public function getLocality(Request $request){
        //method 1
        // return datatables()->of(DB::table('tbl_localities'))->toJson();

        //method 2
        return datatables(DB::table('tbl_localities'))->toJson();
    }
}
