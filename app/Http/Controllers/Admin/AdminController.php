<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator,
    Session,
    Redirect,
    Response,
    DB,
    Config,
    File;
use Mail,
    Auth;
use App\User;


class AdminController extends Controller {

    public function login(Request $request) {
        if (!empty(auth('user')->user())) {
            return redirect('admin/dashboard');
        }
        $data['title'] = 'Login here !!';
        return view("admin.auth.login", $data);
    }

    public function postAuth(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|string|email|max:255|exists:users,email',
            'password' => 'required|string|between:6,30',
        ]);

        //$credentials['type'] = 'Admin';
        if (auth('user')->attempt($credentials)) {

            $user = auth('user')->user();

            return redirect()->intended('admin/dashboard');
        }

        return redirect('admin/login')->withInput()->withErrors([
                    'error' => 'Invalid credentials.'
        ]);
    }

    public function dashboard(Request $request) {
        $data['title'] = 'Dashboard';
        return view("admin.layouts.dashboard", $data);
    }

    public function forgotAuth(Request $request) {
        $data['title'] = 'Forgot Password';
        return view("admin.auth.forgot-password", $data);
    }

    public function postForgot(Request $request) {

        $validator = Validator::make($request->all(), [
                    'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return Redirect::to("admin/forgot-auth")->withErrors($validator)->withInput();
        } else {

            $email = $request->email;
            //Query to DB
            $getId = User::where(array('email' => $email))->first(['id']);

            if ($getId) {

                //generate random number
                $verificationCode = rand(1111, 9999);

                $checkData = User::where(array('email' => $email))
                        ->update(array('verification_code' => $verificationCode));

                if ($checkData) {

                    //send email (verification code)
                    $data['email'] = $request->email;
                    $name = "Admin";
                    $code = $verificationCode;


                    Mail::send('emails.admin-forgot', ['code' => $code], function ($message) use($data) {
                        $message->to($data['email'], '')->subject('Verification Code!');
                    });

                    return redirect('admin/reset-auth')->withSuccess("We have sent you a verification code on your registered email id.");
                }
            } else {

                return Redirect::to("admin/forgot-auth")->withFail("This email id is not register.")->withInput();
            }
        }
    }

    public function resetAuth(Request $request) {

        $data['title'] = 'Reset Forgot Password';
        return view("admin.auth.reset-password", $data);
    }

    public function postResetAuth(Request $request) {

        $validator = Validator::make($request->all(), [
                    'verification_code' => 'required|max:4',
                    'password' => 'required|max:20|min:6',
                    'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {

            return Redirect::to("admin/reset-auth")->withErrors($validator);
        } else {

            $verificationCode = $request->verification_code;
            $newpassword = $request->password;

            //Update Data
            $updateData = array('password' => bcrypt($newpassword));

            //Query to DB
            $checkData = User::where(array('verification_code' => $verificationCode))
                    ->update($updateData);
            if ($checkData) {
                return Redirect::to("admin/login")->withSuccess("Password reset successfully,please login.");
            } else {
                return Redirect::to("admin/reset-auth")->withErrors("Please enter correct verification code");
            }
        }
    }

    public function profile() {
        $data['title'] = "Edit Profile";
        return view('admin.layouts.profile', $data);
    }

    public function postProfile(Request $request) {
        // dd($request->all());
        $id = auth()->user()->id;

        $v = Validator::make($request->all(), [
                    'name' => 'required',
                    'mobile_number' => 'required|unique:users,mobile_number,' . $id,
                    'email' => 'email|unique:users,email,' . $id,
        ]);

        if ($v->fails()) {
            return Redirect::to('admin/profile')->withErrors($v);
        } else {
            if (!empty($id)) {

                $update = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'mobile_number' => $request->mobile_number,
                    'updated_at' => date('Y-m-d H:i:s'),
                ];

                if ($files = $request->file('image')) {

                    if ($request->old_path) {
                        \File::delete('public/admin_profile/' . $request->old_path);
                    }
                    $destinationPath = 'public/admin_profile/'; // upload path
                    $profileImage = rand(11111, 99999) . $files->getClientOriginalName(); // getting image
                    $files->move($destinationPath, $profileImage);
                    $update['image'] = "$profileImage";
                }
                User::where(array('id' => $id))->update($update);
                return Redirect::to("admin/profile")->withSuccess('Great! info has been updated.');
            }
        }
    }

    public function postChangePassword(Request $request) {

        $requests = $request->only('password', 'new_password', 'confirm_password');

        $validator = Validator::make($request->all(), [
                    'password' => 'required',
                    'new_password' => 'required',
                    'confirm_password' => 'required|same:new_password',
        ]);

        if ($validator->fails()) {

            return redirect('admin/profile')->withErrors($validator);
        } else {

            //Variables
            $password = $request->get('password');
            $newPassword = bcrypt($request->get('new_password'));
            $confirmPassword = $request->get('confirm_password');
            $email = auth()->user()->email;
            //$userId = Session::get('adminUserId');

            $auth = auth()->guard('user');
            $credentials['password'] = $request->get('password');
            $credentials['email'] = $email;
            //Conditions
            $where = array('email' => $email);
            if (!$user = $auth->attempt($credentials)) {

                return Redirect::to("admin/profile")->withFail('Current password is wrong');
            } else {

                //Update
                $update = array('password' => $newPassword);

                //Query to DB
                $checkUpdate = User::where($where)->update($update);

                if ($checkUpdate) {
                    return Redirect::to("admin/profile")->withSuccess('Password changed successfully.');
                } else {

                    return Redirect::to("admin/profile")->withFail('Something went to wrong.');
                }
            }
        }
    }

    public function logout() {
        Auth::guard('user')->logout();
        return redirect('admin/login');
    }

}
