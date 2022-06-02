<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="page-title-box">
						<div class="page-title-right">
							<ol class="breadcrumb m-0">
								<li class="breadcrumb-item"><a href="javascript: void(0);">SIPT POS </a></li>
								<li class="breadcrumb-item active">Users</li>
							</ol>
						</div>
						<h4 class="page-title">Users</h4>
					</div>
				</div>
			</div> 
			<div class="row">
				<div class="col-12">
					<div class="card-box">
						<a href="?Halaman=_users&Aksi=form">
							<button type="button" class="btn btn-sm btn-blue waves-effect waves-light float-right"><i class="mdi mdi-plus-circle"> Add</i></button>
						</a>
						<h4 class="header-title">Data Users</h4>
						<p class="text-muted font-13 mb-4">
							Halaman ini berisi pengguna sistem
						</p>

						<table id="basic-datatable" class="table dt-responsive nowrap w-100">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama</th>
									<th>Kode Login</th>
									<th>Level</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								$Users = mysqli_query($conn,'select * from users as a join keterangan_login as b on b.id=a.id_keterangan_data join level as c on c.id_level=b.level_pengguna ');
								while($Data = mysqli_fetch_array($Users)){
									?>	
									<tr>
										<td><?=$no++;?></td>
										<td><?=$Data['nama_pengguna'];?></td>
										<td><?=$Data['kode_login'];?></td>
										<td><?=$Data['nama_level'];?></td>
										<td><?=$Data['aktif'] == 1 ? 'Aktif' : 'Tidak Aktif';?></td>
										<td>
											<?php if($Data['aktif'] == 1){
												?>
												<button type='button' id='<?=$Data['id_keterangan_data'];?>' deletename="2" class='btn btn-danger btn-rounded waves-effect waves-light'><span class='btn-label'><i class='mdi mdi-close-circle-outline'></i></span>Non Aktif
												</button>
											<?php }else{?>
												<button type='button' id='<?=$Data['id_keterangan_data'];?>' deletename="1" class='btn btn-success btn-rounded waves-effect waves-light'><span class='btn-label'><i class='mdi mdi-close-circle-outline'></i></span>Aktif
												</button>
											<?php }?>
											<a href="?Halaman=_users&Aksi=_info&Data=<?=$Data['id_keterangan_data'];?>">
												<button type="button" class="btn btn-warning btn-rounded waves-effect waves-light"><span class="btn-label"><i class="mdi mdi-alert-circle-outline"></i></span>Ubah
												</button>
											</a>

										</td>
									</tr>
								<?php }?>
							</tbody>
						</table>
					</div>
				</div>
			</div>    
		</div> 
	</div> 

	<script>
		$(document).ready(function(){
			$("#basic-datatable").DataTable({language:{paginate:{previous:"<i class='mdi mdi-chevron-left'>",next:"<i class='mdi mdi-chevron-right'>"}}
		});
			$('#basic-datatable').on('click','.btn-danger',function(){
				var id            = $(this).attr('id');
				var deletename          = $(this).attr('deletename');
				Swal.fire({
					title: 'Are you sure?',
					text: "Hapus Data ini",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes!'
				}).then(function(result){ 
					if (result.value) {
						$.ajax({
							type: 'POST',
							data: {id:id,deletename:deletename},
							url: '_users/_proses.php?Delete',
							dataType: "JSON",
							cache:"false",
							success: function(respone) {
								if (respone.status == 'success') {
									swal.fire({
										title: respone.status,
										text: respone.message,
										icon: respone.status
									}).then(function(){ 
										location.reload(true);
									}
									);
								}else{
									swal.fire({
										title: respone.status,
										text: respone.message,
										icon: respone.status
									}).then(function(){ 
										location.reload(true);
									}
									);
								}
							}
						})
					}

				})
			});

			$('#basic-datatable').on('click','.btn-success',function(){
				var id            = $(this).attr('id');
				var deletename          = $(this).attr('deletename');
				Swal.fire({
					title: 'Are you sure?',
					text: "Mengaktifkan Data ini",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes!'
				}).then(function(result){ 
					if (result.value) {
						$.ajax({
							type: 'POST',
							data: {id:id,deletename:deletename},
							url: '_users/_proses.php?Delete',
							dataType: "JSON",
							cache:"false",
							success: function(respone) {
								if (respone.status == 'success') {
									swal.fire({
										title: respone.status,
										text: respone.message,
										icon: respone.status
									}).then(function(){ 
										location.reload(true);
									}
									);
								}else{
									swal.fire({
										title: respone.status,
										text: respone.message,
										icon: respone.status
									}).then(function(){ 
										location.reload(true);
									}
									);
								}
							}
						})
					}

				})
			});
		});




	</script>
