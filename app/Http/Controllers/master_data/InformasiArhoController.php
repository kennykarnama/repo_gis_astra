<?php

namespace App\Http\Controllers\master_data;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\models\Arho;
use App\models\Kecamatan;
use App\models\Kelurahan;
use App\models\PenugasanArho;
use DB;

class InformasiArhoController extends Controller
{
    //

    public function __construct(){
    	$this->middleware('auth:admin');
    }

    public function indexHome()
    {
    	# code...
    	$list_arho = $this->fetchListArho();

        $susunan_penugasan = $this->fetchSusunanPenugasan();

        $list_kecamatan = $this->fetchKecamatan();

        $list_kelurahan = $this->fetchKelurahan();

        //dd($susunan_penugasan);

    	return view('pages/informasi_arho',
    		[
    			'list_arho'=>$list_arho,
                'susunan_penugasan'=>$susunan_penugasan,
                'list_kelurahan'=>$list_kelurahan,
                'list_kecamatan'=>$list_kecamatan
    		]
    		);
    }

    public function create_penugasan_arho(Request $request)
    {
        # code...
        $tgl_input = $request['tgl_input'];

        $id_arho = $request['id_arho'];

        $kecamatan = $request['kecamatan'];

        $kelurahan = $request['kelurahan'];

        // $arr_kelurahan = explode(",", $kelurahan);

        $time = strtotime('10/16/2003');

        $newformat = date('Y-m-d',$time);

        $hitung = 0;

        for($i=0;$i < count($kelurahan);$i++){
        $penugasan_arho = new PenugasanArho;

        $penugasan_arho->tgl_input = $newformat;

        $penugasan_arho->id_arho = $id_arho;

        $penugasan_arho->id_kelurahan = $kelurahan[$i];

          $query = $penugasan_arho->save();

          if($query){
            $hitung++;
          }
        }

        

      

        if($hitung==count($kelurahan)){
            return 1;
        }
        else{
            return 0;
        }
    }

    public function create_arho(Request $request)
    {
        # code...
        $nama_lengkap = $request['nama_lengkap'];

        $nama_panggilan = $request['nama_panggilan'];

        $avatar_path = $request['avatar_path'];

        if(is_null($avatar_path)){
            $avatar_path = "";
        }

        $arho = new Arho;

        $arho->nama_lengkap = $nama_lengkap;

        $arho->nama_panggilan = $nama_panggilan;

        $arho->avatar = $avatar_path;

        $query = $arho->save();

        if($query){
            return 1;
        }

        else{
            return 0;
        }
    }

    public function softdelete_arho(Request $request)
    {
        # code...
        $id_arho = $request['id_arho'];

        $query = Arho::where('arho.id_arho','=',$id_arho)
                       ->update(['arho.is_aktif'=>0]);

        if($query){
            return 1;
        }
        else{
            return 0;
        }
    }

    public function update_arho(Request $request)
    {
        # code...
        $id_arho = $request['id_arho'];

        $nama_lengkap = $request['nama_lengkap'];

        $nama_panggilan = $request['nama_panggilan'];

        $avatar_path = $request['avatar_path'];

        if(is_null($avatar_path)){
            $avatar_path = "";
        }

        $query = Arho::where('arho.id_arho','=',$id_arho)
                       ->update(

                        [
                            'nama_lengkap'=>$nama_lengkap,
                            'nama_panggilan'=>$nama_panggilan,
                            'avatar'=>$avatar_path
                        ]
                        );

        if($query){
            return 1;
        }
        else{
            return 0;
        }
    }

    public function get_arho_by_id(Request $request)
    {
        # code...
        $id_arho = $request['id_arho'];

        $query = Arho::where('arho.id_arho','=',$id_arho)->get();

        return response()->json($query);
    }

    public function get_kelurahan_by_kecamatan(Request $request)
    {
        # code...
        $id_kecamatan = $request['id_kecamatan'];

        $query = Kelurahan::where('kelurahan.id_kecamatan','=',$id_kecamatan)->get();

        return response()->json($query);
    }

    public function get_info_penugasan_by_id_kelurahan(Request $request)
    {
        # code...
        $id_kelurahan = $request['id_kelurahan'];

        $query = $this->fetchPenugasanArhoByIdKelurahan($id_kelurahan);

        return response()->json($query);


    }

    private function fetchSusunanPenugasan(){
        $list_kecamatan = $this->fetchKecamatan();

        $list_kelurahan = $this->fetchKelurahan();

        $list_penugasan = $this->fetchPenugasanArho();

        $susunan_penugasan = array();

        foreach ($list_kecamatan as $kecamatan) {
            # code...
            
            $root = array(
                'id_kecamatan'=>$kecamatan->id_kecamatan,
                'nama_kecamatan'=>$kecamatan->nama_kecamatan
                );

            $child = array();

            foreach ($list_kelurahan as $kelurahan) {
                # code...
                if($kelurahan->id_kecamatan == $kecamatan->id_kecamatan){

                      $child_child = array();

                    foreach ($list_penugasan as $penugasan) {
                        # code...

                      

                        if($penugasan->id_kelurahan == $kelurahan->id_kelurahan){

                            $tmp_child = array(
                                    'id_penugasan_arho'=>$penugasan->id_penugasan_arho,
                                    'id_arho'=>$penugasan->id_arho,
                                    'nama_arho'=>$penugasan->nama_lengkap

                                );

                            array_push($child_child, $tmp_child);

                        }
                    }
                    
                    $tmp = array(
                        'id_kelurahan'=>$kelurahan->id_kelurahan,
                        'nama_kelurahan'=>$kelurahan->nama_kelurahan
                        );

                    if(count($child_child)>0){
                        
                        $tmp['penugasan'] = $child_child;
                        
                        array_push($child, $tmp);    

                    }

                    
                
                }
            }

            if(count($child)>0){
                $root['kelurahan'] = $child; 

                array_push($susunan_penugasan, $root);
            }

        }

        return $susunan_penugasan;
    }

    private function fetchKelurahan(){
        $query = Kelurahan::where('kelurahan.is_aktif','=',1)->get();

        return $query;
    }

    private function fetchKecamatan(){
        $query = Kecamatan::where('kecamatan.is_aktif','=',1)->get();

        return $query;
    }

    private function fetchListArho(){
    	
    	$query = Arho::where('arho.is_aktif','=',1)->get();

    	return $query;
    }

    private function fetchPenugasanArho(){
       $query = DB::table('penugasan_arho')
                    ->join('arho','arho.id_arho','=','penugasan_arho.id_arho')
                    ->join('kelurahan','kelurahan.id_kelurahan','=','penugasan_arho.id_kelurahan')
                    ->join('kecamatan','kecamatan.id_kecamatan','=','kelurahan.id_kecamatan')
                    ->where('penugasan_arho.is_aktif','=',1)
                    ->get();

        return $query;
    }

    private function fetchPenugasanArhoByIdKelurahan($id_kelurahan){
        $query = DB::table('penugasan_arho')
                    ->join('arho','arho.id_arho','=','penugasan_arho.id_arho')
                    ->join('kelurahan','kelurahan.id_kelurahan','=','penugasan_arho.id_kelurahan')
                    ->join('kecamatan','kecamatan.id_kecamatan','=','kelurahan.id_kecamatan')
                    ->where('penugasan_arho.is_aktif','=',1)
                    ->where('penugasan_arho.id_kelurahan','=',$id_kelurahan)
                    ->get();

        return $query;
    }
}
