<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="page-title-box">
						<div class="page-title-right">
							<ol class="breadcrumb m-0">
								<li class="breadcrumb-item"><a href="javascript: void(0);">SIPT POS </a></li>
								<li class="breadcrumb-item active">Pengirim</li>
							</ol>
						</div>
						<h4 class="page-title">Daftar Pengirim </h4>
					</div>
				</div>
			</div> 
			<div class="row">
				<div class="col-12">
					<div class="card-box">
						<h4 class="header-title">Data Pengirim</h4>
						<p class="text-muted font-13 mb-4">
							Halaman ini berisi data tentang data pengirim jasa perusahaan dalam sistem
						</p>
						<table id="basic-datatable" class="table dt-responsive nowrap w-100">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama</th>
									<th>Alamat</th>
									<th>Nomor Telphone</th>
									<th>Jumlah Orders</th>
									<th>Presetense Bayar</th>
									<th>Total Biaya Jasa Pelanggan</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								$Pengirim = mysqli_query($conn,'select * from pengirim group by id_pengirim');
								while($Data = mysqli_fetch_array($Pengirim)){
									$CountPemesananPengirim = mysqli_fetch_array(mysqli_query($conn,"select id,id_pengirim,biaya_tarif, count(id) as TotalPesanan, sum(biaya_tarif) as TotalBiaya from pemesanan where id_pengirim='".$Data['id_pengirim']."'"));
									?>	
									<tr>
										<td><?=$no++;?></td>
										<td><?=$Data['nama'];?></td>
										<td><?=$Data['alamat'];?></td>
										<td><?=$Data['no_telphone'];?></td>
										<td><?=$CountPemesananPengirim['TotalPesanan'];?></td>
										<td><?=round($CountPemesananPengirim['TotalPesanan']*100,2).' %';?></td>
										<td>Rp. <?=number_format($CountPemesananPengirim['TotalBiaya']);?></td>
										<td>
											<a href="?Halaman=_pengirim&Aksi=_info&Data=<?=$Data['id_pengirim'];?>">
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
		});
	</script>
