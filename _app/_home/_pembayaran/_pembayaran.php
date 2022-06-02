
<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="page-title-box">
						<div class="page-title-right">
							<ol class="breadcrumb m-0">
								<li class="breadcrumb-item"><a href="javascript: void(0);">SIPT POS </a></li>
								<li class="breadcrumb-item active">Pembayaran</li>
							</ol>
						</div>
						<h4 class="page-title">Daftar Pembayaran</h4>
					</div>
				</div>
			</div> 

			<div class="row">
				<div class="col-12">
					<div class="card-box">
						<h4 class="header-title">Data Pembayaran Pemesanan</h4>
						<p class="text-muted font-13 mb-4">
							Halaman ini berisi data pembayaran atas pemesanan pelanggan perusahaan dalam sistem
						</p>

						<table id="basic-datatable" class="table dt-responsive nowrap w-100">
							<thead>
								<tr>
									<th>No</th>
									<th>Kode Resi</th>
									<th>Nama Pengirim</th>
									<th>Beban Biaya</th>
									<th>Nama Penerima Uang</th>
									<th>Status</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								$Jasa = mysqli_query($conn,'select * from pemesanan');
								while($Data = mysqli_fetch_array($Jasa)){
									$Pembayaran = mysqli_fetch_array(mysqli_query($conn,"select * from pembayaran where kode_pemesanan='".$Data['kode_pemesanan']."'"));
									$Pengirim = mysqli_fetch_array(mysqli_query($conn,"select * from pengirim where id_pengirim='".$Data['id_pengirim']."'"));
									$Pengguna = mysqli_fetch_array(mysqli_query($conn,"select * from keterangan_login where id='".$Pembayaran['id_penerima_pembayaran']."'"));
									?>	
									<tr>
										<td><?=$no++;?></td>
										<td><?=$Data['kode_pemesanan'];?></td>
										<td><?=$Pengirim['id_pengirim'] != '' ? ''.$Pengirim['nama'].'' : '-';?></td>
										<td><?=number_format($Data['biaya_tarif']);?></td>
										<td><?=$Pembayaran['id_penerima_pembayaran'] != '' ? ''.$Pengguna['nama_pengguna'].'' : '-';?></td>
										<td><?=$Pembayaran['pembayaran_status'] == 1 ? 'Selesai' : 'Tunda';?></td>
										<td>
											<?php 
											if($Pembayaran['jumlah_bayar'] != $Data['biaya_tarif']){
												echo'
												<a href="?Halaman=_pembayaran&Aksi=_info&Data='.$Data['kode_pemesanan'].'" title="bayar">
												<button type="button" class="btn btn-danger waves-effect waves-light"><i class="mdi mdi-circle-edit-outline"></i></button>
												</a>

												';
											}else{
												echo'	<a href="Cetak.php?Keterangan=Pembayaran&Data='.$Data['kode_pemesanan'].'" title="cetak">
												<button type="button" class="btn btn-success waves-effect waves-light"><i class="mdi mdi-cloud-print-outline"></i></button>
												</a>';
											}
											?>
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
	<script type="text/javascript">
		$(document).ready(function(){
			$("#basic-datatable").DataTable({language:{paginate:{previous:"<i class='mdi mdi-chevron-left'>",next:"<i class='mdi mdi-chevron-right'>"}}
		});
		});

	</script>

