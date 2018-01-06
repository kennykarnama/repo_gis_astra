<?php

namespace App\Http\Controllers\master_data;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\models\User;
use App\models\Role;

class AkunPenggunaController extends Controller
{
    //

    public function __construct()
    {
    	# code...
    	$this->middleware('auth:admin');

    }
    public function indexHome(){

    	$users = $this->fetchUsers();

    	$roles = $this->fetchRoles();

    	return view('pages/akun_pengguna',
    		[

    			'users'=>$users,
    			'roles'=>$roles

    		]

    		);
    }

    public function get_user_by_id(Request $request)
    {
        # code...
        $id_target_user = $request['id_target_user'];

        $query = User::where('users.id_user','=',$id_target_user)
                       ->get();


        return response()->json($query); 
    }

    public function update_akun(Request $request)
    {
        # code...
        $id_target_user = $request['id_target_user'];

        $username = $request['username'];

        $email = $request['email'];

        $id_role = $request['jabatan'];

        $query = User::where('users.id_user','=',$id_target_user)
                       ->update(

                        [

                            'username'=>$username,
                            'email'=>$email,
                            'id_role'=>$id_role

                            ]

                        );
        if($query){
            return 1;
        }

        else{
            return 0;
        }
    }

    public function change_password(Request $request){

        $new_password = $request['new_password'];
        $id_user = $request['id_target_user'];

        $query = User::where('users.id_user','=',$id_user)
                       ->update(['password'=>bcrypt($new_password)]);

        if($query){
            return 1;
        }
        else{
            return 0;
        }
    }

    public function softdelete_akun(Request $request)
    {
    	# code...
    	$id_user = $request['id_user'];

    	$query = User::where('id_user','=',$id_user)
    					->update(['is_aktif'=>0]);

    	if($query){
    		return 1;
    	}
    	else{
    		return 0;
    	}
    }

    public function create_akun(Request $request){

    	$username = $request['username'];

    	$password = $request['password'];

    	$email = $request['email'];

    	$id_role = $request['role'];

    	$user = new User;

    	$user->username = $username;

    	$user->password = bcrypt($password);

    	$user->email = $email;

    	$user->id_role = $id_role;

    	$query = $user->save();

    	if($query){
    		return 1;
    	}

    	else{
    		return 0;
    	}

    }

    private function fetchUsers(){

    	$id_user = Auth::user()->id_user;

    	$query = User::where('users.id_user','!=',$id_user)
    			->where('users.is_aktif','=',1)
    			->get();

    	return $query;

    }

    private function fetchRoles(){

    	$query = Role::all();

    	return $query;

    }
}
