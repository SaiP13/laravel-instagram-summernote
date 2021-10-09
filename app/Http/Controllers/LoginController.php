<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class LoginController extends Controller
{
    public function login(){
        return view('admin.login');
    }
    public function register(){
        return view('admin.register');
    }

    public function registerAction(Request $request){

        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|unique:admin',
            'password'=> 'required',
            'password_confirmation' => 'required|same:password'
        ]);

        $data = $request->except('_token','password_confirmation');

        $data['password'] = \Hash::make($request->password);

        if($request->hasFile('profile_img')) {
            $imgName = $request->file('profile_img');
            $fileName = $imgName->getClientOriginalName();
            $imgName->move(public_path('users/'), $fileName);
            $data['profile_img'] = $fileName;
        }

        $insertResult = DB::table('admin')->insert($data);

        if($insertResult){
            return redirect('/login')->with('status', 'User created!');
        } else{
            return redirect('register')->with('status', 'Failed! try again');;
        }
    }
    public function loginAction(Request $request){

        $this->validate($request,[
            'email'=> 'required',
            'password'=> 'required',
        ]);

        $mail = $request['email'];
        $password = $request['password'];

        $user = DB::table('admin')->where('email',$mail)->first();

        if(!empty($user) && \Hash::check($password, $user->password)){
            $request->session()->put('adminid', $user->id);
            $request->session()->put('adminname', $user->name);
            $request->session()->put('profile_img', $user->profile_img);
            $request->session()->flash('status', "Login successs");
            return redirect('/admin');
        } else {
            $request->session()->flash('status', "Invalid User");
            return redirect('/login');
        }
    }


    public function logout(){
        Session::flush();
        return redirect('/');
    }
}
