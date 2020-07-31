<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Course;

class CourseController extends Controller
{
     //Save Course Function
     public function savecourse(Request $request)
     {
         $user = Auth::user();
         // Validation
         $this->validate($request, [
             'title' => 'required',
             'focus' => 'required',
         ]);
 
         // Save Record into Course DB
         $course = new Course();
         $course->title = $request->input('title');
         $course->focus = $request->input('focus');
         $course->status = 1;
         if (Course::where('title', '=', $course->title)->where('status', '=', '1')->exists()) {
             return redirect()->back()->with('warning_message', 'Course already exist and cant be added twice');
         } else {
             $course->save();
 
             \Session::flash('Success_message', '✔ Course Successfully Added.');
 
             return redirect()->route('admincourse');
         }
     }
 
     public function deletecourse($id)
     {
         // Delete Course
         $course = Course::where('id',$id)->first();
         $course->delete();
         
         \Session::flash('Success_message','You Have Successfully Deleted Course');
 
          return back();
     }
}
