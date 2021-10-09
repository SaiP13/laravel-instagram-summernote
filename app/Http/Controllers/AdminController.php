<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AdminController extends Controller
{
    public function index(){
        if(session('adminid')){
            return view('admin.index');
        } else {
            return redirect('login');
        }
    }


    //bog

    public function blogs(){

        $blogs = DB::table('blogs')->orderBy('blog_id','desc')->get();
        return view('admin.blog',['blogs'=>$blogs]);
    }


    public function home(){

        $result = DB::table('home')->where('id',1)->first();
        return view('admin.home',['result'=>$result]);
    }
    public function updateHomeContent(Request $request){

        $data['home'] = $request->content;

        $result = DB::table('home')->where('id',1)->update($data);

        if($result){
            return "success";
        } else {
            return "failed";
        }
    }
    public function deleteHomeContent(Request $request){

        $data['home'] = "";
        $result = DB::table('home')->where('id',1)->update($data);

        if($result){
            return "success";
        } else {
            return "failed";
        }
    }

    public function about(){
        return view('admin.about');
    }
    public function services(){
        return view('admin.services');
    }
    public function portfolio(){
        return view('admin.portfolio');
    }
    public function team(){
        return view('admin.team');
    }
    public function contact(){
        return view('admin.contact');
    }
    public function blank(){
        return view('admin.blank');
    }
}
