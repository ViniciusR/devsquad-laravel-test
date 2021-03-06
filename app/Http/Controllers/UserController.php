<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\User;


class UserController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function myaccount() 
    {
    	$user = Auth::user();

        return view('user.myaccount', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    	if (Auth::user()->id != $id) {
    		return redirect()
                ->back()
                ->withErrors('Wrong user.')
                ->withInput();
    	}

        $user = User::find($id);
        $request_data = $request->all();
        
        $validator = $this->validator($request_data);

    	if ($validator->fails()) {
    		return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
    	}

        if (empty($request->password)) {
        	unset($request_data['password']);
        } else {
        	$request_data['password'] = Hash::make($request->password);
        }

        if ($user->update($request_data)) {
            return redirect()
                ->route('myaccount')
                ->with('success', 'Account updated successfully!');
        } else {
            return redirect()
                ->back()
                ->withErrors('Something went wrong.')
                ->withInput();
        }
    }

    /**
     * Get a validator for an incoming request for updating profile.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'. Auth::user()->id,
            'password' => 'sometimes|nullable|min:6|confirmed',
            'password_confirmation' => 'sometimes|required_with:password|same:password',
            'city' => 'required|string',
            'state' => 'required|string',
            'postal_code' => 'required|string',
            'address' => 'required|string',
            'number' => 'required|numeric',
            'district' => 'required|string',
        ]);
    }
}
