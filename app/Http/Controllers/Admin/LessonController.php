<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Lesson;

class LessonController extends Controller
{
    //Save Lesson Function
    public function savelesson(Request $request)
    {
        // Validation
        $this->validate($request, [
            'course_id' => 'required',
            'title' => 'required',
            'abstract' => 'required',
            'content' => 'required',
        ]);

        $course_id = $request['course_id'];

        $title = $request['title'];

        $abstract = $request['abstract'];

        // save content 
        if ($request->hasFile('content')) {
            $content = $request->file('content');
            $filename = time() . '.' . $content->getClientOriginalExtension();
            $destination = public_path('upload/lesson');
            $content->move($destination, $filename);
        }

        // Save Record into Lesson DB
        $lesson = new Lesson();
        $lesson->course_id = $course_id;
        $lesson->title = $title;
        $lesson->abstract = $abstract;
        $lesson->content = $filename;
        $lesson->status = 1;

        if (Lesson::where('title', '=', $lesson->title)->exists()) {

            return redirect()->back()->with('warning_message', 'Lesson already exist and cant be added twice');
        } else {

            $lesson->save();

            \Session::flash('Success_message', '✔ Post Successfully Added.');

            return redirect()->route('adminlesson');
        }
    }

    public function deletelesson($id)
    {
        // Delete Lesson
        $lesson = Lesson::where('id', $id)->first();
        $file_path = public_path() . '/upload/lesson/' . $lesson->content;
        unlink($file_path);
        $lesson->delete();

        \Session::flash('Success_message', 'You Have Successfully Deleted file');

        return back();
    }
}
