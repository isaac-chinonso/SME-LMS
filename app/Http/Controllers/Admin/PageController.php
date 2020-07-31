<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Course;
use App\Feedback;
use App\Lesson;
use App\User;

class PageController extends Controller
{
    public function login()
    {
        return view('admin.index');
    }

    public function dashboard()
    {
        $user = Auth::user();
        $data['course'] = Course::where('status', 1)->count();
        $data['lesson'] = Lesson::where('status', 1)->count();
        $data['trainee'] = User::where('role_id', 2)->count();
        return view('admin.dashboard',$data);
    }

    public function course()
    {
        $data['courses'] = Course::where('status',1)->get();
        return view('admin.course', $data);
    }

    public function lesson()
    {
        $data['lesson'] = Lesson::where('status',1)->get();
        $data['courses'] = Course::where('status',1)->get();
        return view('admin.lesson', $data);
    }

    public function trainee()
    {
        $data['users'] = User::where('role_id',2)->get();
        return view('admin.trainees', $data);
    }

    public function feedback()
    {
        $data['feedback'] = Feedback::where('status',1)->get();
        return view('admin.feedback', $data);
    }

    public function deletfeedback($id)
    {
        // Delete Feedback
        $feedback = Feedback::where('id',$id)->first();
        $feedback->delete();
        
        \Session::flash('Success_message','You Have Successfully Deleted Feedback');

         return back();
    }
}
