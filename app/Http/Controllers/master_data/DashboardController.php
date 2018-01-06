<?php

namespace App\Http\Controllers\master_data;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    //

    public function __construct()
    {
    	# code...
    	$this->middleware('auth:admin');
    }

    public function indexHome(){

    	

    	return view('pages/home');
    }

}
