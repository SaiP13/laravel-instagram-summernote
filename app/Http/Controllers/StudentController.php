<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Marks;

class StudentController extends Controller
{
    public function average(){
        return view('student.average');
    }
    public function getStudent(){

        $value = Student::find(1)->marks;

        return $value->toJson();
        // dd($value);
    }
}
