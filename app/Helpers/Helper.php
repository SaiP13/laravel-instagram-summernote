<?php

namespace App\Helpers;
use DB;

class Helper
{
    public static function shout(string $string)
    {
        return strtoupper($string);
    }
    public static function comments_count($id)
    {
        return DB::table('comments')->where('blog_id',$id)->count();
    }
    public static function likes_count($id)
    {
        return DB::table('likes')->where('blog_id',$id)->count();
    }
    public static function checkLike($id)
    {
        $user_id = session('adminid');
        $result = DB::table('likes')->where('blog_id',$id)->where('user_id',$user_id)->first();
        return $result;
    }
    public static function dislikes_count($id)
    {
        return DB::table('dislikes')->where('blog_id',$id)->count();
    }
    public static function checkDislike($id)
    {
        $user_id = session('adminid');
        $result = DB::table('dislikes')->where('blog_id',$id)->where('user_id',$user_id)->first();
        return $result;
    }


}
