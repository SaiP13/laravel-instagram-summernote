<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class BlogController extends Controller
{

    public function saveComment(Request $request){

        $cmt['blog_id'] = $request['id'];
        $cmt['comment'] = $request['comment'];
        $cmt['user_id'] = session('adminid');
        $cmt['datetime'] = date('Y-m-d H:i:s');
        // $cmt['datetime'] = \Carbon::now();

        $result = "";
        if(empty(DB::table('comments')->where('blog_id',$cmt['blog_id'])
            ->where('user_id',$cmt['user_id'])
            ->where('comment',$cmt['comment'])
            ->first())){
                $result = DB::table('comments')->insert($cmt);
            }


        if($result){
            return "success";

        } else {
           return "failed";
        }

    }
    public function updateComment(Request $request){

        $id = $request['id'];
        $cmt['comment'] = $request['comment'];

        $result = DB::table('comments')->where('id',$id)->update($cmt);

        if($result){
            return "success";

        } else {
           return "failed";
        }

    }
    public function addLike(Request $request){

        $cmt['blog_id'] = $request['id'];
        $cmt['user_id'] = session('adminid');
        $cmt['datetime'] = date('Y-m-d H:i:s');

        DB::table('dislikes')->where('blog_id',$request->id)->where('user_id',$cmt['user_id'])->delete();

        $result = DB::table('likes')->insert($cmt);

        if($result){
            return "success";
        } else {
           return "failed";
        }
    }
    public function removeLike(Request $request){

        $blog_id = $request['id'];
        $user_id = session('adminid');

        $result = DB::table('likes')->where('blog_id',$blog_id)->where('user_id',$user_id)->delete();

        if($result){
            return "success";
        } else {
           return "failed";
        }
    }
    public function addDislike(Request $request){

        $cmt['blog_id'] = $request['id'];
        $cmt['user_id'] = session('adminid');
        $cmt['datetime'] = date('Y-m-d H:i:s');

        DB::table('likes')->where('blog_id',$cmt['blog_id'])->where('user_id', $cmt['user_id'])->delete();
        $result = DB::table('dislikes')->insert($cmt);

        if($result){
            return "success";
        } else {
           return "failed";
        }
    }
    public function removeDislike(Request $request){

        $blog_id = $request['id'];
        $user_id = session('adminid');

        $result = DB::table('dislikes')->where('blog_id',$blog_id)->where('user_id',$user_id)->delete();

        if($result){
            return "success";
        } else {
           return "failed";
        }
    }
    public function deleteComment(Request $request){

        $id = $request['id'];

        $result = DB::table('comments')->where('id',$id)->delete();

        if($result){
            return "success";
        } else {
           return "failed";
        }
    }
    public function getComments(Request $request){
        $id = $request->id;
        $comments = DB::table('comments as C')
                    ->join('admin as A','A.id','C.user_id')
                    ->select('C.*','A.name','A.profile_img')
                    ->where('C.blog_id',$id)
                    ->orderBy('C.id','desc')
                    ->get();

        return view('blog.comments-ajax',['comments'=>$comments]);
    }
    public function getAjaxBlogs(){

        $blogs = DB::table('blogs as B')
                ->join('admin as A','A.id','B.user_id')
                ->select('B.*','A.name','A.profile_img')
                ->orderBy('blog_id','desc')
                ->get();
        return view('blog.blogs-ajax',['blogs'=>$blogs]);
    }
    public function index(){
       if(session('adminid')){
            return view('blog.index');
       } else {
           return redirect('/login');
       }
    }
    public function getBlogDetails(Request $request){
        $id = $request->id;
        $blog = DB::table('blogs')->where('blog_id',$id)->first();
        return response()->json($blog);
    }
    public function deleteBlog($id){

        $delete = DB::table('blogs')->where('blog_id',$id)->delete();
        if($delete){
            return redirect('admin/blogs')->with('status','Blog Deleted Successfully!');
        } else {
            return redirect()->back();
        }
    }

    public function addBlog(Request $request){

        $this->validate($request,[
            'blog_title' => 'required',
            'description' => 'required'
        ]);

        $blog['blog_title'] = $request['blog_title'];
        $blog['description'] = $request['description'];
        $blog['user_id'] = session('adminid');
        $blog['created_at'] = date('Y-m-d H:i:s');

        if($request->hasFile('blog_img')) {
            $imgName = $request->file('blog_img');
            // $fileName = time().'.'.$imgName->getClientOriginalExtension();
            $fileName = $imgName->getClientOriginalName();
            $imgName->move(public_path('blogs/'), $fileName);
            $blog['blog_img'] = $fileName;
        }

        $result = DB::table('blogs')->insert($blog);

        if($result){
            $request->session()->put('status', "Blog Successfully Added");
            return redirect('admin/blogs');

        } else {
            $request->session()->put('status', "Failed ! Try Again");
            return redirect('admin/blogs');
        }

    }

    public function updateBlog(Request $request){

        $this->validate($request,[
            'blog_title' => 'required',
            'description' => 'required'
        ]);

        $id = $request->blog_id;
        $blog['blog_title'] = $request['blog_title'];
        $blog['description'] = $request['description'];
        $blog['updated_at'] = date('Y-m-d H:i:s');

        if($request->hasFile('blog_img')) {
            $imgName = $request->file('blog_img');
            $fileName = $imgName->getClientOriginalName();
            $imgName->move(public_path('blogs/'), $fileName);
            $blog['blog_img'] = $fileName;
        }
        //dd($blog);

        $result = DB::table('blogs')->where('blog_id',$id)->update($blog);

        if($result){
            $request->session()->put('status', "Blog Successfully Updated");
            return redirect('admin/blogs');

        } else {
            $request->session()->put('status', "Failed ! Try Again");
            return redirect('admin/blogs');
        }

    }
}
