<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Course;
use App\Feedback;
use App\Lesson;

class PageController extends Controller
{
    public function dashboard()
    {
        $data['course'] = Course::where('status', 1)->count();
        $data['lesson'] = Lesson::where('status', 1)->count();
        $data['trainee'] = User::where('role_id', 2)->count();
        return view('student.dashboard', $data);
    }

    public function course()
    {
        $data['courses'] = Course::where('status', 1)->get();
        return view('student.course', $data);
    }

    public function lesson()
    {
        $data['lesson'] = Lesson::where('status', 1)->get();
        return view('student.lesson', $data);
    }

    public function takelesson($id)
    {
        $data['lessons'] = Lesson::where('id', $id)->where('status', 1)->first();
        return view('student.takelesson', $data);
    }

    public function feedback()
    {
        return view('student.feedback');
    }

    //Save Feedback Function
    public function savefeedback(Request $request)
    {
        $user = Auth::user();
        // Validation
        $this->validate($request, [
            'experience' => 'required',
            'suggestions' => 'required',
        ]);

        // Save Record into Feedback DB
        $feedback = new Feedback();
        $feedback->user_id = $user->id;
        $feedback->experience = $request->input('experience');
        $feedback->suggestions = $request->input('suggestions');
        $feedback->status = 1;
        $feedback->save();

        \Session::flash('Success_message', '✔ Feedback Submitted Successfully.');

        return redirect()->route('traineefeedback');
    }

    public function profile()
    {
        $user = Auth::user();
        $data['users'] = User::where('role_id', 2)->where('id', $user->id)->first();
        return view('student.profile', $data);
    }

    public function editprofile($id)
    {
        $data['users'] = User::where('role_id', 2)->where('id', $id)->first();
        return view('student.editprofile', $data);
    }
}
