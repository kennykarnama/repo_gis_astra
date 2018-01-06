<?php

namespace App\Http\Controllers\myapi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Arho;

class ArhoController extends Controller
{
    //

	public function fetch_list_arho(Request $request)
	{
		# code...
		$query = Arho::where('arho.is_aktif','=',1)->get();

		return response()->json($query);
	}

}
