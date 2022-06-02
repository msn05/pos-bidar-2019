<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="page-title-box">
						<div class="page-title-right">
							<ol class="breadcrumb m-0">
								<li class="breadcrumb-item"><a href="javascript: void(0);">SIPT POS </a></li>
								<li class="breadcrumb-item active">Bea Jasa</li>
							</ol>
						</div>
						<h4 class="page-title">Daftar Bea Jasa</h4>
					</div>
				</div>
			</div> 
			<div class="row">
				<div class="col-12">
					<div class="card-box">
						<a href="?Halaman=_Bea_jasa&Aksi=form">
							<button type="button" class="btn btn-sm btn-blue waves-effect waves-light float-right"><i class="mdi mdi-plus-circle"> Add</i></button>
						</a>
						<h4 class="header-title">Data Bea Jasa Perusahaan</h4>
						<p class="text-muted font-13 mb-4">
							Halaman ini berisi data bea jasa perusahaan dalam sistem
						</p>

						<table id="basic-datatable" class="table dt-responsive nowrap w-100">
							<thead>
								<tr>
									<th>No</th>
									<th>No Resi</th>
									<th>Nama Karyawan</th>
									<th>Nama Pengirim</th>
									<th>Kategori Jasa</th>
									<th>Tanggal Pemesanan</th>
									<th>Total Tarif</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								$Pemesanan = mysqli_query($conn,'select * from pemesanan ');
								while($Data = mysqli_fetch_array($Pemesanan)){
									$Pengirim = mysqli_fetch_array(mysqli_query($conn,"select * from pengirim where id_pengirim='".$Data['id_pengirim']."'"));
									$Penermia = mysqli_fetch_array(mysqli_query($conn,"select * from penerima where id_penerima='".$Data['id_penerima']."'"));
									$Karyawan = mysqli_fetch_array(mysqli_query($conn,"select * from  keterangan_login where keterangan_login.id='".$Data['id_users_data']."'"));
									$Jasa = mysqli_fetch_array(mysqli_query($conn,"select * from jasa join ketentuan_jasa on ketentuan_jasa.kode_jasa=jasa.id where ketentuan_jasa.id='".$Data['id_jasa']."'"));
									$Pembayaran = mysqli_fetch_array(mysqli_query($conn,"select * from pembayaran where kode_pemesanan='".$Data['kode_pemesanan']."'"));
									?>	
									<tr>
										<td><?=$no++;?></td>
										<td><?=$Data['kode_pemesanan'];?></td>
										<td><?=$Karyawan['nama_pengguna'];?></td>
										<td><?=$Pengirim['nama'];?></td>
										<td><?=$Jasa['nama_jasa'].'-'.($Jasa['nama_ketentuan'] == 1 ? 'Dokument' : ($Jasa['nama_ketentuan'] == 2 ? 'Barang Kecil' : 'Barang Besar'));?></td>
										<td><?=$Data['tanggal_pemesanan'];?></td>
										<td>Rp. <?=number_format($Data['biaya_tarif']);?></td>
										<td>
											<?php if($Pembayaran['jumlah_bayar'] != $Data['biaya_tarif']){?>
												<button type="button" id="<?=$Data['id'];?>" name_data="<?=$Pengirim['nama'];?>" class="btn btn-danger waves-effect waves-light"><i class="mdi mdi-close"></i></button>
											<?php }?>
											<a href="?Halaman=_Bea_jasa&Aksi=_info&Data=<?=$Data['id'];?>" title='edit'>
												<button type="button" class="btn btn-warning waves-effect waves-light"><i class="mdi mdi-circle-edit-outline"></i></button>
											</a>
											<a href="?Halaman=_Bea_jasa&Aksi=tambah&Data=<?=$Data['id'];?>" title='info'>
												<button type="button" class="btn btn-info waves-effect waves-light"><i class="mdi mdi-book-information-variant"></i></button>
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
							url: '_Bea_jasa/_proses.php?DeletePemesanan',
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
