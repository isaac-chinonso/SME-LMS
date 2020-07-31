<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Profile;

class UserController extends Controller
{
    // Login Function
    public function signin(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect('/')
                ->withErrors($validator)
                ->withInput($request->all());
        }

        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password'], 'role_id' => '1'])) {

            return redirect()->intended(route('admindashboard'));
        }

        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password'], 'role_id' => '2'])) {

            return redirect()->intended(route('traineedashboard'));
        }

        \Session::flash('warning_message', 'These credentials do not match our records.');

        return redirect()->back();
    }

    //Save Users Function
    public function savelogin(Request $request)
    {
        // Validation
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = Auth::user();
        // Save Record into user DB
        $user = new User();
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->role_id = 2;
        $user->status = 1;

        if (User::where('email', '=', $user->email)->where('role_id', '=', '2')->exists()) {
            return redirect()->back()->with('warning_message', 'Student already exist and cant be added');
        } else {

            $user->save();

            // Save Record into Profile
            $profile = new Profile();
            $profile->user_id = $user->id;
            $profile->fname = $request->input('fname');
            $profile->lname = $request->input('lname');
            $profile->phone = '';
            $profile->dob = '';
            $profile->address = '';
            $profile->business = '';

            $profile->save();

            Auth::login($user);
            $user = Auth::user();
        }
        \Session::flash('Success_message', 'You Have Successfully Registered');

        return redirect()->route('admintrainee');
    }

    // Update Profile function
    public function updateprofile(Request $request, $id)
    {
        $user = Auth::user();
        // Validation
        $this->validate($request, array(
            'fname' => 'required',
            'lname' => 'required',
            'phone' => 'required',
            'dob' => 'required',
            'address' => 'required',
            'business' => 'required',
        ));

        $fname = $request['fname'];
        $lname = $request['lname'];
        $phone = $request['phone'];
        $dob = $request['dob'];
        $address = $request['address'];
        $business = $request['business'];


        Profile::where(['user_id' => $id])
            ->update(array(
                'fname' => $fname,
                'lname' => $lname,
                'phone' => $phone,
                'dob' => $dob,
                'address' => $address,
                'business' => $business
            ));
        \Session::flash('Success_message', '✔ Profile Updated Succeffully');

        return back();
    }

    // Update User function
    public function updateuser(Request $request, $id)
    {
        //validate post data
        $this->validate($request, [
            'password' => 'required|min:4',
            'confirm_password' => 'required|same:password',
        ]);

        $user = User::where("id", $id)->first();
        $user->password =  bcrypt($request->input('password'));
        $user->save();

        \Session::flash('Success_message', '✔ Record Updated Succeffully');

        return redirect()->route('traineeprofile');
    }

    public function deletetrainee($id)
    {
        // Delete User
        $user = User::where('id', $id)->first();
        $user->delete();

        \Session::flash('Success_message', 'You Have Successfully Deleted User');

        return redirect()->route('admintrainee');
    }

    // Logout Function
    public function logout()
    {
        $user = Auth::user();

        Auth::logout();
        return redirect()->route('login');
    }
}
