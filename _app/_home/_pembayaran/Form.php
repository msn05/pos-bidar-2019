
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
						<h4 class="page-title"> Pembayaran</h4>
					</div>
				</div>
			</div> 
			<?php
			$id = $_GET['Data'];
			$PemesananData = mysqli_fetch_array(mysqli_query($conn,"select * from pemesanan join pembayaran on pembayaran.kode_pemesanan=pemesanan.kode_pemesanan where pemesanan.kode_pemesanan='".$id."'"));
			$Pengirim = mysqli_fetch_array(mysqli_query($conn,"select * from pengirim where id_pengirim='".$PemesananData['id_pengirim']."' group by id_pengirim"));
			$Penerima = mysqli_fetch_array(mysqli_query($conn,"select * from penerima where id_penerima='".$PemesananData['id_penerima']."' group by id_penerima"));
			$KetentuanTarif = mysqli_fetch_array(mysqli_query($conn,"select a.id as IdJasa,a.nama_jasa,b.id as idKetentuanJasa,b.nama_ketentuan,b.kode_jasa from jasa as a join ketentuan_jasa as b on b.kode_jasa=a.id where b.id='".$PemesananData['id_jasa']."'"));
			$GroupKeteranganData = mysqli_query($conn,"select * from tarif where id_ketentuan_jasa='".$KetentuanTarif['idKetentuanJasa']."' ");
			while ($DataKeterangan = mysqli_fetch_array($GroupKeteranganData)) {
				$dataPerhit[] = [$DataKeterangan['id_perhitungan_tarif_jasa'],$DataKeterangan['nilai']];
			}
			$PPN = ($dataPerhit[2][1] * $dataPerhit[0][1] / 100) ;
			?>
			<div class="row">
				<div class="col-12">
					<div class="card-box">
						<!-- Logo & title -->
						<div class="clearfix">
							<div class="float-left">
								<div class="auth-logo">
									<div class="logo logo-dark">
										<span class="logo-lg">
											<img src="<?=Image('logo/logo-print.png');?>" alt="" height="50">
										</span>
									</div>
								</div>
							</div>
							<div class="float-right">
								<h4 class="m-0 d-print-none">Invoice</h4>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="mt-3">
									<p><b>Hallo, <?=$Pengirim['nama'];?></b></p>
									<p class="text-muted">Terima kasih telah melakukan pemesanan jasa pada POS INDONESIA, silakan tunggu proses kelanjutann atas pemesanannya. </p>
								</div>

							</div><!-- end col -->
							<div class="col-md-4 offset-md-2">
								<div class="mt-3 float-right">
									<p class="m-b-10"><strong>Order Date : </strong> <span class="float-right"> &nbsp;&nbsp;&nbsp;&nbsp; <?=date('d-m-Y',strtotime($PemesananData['tanggal_pemesanan']));?></span></p>
									<p class="m-b-10"><strong>Order Status : </strong> <span class="float-right"><?=$PemesananData['pengiriman_status'] == 2 ? "<span class='badge badge-danger'>Selesai</span>" : '';?> </span></p>
									<p class="m-b-10"><strong>Order No. : </strong> <span class="float-right"><?=$PemesananData['kode_pemesanan'];?> </span></p>
								</div>
							</div><!-- end col -->
						</div>

						<div class="row mt-1">
							<div class="col-6">
								<h6>Billing Address</h6>
								<address>
									<?=$Pengirim['nama'];?><br>
									<?=$Pengirim['alamat'];?><br>
									<abbr title="Phone">P:</abbr> <?=$Pengirim['no_telphone'];?>
								</address>
							</div> <!-- end col -->

							<div class="col-6">
								<h6>Shipping Address</h6>
								<address>
									<?=$Penerima['nama'];?><br>
									<?=$Penerima['alamat'];?><br>
									<abbr title="Phone">P:</abbr><?=$Penerima['no_telp'];?>
								</address>
							</div> <!-- end col -->
						</div> 
						<!-- end row -->

						<div class="row">
							<div class="col-12">
								<div class="table-responsive">
									<table class="table mt-4 table-centered">
										<thead>
											<tr><th>#</th>
												<th style="width: 30%">Item</th>
												<th>Tipe Pengiriman</th>
												<th style="width: 10%">Jarak</th>
												<th style="width: 10%">Berat</th>
												<th style="width: 10%">Harga</th>
											</tr></thead>
											<tbody>
												<tr>
													<td>1</td>
													<td><?=$PemesananData['nama_barang_pelanggan'];?></td>
													<td><?=$KetentuanTarif['nama_jasa'].'-'.($KetentuanTarif['nama_ketentuan'] == 1 ? 'Dokument' :($KetentuanTarif['nama_ketentuan'] == 2 ? 'Barang Kecil' : 'Barang Besar'));?></td>
													<td><?=$PemesananData['jarak'];?> Km</td>
													<td><?=$PemesananData['berat'];?> Kg</td>
													<td>Rp. <?=number_format($PemesananData['biaya_tarif']);?></td>
											
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
                            
						
							<!-- end row -->

							<div class="mt-4 mb-1">
								<div class="text-right d-print-none">
									<a href="Cetak.php?Keterangan=Pembayaran&Data=<?=$PemesananData['kode_pemesanan'];?>" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-printer mr-1"></i> Print</a>
									<a href="?Halaman=_pembayaran" class="btn btn-info waves-effect waves-light">Back</a>
								</div>
							</div>
						</div> <!-- end card-box -->
					</div> <!-- end col -->
				</div>
			</div>
		</div>