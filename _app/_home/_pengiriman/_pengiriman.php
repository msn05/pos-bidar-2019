<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="page-title-box">
						<div class="page-title-right">
							<ol class="breadcrumb m-0">
								<li class="breadcrumb-item"><a href="javascript: void(0);">SIPT POS </a></li>
								<li class="breadcrumb-item active">Pengiriman</li>
							</ol>
						</div>
						<h4 class="page-title">Daftar Pengiriman</h4>
					</div>
				</div>
			</div> 
			<div class="row">
				<div class="col-12">
					<div class="card-box">
						<h4 class="header-title">Data Pengiriman Barang Pemesanan</h4>
						<p class="text-muted font-13 mb-4">
							Halaman ini berisi data pengiriman jasa perusahaan dalam sistem
						</p>

						<table id="basic-datatable" class="table dt-responsive nowrap w-100">
							<thead>
								<tr>
									<th>No</th>
									<th>Kode Pembayaran</th>
									<th>Tanggal Pengiriman</th>
									<th>Status Pengiriman</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								$Pengiriman = mysqli_query($conn,'select * from pengiriman ');
								while($Data = mysqli_fetch_array($Pengiriman)){
									$Pembayaran = mysqli_fetch_array(mysqli_query($conn,"select * from pembayaran where id_pembayaran	='".$Data['id_pembayaran']."'"));
									?>	
									<tr>
										<td><?=$no++;?></td>
										<td><?=$Pembayaran['kode_pemesanan'];?></td>
										<td><?=$Data['tanggal_pengiriman'] != NULL ? ''.$Data['tanggal_pengiriman'].'' : 'Belum Diketehui';?></td>
										<td><?=$Data['lock_pengiriman'] == 1 ? 'Proses': ($Data['lock_pengiriman'] == 2  ? ' Sedang Dikirim' : 'Selesai');?>
										<td>
											<?php if ($Data['lock_pengiriman'] == 3){?>
											<?php }else{?>												
												<a href="?Halaman=_pengiriman&Aksi=form&Data=<?=$Data['id_pengiriman_barang'];?>" title='edit'>
													<button type="button" class="btn btn-warning waves-effect waves-light"><i class="mdi mdi-circle-edit-outline"></i></button>
												</a>
											<?php }?>

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
				var id            		 = $(this).attr('id');
				var name_data            = $(this).attr('name_data');
				// var nama          = $(this).attr('nama');
				Swal.fire({
					title: 'Are you sure?',
					text: "Hapus Data ini " +name_data,
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
							url: '_pemesanan/_proses.php?DeletePemesanan',
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
