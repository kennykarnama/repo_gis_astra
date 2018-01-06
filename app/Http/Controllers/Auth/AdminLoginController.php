<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AdminLoginController extends Controller
{
    //

    public function __construct(){
    	$this->middleware('guest:admin');
    }

    public function showLoginForm()
    {
    	# code...
    	return view('auth.login-gisastra');
    }

    public function login(Request $request)
    {
    	# code...
    	$USERNAME =  $request->username;

    	$password = $request->password;

    	$this->validate($request,
    		
    		['username'=>'required',
    		'password'=>'required'
    		]

    		);

    	// check in database using auth attemp

    	$valid = Auth::guard('admin')->attempt(['username'=>$USERNAME,'password'=>$password]);

    	if($valid){

    		
    		
    		return redirect()->intended(route('admin.dashboard'));
    	
    	}

    	else{
    		return redirect()->back()->withInput($request->only('username'));
    	}

    }


}
