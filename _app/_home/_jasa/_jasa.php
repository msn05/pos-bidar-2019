<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="page-title-box">
						<div class="page-title-right">
							<ol class="breadcrumb m-0">
								<li class="breadcrumb-item"><a href="javascript: void(0);">SIPT POS </a></li>
								<li class="breadcrumb-item"><a href="javascript:void(0);">Jasa</a></li>
								<li class="breadcrumb-item active">Daftar Jasa</li>
							</ol>
						</div>
						<h4 class="page-title">Daftar Jasa</h4>
					</div>
				</div>
			</div> 
			<div class="row">
				<div class="col-12">
					<div class="card-box">
						<a href="?Halaman=_jasa&Aksi=form">
							<button type="button" class="btn btn-sm btn-blue waves-effect waves-light float-right"><i class="mdi mdi-plus-circle"> Add</i></button>
						</a>
						<h4 class="header-title">Data Jasa Perusahaan</h4>
						<p class="text-muted font-13 mb-4">
							Halaman ini berisi data jasa perusahaan dalam sistem
						</p>

						<table id="basic-datatable" class="table dt-responsive nowrap w-100">
							<thead>
								<tr>
									<th>No</th>
									<th>Kode Jasa</th>
									<th>Nama Jasa</th>
									<th>Tanggal Dibuat</th>
									<th>Total Keterangan Tarif</th>
									<th>Nama Pembuat Jasa</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								$Jasa = mysqli_query($conn,'select * from jasa where aktif=1 ');
								while($Data = mysqli_fetch_array($Jasa)){
									$Users = mysqli_fetch_array(mysqli_query($conn,"select * from keterangan_login where id='".$Data['id_users']."'"));
									$Total = mysqli_fetch_array(mysqli_query($conn,"select *,count(id) as Total from ketentuan_jasa where kode_jasa='".$Data['id']."'"));
									?>	
									<tr>
										<td><?=$no++;?></td>
										<td><?=$Data['kode_jasa'];?></td>
										<td><?=$Data['nama_jasa'];?></td>
										<td><?=$Data['tanggal_dibuat'];?></td>
										<td>
											<?php if($Total['Total'] != 0){?>
												<a href="?Halaman=_keterangan_tarif&Data=<?=$Data['id'];?>"><?=$Total['Total'];?></a>
											<?php }else{?>
												<a href="?Halaman=_ketentuan_jasa&Aksi=form&Data=<?=$Data['id'];?>"><?=$Total['Total'];?></a>
											<?php }?>
										</td>
										<td><?=$Users['nama_pengguna'];?></td>
										<td>
											<!--<button type="button" id="<?=$Data['id'];?>" class="btn btn-danger waves-effect waves-light"><i class="mdi mdi-close"></i></button>-->
											<a href="?Halaman=_jasa&Aksi=_info&Data=<?=$Data['id'];?>">
												<button type="button" class="btn btn-warning waves-effect waves-light"><i class="mdi mdi-circle-edit-outline"></i></button>
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
				// var nama          = $(this).attr('nama');
				Swal.fire({
					title: 'Are you sure?',
					text: "Hapus Data ini",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes, delete it!'
				}).then(function(result){ 
					if (result.value) {
						$.ajax({
							type: 'POST',
							data: {id:id},
							url: '_jasa/_proses.php?Delete',
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
