<?php 
$Jasa = mysqli_fetch_array(mysqli_query($conn,"select id, count(id) as TotalJasa from jasa where aktif='1'"));
$KetentuanJasa = mysqli_fetch_array(mysqli_query($conn,"select id_perhitungan_tarif, count(id_perhitungan_tarif) as TotalKetentuan from perhitungan_tarif_jasa "));
$Orders = mysqli_fetch_array(mysqli_query($conn,"select id, count(id) as Total from pemesanan "));
$JumlahUang = mysqli_fetch_array(mysqli_query($conn,"select id,biaya_tarif,jarak,berat,sum(jarak) as TotalJarak, sum(berat) as TotalBerat, sum(biaya_tarif) as Total from pemesanan "));
?>
<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="page-title-box">
						<div class="page-title-right">
							<ol class="breadcrumb m-0">
								<li class="breadcrumb-item active"><a href="javascript: void(0);">SIPT POS </a></li>
							</ol>
						</div>
						<h4 class="page-title">Dashboard</h4>
					</div>
				</div>
			</div> 
			<div class="row">
				<div class="col-lg-12 col-xl-8">
					<div class="card-box bg-pattern">
						<div class="row">
							<div class="col-12">
								<div class="text-right">
									<h3 class="text-dark my-1">
										<p>Sistem perhitungan tarif ini difungsikan untuk menghitung tarif pengiriman suatu jasa pada PT POS Indonesia Cabang Palembang. Sistem ini mengunakan fungsi terhitungan <b>harga normal</b> + <b>Tax admin</b> + <b>PPN ( harga normal * persentase ppn )</b>.
										</p>
										<hr>
										Palembang, <?=date('d-m-Y H:i:s');?>
										<p>

											Terima Kasih Administrator
										</p>
									</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-12 col-xl-8">
					<div class="card-box bg-danger">
						<div class="row">
							<div class="col-12">
								<?php
								$LevelSe = mysqli_fetch_array(mysqli_query($conn,"select * from level where id_level='".$LevelNya."'"));?>
								<div class="text-center">
									<h3 class="text-white my-1">
										Anda Telah Login Sebagai <?=$LevelSe['nama_level'];?>
									</h3>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-4 col-xl-4">
					<a href="?Halaman=_jasa">
						<div class="card-box bg-pattern">
							<div class="row">
								<div class="mt-3 col-6">
									<div class="avatar-md bg-blue rounded">
										<i class="fe-slack avatar-title font-22 text-white"></i>
									</div>
								</div>
								<div class="col-6">
									<div class="text-right">
										<h3 class="text-dark my-1"><span data-plugin="counterup">
											<?=$Jasa['TotalJasa'];?></span></h3>
											<p class="mt-3 font-16 text-muted mb-4 text-truncate">Jasa</p>
										</div>
									</div>
								</div>
							</div>
						</a>

					</div>
					<div class="col-lg-4 col-xl-4">
						<a href="?Halaman=_ketentuan_jasa">
							<div class="card-box bg-pattern">
								<div class="row">
									<div class="mt-3  col-6">
										<div class="avatar-md bg-success rounded">
											<i class="fe-award avatar-title font-22 text-white"></i>
										</div>
									</div>
									<div class="col-6">
										<div class="text-right">
											<h3 class="text-dark my-1"><span data-plugin="counterup">
												<?=$KetentuanJasa['TotalKetentuan'];?>
											</span></h3>
											<p class="mt-3 font-16 text-muted mb-4 text-truncate">Ketentuan Jasa</p>
										</div>
									</div>
								</div>
							</div>
						</a>
					</div> <!-- end col -->
					<div class="col-lg-4 col-xl-4">
						<div class="card-box bg-pattern">
							<div class="row">
								<div class="mt-3 col-6">
									<div class="avatar-md bg-danger rounded">
										<i class="fe-shopping-cart avatar-title font-22 text-white"></i>
									</div>
								</div>
								<div class="col-6">
									<div class="text-right">
										<h3 class="text-dark my-1"><span data-plugin="counterup"><?=$Orders['Total'];?></span></h3>
										<p class="mt-3 font-16 text-muted mb-4 text-truncate">Pembayaran</p>
									</div>
								</div>
							</div>
						</div> 
					</div> 
					<div class="col-lg-4 col-xl-3">
						<div class="card-box bg-pattern">
							<div class="row">
								<div class="mt-3 col-6">
									<div class="avatar-md bg-warning rounded">
										<i class="fe-dollar-sign avatar-title font-22 text-white"></i>
									</div>
								</div>
								<div class="col-6">
									<div class="text-right">
										<h3 class="text-dark my-1">Rp. <?=number_format($JumlahUang['Total']);?></h3>
										<p class="mt-3  text-muted mb-3 text-truncate">Jumlah Pendapatan</p>
									</div>
								</div>
							</div>
						</div> <!-- end card-box-->
					</div>
					<div class="col-lg-4 col-xl-3">
						<div class="card-box bg-pattern">
							<div class="row">
								<div class="mt-3 col-6">
									<div class="avatar-md bg-info rounded">
										<i class="fe-send avatar-title font-22 text-white"></i>
									</div>
								</div>
								<div class="col-6">
									<div class="text-right">
										<h3 class="text-dark my-1"><?=$JumlahUang['TotalJarak'];?> KM</h3>
										<p class="mt-3 text-muted mb-3 text-truncate">Jumlah Jarak Kirim</p>
									</div>
								</div>
							</div>
						</div> <!-- end card-box-->
					</div>
					<div class="col-lg-4 col-xl-3">
						<div class="card-box bg-pattern">
							<div class="row">
								<div class="mt-3 col-6">
									<div class="avatar-md bg-success rounded">
										<i class="fe-send avatar-title font-22 text-white"></i>
									</div>
								</div>
								<div class="col-6">
									<div class="text-right">
										<h3 class="text-dark my-1"><?=round(($JumlahUang['TotalBerat']),3);?> KG</h3>
										<p class="mt-3 text-muted mb-3 text-truncate">Berat Pengiriman</p>
									</div>
								</div>
							</div>
						</div> <!-- end card-box-->
					</div> <!-- end col -->
				</div>    
			</div> 
		</div> 
