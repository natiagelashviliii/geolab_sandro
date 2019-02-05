<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$user = Auth::user();

    	$User = DB::table('users')->where('id', $user->id)->first();

        return view('admin.user.index', ['Data' => $User]);
    }

    public function edit(Request $request){
    	$this->validate($request, [
    		'Email' => 'required',
    		'Name'  => 'required',
    	]);

    	$user = Auth::user();
    
	    $user->name = $request->input('Name');
	    $user->email = $request->input('Email');
    	$user->save();

    	return redirect()->route('admin.user.index');
    }

    public function changePassword(Request $request) {

    	$messages = '';
    	$status = 1;

    	$user = Auth::user();

    	if (!Hash::check($request->input('OldPassword'), $user->password)) {
    		$messages = "Old Password is incorrect";
    		$status = 0;
    	} else {
    		if ($request->input('NewPassword') != $request->input('RepeatPassword')) {
    			$messages = "Passwords Doesn't match";
    			$status = 0;
    		} else {
    			$user->password = Hash::make($request->input('NewPassword'));
    			if ($user->save()) {
	    			$messages = 'Password was changed';	
	    			$status = 1;	
    			} else {
    				$messages = 'Something went wront, try again later';	
	    			$status = 0;
    			}
    		}
    	}

    	return view('admin.user.index', ['messages' => $messages, 'status' => $status, 'Data' => $user]);
    }
}
