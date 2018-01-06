@push('meta')
<!-- Meta Tag -->
 <meta name="_token" content="{{ csrf_token() }}">
@endpush 

@extends('layouts.default')

@section('content')

<div class="row" style="margin-top:15px;">

	<div class="col s8">

		<a class="waves-effect waves-light modal-trigger btn" href="#modal-tambah-akun">Buat Akun Baru</a>

		<table class="bordered highlight centered responsive-table">
        <thead>
          <tr>
          	  <th>No.</th>
              <th>Username</th>
              <th>Email</th>
              <th>Actions</th>
          </tr>
        </thead>

        <tbody>

        	@foreach($users as $user)

        		<tr>
        		<td>{{$loop->index+1}}</td>
        		<td>{{$user->username}}</td>
        		<td>{{$user->email}}</td>
        		<td>
        			<a class='dropdown-button btn' href='#' data-activates='dropdown-{{$user->id_user}}'>Actions</a>

        			<!-- Dropdown Structure -->
				  <ul id='dropdown-{{$user->id_user}}' class='dropdown-content'>
				    <li data-iduser="{{$user->id_user}}" class="li-edit"><a>Edit</a></li>
				    <li data-iduser="{{$user->id_user}}" class="li-hapus"><a>Hapus</a></li>
				    <li data-iduser="{{$user->id_user}}" class="li-gantisandi"><a>Ganti Sandi</a></li>
				  </ul>
        		</td>
        	</tr>

        	@endforeach

        	
          
        </tbody>
      </table>

	</div>

</div>



  <!-- Modal Structure -->
  <div id="modal-ganti-sandi" class="modal bottom-sheet">
    <div class="modal-content">

    	<div class="row">

    		<form col s12>

    		<input type="hidden" id="id_target_user">
    		 <div class="row">
		        <div class="input-field col s6">
		          <i class="material-icons prefix">vpn_key</i>
		          <input id="ganti-password" name="ganti-password" type="password" class="validate">
		          <label for="username">Password Baru</label>
		        </div>
		        <div class="input-field col s6">
		          <i class="material-icons prefix">vpn_key</i>
		          <input id="konfirmasi-ganti-password" type="password" class="validate">
		          <label for="password">Konfirmasi Password Baru</label>
		        </div>
		      </div>
		     </form>
    	</div>
     
    </div>
    <div class="modal-footer">
      <button class="modal-action modal-close waves-effect waves-red btn-flat">Batal</button>
    <button class="waves-effect waves-green btn-flat" id="btn-ganti-password">Ganti</button>
    </div>
  </div>

<!-- Modal Structure -->
  <div id="modal-tambah-akun" class="modal modal-fixed-footer">
    <div class="modal-content">

    	<div class="row">
		    <form class="col s12">
		      <div class="row">
		        <div class="input-field col s6">
		          <i class="material-icons prefix">account_circle</i>
		          <input id="username" name="username" type="text" class="validate">
		          <label for="username">Username</label>
		        </div>
		        <div class="input-field col s6">
		          <i class="material-icons prefix">vpn_key</i>
		          <input id="password" type="password" class="validate">
		          <label for="password">Password</label>
		        </div>
		      </div>

		      <div class="row">
		        <div class="input-field col s6">
		          <i class="material-icons prefix">vpn_key</i>
		          <input id="konfirmasi_password" name="konfirmasi_password" type="password" class="validate">
		          <label for="konfirmasi_password">Konfirmasi Password</label>
		        </div>

		        <div class="input-field col s6">
		          <i class="material-icons prefix">email</i>
		          <input id="email" name="email" type="text" class="validate">
		          <label for="email">Email</label>
		        </div>

		     
		      </div>

		      <div class="row">
		      	  <div class="input-field col s6">
				    <select id="jabatan" name="jabatan">
				      <option value="" disabled selected>Pilih Jabatan</option>
				      
				      @foreach($roles as $role)

				      	<option value="{{$role->id_role}}">{{$role->nama_role}}</option>

				      @endforeach

				    </select>
				    <label>Jabatan</label>
  				</div>
		      </div>

		    </form>
  		</div>
     
    </div>
    <div class="modal-footer">

    <button class="modal-action modal-close waves-effect waves-red btn-flat">Batal</button>
    <button class="waves-effect waves-green btn-flat" id="btn-simpan-akun-baru">Simpan</button>
    
    </div>
  </div>
 
 <!-- Modal Structure -->
  <div id="modal-edit-akun" class="modal modal-fixed-footer">
    <div class="modal-content">

    	<input type="hidden" name="edit_id_target_user" id="edit_id_target_user">

    	<div class="row">
		    <form class="col s12">
		      <div class="row">
		        <div class="input-field col s6">
		          <i class="material-icons prefix">account_circle</i>
		          <input id="edit-username" name="edit-username" type="text" class="validate">
		          <label for="edit-username">Username</label>
		        </div>
		       
		      </div>

		      <div class="row">
		     

		        <div class="input-field col s6">
		          <i class="material-icons prefix">email</i>
		          <input id="edit-email" name="edit-email" type="text" class="validate">
		          <label for="edit-email">Email</label>
		        </div>

		     
		      </div>

		      <div class="row">
		      	  <div class="input-field col s6">
				    <select id="edit-jabatan" name="edit-jabatan">
				      <option value="" disabled selected>Pilih Jabatan</option>
				      
				      @foreach($roles as $role)

				      	<option value="{{$role->id_role}}">{{$role->nama_role}}</option>

				      @endforeach

				    </select>
				    <label>Jabatan</label>
  				</div>
		      </div>

		    </form>
  		</div>
     
    </div>
    <div class="modal-footer">

    <button class="modal-action modal-close waves-effect waves-red btn-flat">Batal</button>
    <button class="waves-effect waves-green btn-flat" id="btn-edit-akun-baru">Simpan</button>
    
    </div>
  </div>

@stop

@push('scripts')
	
	<script type="text/javascript">
		
		$(document).ready(function () {
			// body...

			$('#btn-edit-akun-baru').click(function  () {
				// body...

				var id_target_user = $('#edit_id_target_user').val();

				var username = $('#edit-username').val();

				var email = $('#edit-email').val();

				var jabatan = $('#edit-jabatan').val();


				$.ajaxSetup({
			            headers: {
			                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			            }
        			});


        			$.ajax({
		               type:'POST',
		               url:'/akun_pengguna/update',
		               data:{

		               	'id_target_user':id_target_user,
		               	'username':username,
		               	'email':email,
		               	'jabatan':jabatan

		               },
		               success:function(data){
		                  if(data==1){
		                  	alert('Akun berhasil diupdate');

		                  	location.reload();
		                  }

		                  else{
		                  	alert('Akun tidak berhasil diupdate');
		                  }
		               }
            		});


			});

			$('#btn-ganti-password').click(function () {
				// body...
				var id_target_user = $('#id_target_user').val();

				var new_password = $('#ganti-password').val();

				var konfirmasi_new_password = $('#konfirmasi-ganti-password').val();

				if(new_password==konfirmasi_new_password){

					$.ajaxSetup({
			            headers: {
			                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			            }
        			});

        			$.ajax({
		               type:'POST',
		               url:'/akun_pengguna/ganti_sandi',
		               data:{

		               	'id_target_user':id_target_user,
		               	'new_password':new_password

		               },
		               success:function(data){
		                  if(data==1){
		                  	alert('Password berhasil diganti');

		                  	location.reload();
		                  }

		                  else{
		                  	alert('Password tidak berhasil diganti');
		                  }
		               }
            		});

				}

				else{
					alert("Password tidak sama");
				}

			});
			$('.li-edit').click(function  () {
				// body...

				var id_target_user = $(this).data('iduser');

				$.ajaxSetup({
			            headers: {
			                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			            }
        			});

				$.ajax({
		               type:'POST',
		               url:'/akun_pengguna/get_user_by_id',
		               data:{

		               	'id_target_user':id_target_user

		               },
		               success:function(data){
		                  
		                  var user = data[0];

		                  $('#edit_id_target_user').val(user.id_user);

		                  $('#edit-username').val(user.username);

		                  $('#edit-email').val(user.email);

		                  $('#edit-jabatan').val(user.id_role);

		                  //update form field

		                   $('select').material_select();

		                   Materialize.updateTextFields();

		                  $('#modal-edit-akun').modal('open');		                  

		               }
            		});

			});

			$('.li-gantisandi').click(function  () {
				// body...
				var id_target_user = $(this).data('iduser');

				$('#id_target_user').val(id_target_user);

				$('#modal-ganti-sandi').modal('open');
			});

			$('.li-hapus').click(function () {
				// body...
				var id_user = $(this).data('iduser');

				$.ajaxSetup({
			            headers: {
			                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			            }
        			});

				$.ajax({
		               type:'POST',
		               url:'/akun_pengguna/hapus',
		               data:{

		               	'id_user':id_user

		               },
		               success:function(data){
		                  if(data==1){
		                  	alert('Akun Berhasil dihapus');

		                  	location.reload();
		                  }

		                  else{
		                  	alert('Akun tidak berhasil dihapus');
		                  }
		               }
            		});

			});

			$('#btn-simpan-akun-baru').click(function  () {
			// body...

				var username = $('#username').val();

				var password = $('#password').val();

				var email = $('#email').val();

				var konfirmasi_password = $('#konfirmasi_password').val();

				var id_role = $('#jabatan').val();

				if(password==konfirmasi_password){
					
					$.ajaxSetup({
			            headers: {
			                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			            }
        			});

					$.ajax({
		               type:'POST',
		               url:'/akun_pengguna/simpan',
		               data:{

		               	'username':username,
		               	'role':id_role,
		               	'email':email,
		               	'password':password

		               },
		               success:function(data){
		                  if(data==1){
		                  	alert('Akun Berhasil dibuat');

		                  	location.reload();
		                  }

		                  else{
		                  	alert('Akun tidak berhasil dibuat');
		                  }
		               }
            		});

				}

				else{
					alert('Password tidak sama');
				}

			});

		});
	</script>

@endpush	