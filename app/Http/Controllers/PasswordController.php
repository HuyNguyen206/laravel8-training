<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PasswordController extends Controller
{
    public function edit()
    {
        return view('admin.change_password');
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $validator = Validator::make($request->all(),[
            'old_password' => 'required',
            'password' => 'required|confirmed'
        ]);
        $user = Auth::user();
        $validator->after(function($validator) use($request, $user){
            if(!Hash::check($request->old_password, $user->password))
            {
               $validator->errors()->add('old_password', 'The old password is incorrect');
            }
        });
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }
        else
        {
            $user->fill([
                'password' => Hash::make($request->password)
            ]);
            $user->save();
            return redirect()->back()->with('success', 'Your password has been update successfully!');
        }
    }

    public function getProfile()
    {
        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }

    public function updateP(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
        ]);
        $user = Auth::user();
        $user->name = $request->name;
        $user->save();
        $notification = [
            'alert-type' => 'success',
            'message' => 'Your profile has been update successfully!'
        ];
        return redirect()->back()->with($notification);

    }
}
