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
								<li class="breadcrumb-item active">Daftar Ketentuan Tarif</li>
							</ol>
						</div>
						<h4 class="page-title">Daftar Ketentuan Tarif</h4>
					</div>
				</div>
			</div> 

			<div class="row">
				<div class="col-12">
					<div class="card-box">
						<?php if(isset($_GET['Data'])){?>
							<a href="?Halaman=_ketentuan_jasa&Aksi=form&Data=<?=$_GET['Data'];?>">
								<button type="button" class="btn btn-sm btn-blue waves-effect waves-light float-right"><i class="mdi mdi-plus-circle"> Add</i></button>
							</a>
						<?php }?>
						<h4 class="header-title">Data Ketentuan Tarif</h4>
						<p class="text-muted font-13 mb-4">
							Halaman ini berisi data ketentuan tarif jasa pengiriman perusahaan dalam sistem
						</p>

						<table id="basic-datatable" class="table dt-responsive nowrap w-100">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama Jasa</th>
									<th>Ketentuan Pengiriman</th>
									<th>Lama Pengiriman</th>
									<th>Jarak</th>
									<th>Beban</th>
									<th>Tarif</th>
									<?php if(isset($_GET['Data'])){echo'
									<th>Action</th>';
								}?>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 1;
							if(isset($_GET['Data'])){
								$idDataNya = $_GET['Data'];
								$KetentuanTarif = mysqli_query($conn,"select a.id as IdJasa,a.nama_jasa,b.id as idKetentuanJasa,b.nama_ketentuan,b.kode_jasa from jasa as a join ketentuan_jasa as b on b.kode_jasa=a.id where a.id='".$idDataNya."'");
								while($Datas = mysqli_fetch_array($KetentuanTarif)){
									$GroupKeterangan = mysqli_fetch_array(mysqli_query($conn,"select * from tarif where id_ketentuan_jasa='".$Datas['idKetentuanJasa']."' group by group_keterangan"));
									$KeteranganTarifNya = mysqli_fetch_array(mysqli_query($conn,"select * from keterangan_tarif where id_tarif_keterangan='".$GroupKeterangan['group_keterangan']."'"));
									?>	
									<tr>
										<td><?=$no++;?></td>
										<td><?=$Datas['nama_jasa'];?></td>
										<td><?=$Datas['nama_ketentuan'] == 1 ? 'Dokumen' : ($Datas['nama_ketentuan'] == 2 ? 'Barang Sedang' : 'Barang Besar');?></td>

										<td><?=$KeteranganTarifNya['kecepatan_kirim'];?> Hari</td>
										<td><?=$KeteranganTarifNya['jarak'];?> KM</td>
										<td><?=$KeteranganTarifNya['berat'];?> KG</td>
										<td>Rp. <?=number_format($KeteranganTarifNya['total_tarif_nilai']);?></td>
										<?php if(isset($_GET['Data'])){echo'
										<td>
										<button type="button" nameid='.$Datas['idKetentuanJasa'].' namedata='.$Datas['nama_ketentuan'].' class="btn btn-danger waves-effect waves-light"><i class="mdi mdi-close"></i></button>
										<a href="?Halaman=_keterangan_tarif&Aksi=_info&Data='.$Datas['idKetentuanJasa'].'">
										<button type="button" class="btn btn-warning waves-effect waves-light"><i class="mdi mdi-circle-edit-outline"></i></button>
										</a>
										</td>
										';}?>
									</tr>
								<?php }
							}else{
								$KetentuanTarif = mysqli_query($conn,'select a.id as IdJasa, a.kode_jasa,a.nama_jasa,b.id as idKetentuanJasa,b.nama_ketentuan,b.kode_jasa from jasa as a join ketentuan_jasa as b on b.kode_jasa=a.id');
								while($Data = mysqli_fetch_array($KetentuanTarif)){
									$GroupKeterangan = mysqli_fetch_array(mysqli_query($conn,"select * from tarif where id_ketentuan_jasa='".$Data['idKetentuanJasa']."' group by group_keterangan"));
									$KeteranganTarifNya = mysqli_fetch_array(mysqli_query($conn,"select * from keterangan_tarif where id_tarif_keterangan='".$GroupKeterangan['group_keterangan']."'"));
									?>	
									<tr>
										<td><?=$no++;?></td>
										<td><?=$Data['nama_jasa'];?></td>
										<td><?=$Data['nama_ketentuan'];?></td>

										<td><?=$KeteranganTarifNya['kecepatan_kirim'];?> Hari</td>
										<td><?=$KeteranganTarifNya['jarak'];?> KM</td>
										<td><?=$KeteranganTarifNya['berat'];?> KG</td>
										<td>Rp. <?=$KeteranganTarifNya['total_tarif_nilai'];?></td>
										<?php if(isset($_GET['Data'])){echo'
										
										';}?>
									</tr>
								<?php }
							}?>
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
			var nameid            = $(this).attr('nameid');
			var namedata            = $(this).attr('namedata');
				// var nama          = $(this).attr('nama');
				Swal.fire({
					title: 'Are you sure?',
					text: "Hapus Data ini "+namedata,
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes, delete it!'
				}).then(function(result){ 
					if (result.value) {
						$.ajax({
							type: 'POST',
							data: {nameid:nameid},
							url: '_keterangan_tarif/_proses.php?Delete',
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
						});
					} else {
						swal("Batal", "Anda Membatalkan", "error");
					}
				})
			});


	});
</script>
