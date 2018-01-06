@extends('layouts.default')

@section('content')

<div class="row">

	<ul id="tabs-swipe-demo" class="tabs">
    <li class="tab col s3"><a href="#arho-swipe">Arho</a></li>
    <li class="tab col s3"><a href="#penugasan-swipe">Penugasan</a></li>
    
  	</ul>


	  
	  <div id="arho-swipe" class="col s12" style="margin-top:15px;">

	  	<a class="waves-effect waves-light modal-trigger btn" href="#modal-tambah-arho">Tambah Arho</a>

	  	<table class="bordered highlight centered responsive-table">
        <thead>
          <tr>
          	  <th>No.</th>
          	  <th>Avatar</th>
              <th>Nama Lengkap</th>
              <th>Nama Panggilan</th>
              <th>Actions</th>
          </tr>
        </thead>

        <tbody>

        	@foreach($list_arho as $arho)

        		<tr>
        			<td>{{$loop->index+1}}</td>

        			@if(strlen($arho->avatar)==0)
        			<td>
        				<img class="responsive-img" src="{{url('/images/worker.png')}}" style="width:80px;">
        			</td>
        			@endif

        			@if(strlen($arho->avatar)>0)
        				<td>
        				<img class="responsive-img" src="{{$arho->avatar}}">
        			</td>
        			@endif
        			<td>{{$arho->nama_lengkap}}</td>
        			<td>{{$arho->nama_panggilan}}</td>
        			<td>
        				<a class='dropdown-button btn' href='#' data-activates='dropdown-arho-{{$arho->id_arho}}'>Actions</a>

        			<!-- Dropdown Structure -->
						  <ul id='dropdown-arho-{{$arho->id_arho}}' class='dropdown-content'>
						    <li data-idarho="{{$arho->id_arho}}" class="li-arho-edit"><a>Edit</a></li>
						    <li data-idarho="{{$arho->id_arho}}" class="li-arho-hapus"><a>Hapus</a></li>
						  </ul>
        			</td>
        		</tr>

        	@endforeach
        </tbody>

      </table>

	  </div>
	  
	  <div id="penugasan-swipe" class="col s12" style="margin-top:15px;">

      <a class="waves-effect waves-light modal-trigger btn" href="#modal-tambah-penugasan-arho">Tambah Penugasan Arho</a>



      @for($i = 0; $i < count($susunan_penugasan); $i++)

        <?php
            $kelurahan = $susunan_penugasan[$i]['kelurahan'];
        ?>

        <ul class="collapsible" data-collapsible="expandable">
            <li>

              <div class="collapsible-header">Kecamatan {{$susunan_penugasan[$i]['nama_kecamatan']}}
                
                <!-- <a style="margin-left:20px;"class="waves-effect waves-light modal-trigger btn" href="#modal-kelola-penugasan-arho">Kelola Penugasan Arho</a> -->
                
              </div>
              <div class="collapsible-body">



                @for($j=0; $j < count($kelurahan); $j++)

              

                  <?php
                    
                    $penugasan = $kelurahan[$j]['penugasan'];


                  ?>

                

                  <ul class="collapsible" data-collapsible="expandble">

                    <li>
                      <div class="collapsible-header" style="text-align:left;">
                        
                        <div class="row">
                            <div class="col s8">
                             
                              Kelurahan {{$kelurahan[$j]['nama_kelurahan']}}
                              
                            </div>

                            <div class="col s4">
                              
                                <a class="waves-effect waves-light btn red btn-edit-penugasan"
                                data-idkelurahan="{{$kelurahan[$j]['id_kelurahan']}}"
                                >Edit</a>
                            </div>
                        </div>
                        

                        </div>
                      
                      <div class="collapsible-body">

                        <p><b>Daftar Arho</b></p>

                         <ul class="collection">

                           @for($k = 0; $k < count($penugasan);  $k++)
                            <li class="collection-item">{{$penugasan[$k]['nama_arho']}}</li>
                          @endfor
                           
                        </ul>

                        
                         
                      </div>
                    </li>

                  </ul>

                  

                @endfor

              </div>
            </li>
        </ul>

      @endfor
      
  

	  </div>
  

</div>

<!-- Modal Structure -->
  <div id="modal-edit-penugasan-arho" class="modal">
    <div class="modal-content">
      
      <form class="col-12">

        <div class="row">

          <input type="hidden" id="id_kelurahan_penugasan" name="id_kelurahan_penugasan">


           <div class="input-field col s4">
            <input placeholder="ID Kelurahan" id="id_edit_kelurahan_penugasan" type="text" class="validate">
            <label for="id_edit_kelurahan_penugasan">ID Kelurahan</label>
          </div>

          <div class="input-field col s8">
            <input placeholder="Nama Kelurahan" id="nama_kelurahan_penugasan" type="text" class="validate">
            <label for="nama_kecamatan">Nama Kelurahan</label>
          </div>

          <div class="input-field col s12">
            <select multiple id="edit_pilih_arho">
            
              
            </select>
            <label>Arho</label>
          </div>


        </div>

      </form>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn red">Batal</a>
      <a href="#!" class="waves-effect waves-green btn green" id="btn-simpan-edit-penugasan">Simpan</a>
    </div>
  </div>

<!-- Modal Structure -->
  <div id="modal-edit-arho" class="modal">
    <div class="modal-content">
          
          <div class="row">
            <form class="col s12">

              <input type="hidden" name="edit_id_arho" id="edit_id_arho">
              <div class="row">
                <div class="input-field col s6">
                  <i class="material-icons prefix">account_circle</i>
                  <input id="edit_nama_lengkap" name="edit_nama_lengkap" type="text" class="validate">
                  <label for="edit_nama_lengkap">Nama Lengkap</label>
                </div>
                <div class="input-field col s6">
                  <i class="material-icons prefix">account_circle</i>
                  <input id="edit_nama_panggilan" type="text" class="validate">
                  <label for="edit_nama_panggilan">Nama Panggilan</label>
                </div>
            </div>

            <div class="row">

              <div class="input-field col s6">
                <i class="material-icons prefix">insert_drive_file</i>
                <input id="edit_avatar_path" name="avatar_path" type="text" class="validate">
                <label for="edit_avatar_path">Avatar</label>
              </div>

              <button type="button" class="waves-effect waves-red btn-flat">Browse...</button>

            </div>



            </form>
          </div>

    </div>
    <div class="modal-footer">
  <button class="modal-action modal-close waves-effect waves-red btn-flat">Batal</button>
  <button class="waves-effect waves-green btn-flat" id="btn-edit-arho">Simpan</button>
    
    </div>
  </div>

<!-- Modal Structure -->
  <div id="modal-tambah-penugasan-arho" class="modal">
    <div class="modal-content">
      <div class="row">
        <form class="col s12">

          <div class="input-field col s12">
              <input type="text" class="datepicker" id="tgl_input">
              <label>Tanggal Input</label>
          </div>

          <div class="input-field col s12">
              <select id="arho" name="arho">
                <option value="" disabled selected>Pilih Arho</option>
                @foreach($list_arho as $arho)
                  <option value="{{$arho->id_arho}}">{{$arho->nama_lengkap}}</option>
                @endforeach
              </select>
              <label>Arho</label>
          </div>

          <div class="input-field col s12">
            <select id="kecamatan" nama="kecamatan">
              <option value="" disabled selected>Pilih Kecamatan</option>
              @foreach($list_kecamatan as $kecamatan)
                <option value="{{$kecamatan->id_kecamatan}}">{{$kecamatan->nama_kecamatan}}</option>
              @endforeach
            </select>
           <label>Kecamatan</label>
          </div>

          <div class="input-field col s12">
            <select multiple id="kelurahan" nama="kelurahan">
              <option value="" disabled selected>Pilih Kelurahan</option>
             
            </select>
           <label>Kelurahan</label>
          </div>

        </form>
      </div>
    </div>
    <div class="modal-footer">
     <button class="modal-action modal-close waves-effect waves-red btn-flat">Batal</button>
    <button class="waves-effect waves-green btn-flat" id="btn-tambah-penugasan-arho">Simpan</button>
    </div>
  </div>

<!-- Modal Structure -->
  <div id="modal-tambah-arho" class="modal">
    <div class="modal-content">
          
          <div class="row">
            <form class="col s12">

              <div class="row">
                <div class="input-field col s6">
                  <i class="material-icons prefix">account_circle</i>
                  <input id="nama_lengkap" name="nama_lengkap" type="text" class="validate">
                  <label for="nama_lengkap">Nama Lengkap</label>
                </div>
                <div class="input-field col s6">
                  <i class="material-icons prefix">account_circle</i>
                  <input id="nama_panggilan" type="text" class="validate">
                  <label for="nama_panggilan">Nama Panggilan</label>
                </div>
            </div>

            <div class="row">

              <div class="input-field col s6">
                <i class="material-icons prefix">insert_drive_file</i>
                <input id="avatar_path" name="avatar_path" type="text" class="validate">
                <label for="avatar_path">Avatar</label>
              </div>

              <button type="button" class="waves-effect waves-red btn-flat">Browse...</button>

            </div>



            </form>
          </div>

    </div>
    <div class="modal-footer">
  <button class="modal-action modal-close waves-effect waves-red btn-flat">Batal</button>
  <button class="waves-effect waves-green btn-flat" id="btn-tambah-arho-baru">Simpan</button>
    
    </div>
  </div>


@stop

@push('scripts')

<script type="text/javascript">
  $(document).ready(function () {
    // body..

    $('.btn-edit-penugasan').click(function () {
      // body...
      var id_kelurahan = $(this).data('idkelurahan');

      $('#id_kelurahan_penugasan').val(id_kelurahan);

       $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });

        $.ajax({
                   type:'POST',
                   url:'/informasi_arho/get_info_penugasan',
                   data:{

                    'id_kelurahan':id_kelurahan

                   },
                   success:function(data){
                      
                     var info_penugasan_kelurahan = data;

                     $.ajaxSetup({
                        headers: {
                             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          }
                      });

                      $.ajax({
                   type:'POST',
                   url:'/arho/fetch_list_arho',
                   data:{

                   },
                   success:function(data){
                      
                    $('#id_edit_kelurahan_penugasan').val(info_penugasan_kelurahan[0].id_kelurahan);

                     $('#nama_kelurahan_penugasan').val(info_penugasan_kelurahan[0].nama_kelurahan);

                     $('#edit_pilih_arho').empty();

                      var select_var = "<option disabled selected>Pilih Arho</option>";

                      $('#edit_pilih_arho').append(select_var);

                      var arr_id_arho = [];

                     for(var i=0;i<data.length;i++){
                      
                      var arho = data[i];

                      select_var = "<option value='"+arho.id_arho+"'>"+arho.nama_lengkap+"</option>";

                      arr_id_arho.push(arho.id_arho);

                      $('#edit_pilih_arho').append(select_var);

                     }

                 
                     $('#edit_pilih_arho').val(arr_id_arho);

                     $('select').material_select();

               
                       

                     $('#modal-edit-penugasan-arho').modal('open');

                   }
                });

                     

                   }
                });


      

     
    });
    $('#btn-tambah-penugasan-arho').click(function() {
      // body...
      var tgl_input = $('#tgl_input').val();

      var id_arho = $('#arho').val();

      var kecamatan = $('#kecamatan').val();

      var kelurahan = $('#kelurahan').val();




      $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });


      $.ajax({
                   type:'POST',
                   url:'/informasi_arho/simpan_penugasan',
                   data:{

                   'tgl_input':tgl_input,
                   'id_arho':id_arho,
                   'kecamatan':kecamatan,
                   'kelurahan':kelurahan


                   },
                   success:function(data){
                      
                      if(data==1){
                        alert('Penugasan arho berhasil ditambahkan');

                        location.reload();
                      }

                      else{
                        alert("penugasan arho tidak berhasil ditambahkan");
                      }

                   }
                });

      
    
    });
    $('#kecamatan').on('change',function  () {
      // body...
        var id_kecamatan = $('#kecamatan').val();

        $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });

        $.ajax({
                   type:'POST',
                   url:'/informasi_arho/get_kelurahan_by_kecamatan',
                   data:{

                   'id_kecamatan':id_kecamatan


                   },
                   success:function(data){
                      
                      for(var i=0;i<data.length;i++){

                        var kelurahan = data[i];

                        var str = "<option value='"+kelurahan.id_kelurahan+"'>"+data.nama_kelurahan+"</option>";

                        $('#kelurahan').append($('<option>', {
                            value: kelurahan.id_kelurahan,
                            text: kelurahan.nama_kelurahan
}                       ));

                      }

                      $('select').material_select();

                   }
                });

        
    });
    $('#btn-edit-arho').click(function () {
      // body...

      var id_arho = $('#edit_id_arho').val();

      var nama_lengkap = $('#edit_nama_lengkap').val();

      var nama_panggilan = $('#edit_nama_panggilan').val();

      var avatar_path = $('#edit_avatar_path').val();

      $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });

      $.ajax({
                   type:'POST',
                   url:'/informasi_arho/update',
                   data:{

                    'id_arho':id_arho,
                    'nama_lengkap':nama_lengkap,
                    'nama_panggilan':nama_panggilan,
                    'avatar_path':avatar_path


                   },
                   success:function(data){
                      
                      if(data==1){
                        
                        alert('Arho berhasil diupdate');

                        location.reload();

                      }

                      else{
                        alert('Arho tidak berhasil diedit');
                      }

                   }
                });
  
    });

    $('.li-arho-edit').click(function () {
      // body...
        var id_arho = $(this).data('idarho');

        $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });

        $.ajax({
                   type:'POST',
                   url:'/informasi_arho/get_arho_by_id',
                   data:{

                    'id_arho':id_arho


                   },
                   success:function(data){
                      
                      data = data[0];

                      $('#edit_id_arho').val(data.id_arho);

                      $('#edit_nama_lengkap').val(data.nama_lengkap);

                      $('#edit_nama_panggilan').val(data.nama_panggilan);

                       Materialize.updateTextFields();

                      $('#modal-edit-arho').modal('open');

                   }
                });

    });

    $('.li-arho-hapus').click(function () {
      // body...
      var id_arho = $(this).data('idarho');

        $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });

         $.ajax({
                   type:'POST',
                   url:'/informasi_arho/hapus',
                   data:{

                    'id_arho':id_arho


                   },
                   success:function(data){
                      if(data==1){
                        alert('Arho berhasil dihapus');

                        location.reload();
                      }

                      else{
                        alert('Akun tidak berhasil dihapus');
                      }
                   }
                });


    });

      $('#btn-tambah-arho-baru').click(function () {
        // body...

        var nama_lengkap = $('#nama_lengkap').val();

        var nama_panggilan = $('#nama_panggilan').val();

        var avatar_path = "";

        $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });

        $.ajax({
                   type:'POST',
                   url:'/informasi_arho/simpan',
                   data:{

                   'nama_lengkap':nama_lengkap,
                   'nama_panggilan':nama_panggilan,
                   'avatar_path':avatar_path

                   },
                   success:function(data){
                      if(data==1){
                        alert('Arho berhasil ditambahkan');

                        location.reload();
                      }

                      else{
                        alert('Akun tidak berhasil ditambahkan');
                      }
                   }
                });

      });

  });
</script>

@endpush