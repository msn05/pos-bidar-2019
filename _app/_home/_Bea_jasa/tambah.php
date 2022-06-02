    <link href="<?=Assets('');?>/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=Assets('');?>/libs/selectize/css/selectize.bootstrap3.css" rel="stylesheet" type="text/css" />
    <link href="<?=Assets('');?>/libs/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
    <script src="<?=Assets('');?>/libs/select2/js/select2.min.js"></script>
    <script src="<?=Assets('');?>/libs/jquery-mockjax/jquery.mockjax.min.js"></script>
    <script src="<?=Assets('');?>/libs/devbridge-autocomplete/jquery.autocomplete.min.js"></script>
    <script src="<?=Assets('');?>/libs/bootstrap-select/js/bootstrap-select.min.js"></script>
    <div class="content-page">
    	<div class="content">
    		<div class="container-fluid">
    			<div class="row">
    				<div class="col-12">
    					<div class="page-title-box">
    						<div class="page-title-right">
    							<ol class="breadcrumb m-0">
    								<li class="breadcrumb-item"><a href="javascript: void(0);">SIPT POS </a></li>
    								<li class="breadcrumb-item active">Pemesanan Jasa</li>
    							</ol>
    						</div>
    						<h4 class="page-title">Pemesanan Jasa</h4>
    					</div>
    				</div>
    			</div> 
    			<form id="Form" method="POST">
    				<?php
    				$Data = $_GET['Data'];
    				$Pemesanan = mysqli_fetch_array(mysqli_query($conn,"select * from pemesanan where id='".$Data."'"));
    				$Pengirim = mysqli_fetch_array(mysqli_query($conn,"select * from pengirim where id_pengirim='".$Pemesanan['id_pengirim']."'"));
    				$Penerima = mysqli_fetch_array(mysqli_query($conn,"select * from penerima where id_penerima='".$Pemesanan['id_penerima']."'"));
    				$KetentuanTarif = mysqli_fetch_array(mysqli_query($conn,"select a.id as IdJasa, a.kode_jasa,a.nama_jasa,b.id as idKetentuanJasa,b.nama_ketentuan,b.kode_jasa from jasa as a join ketentuan_jasa as b on b.kode_jasa=a.id where b.id='".$Pemesanan['id_jasa']."'"));
    				$GroupKeterangan = mysqli_fetch_array(mysqli_query($conn,"select * from tarif where id_ketentuan_jasa='".$KetentuanTarif['idKetentuanJasa']."' group by group_keterangan"));
    				$KeteranganTarifNya = mysqli_fetch_array(mysqli_query($conn,"select * from keterangan_tarif where id_tarif_keterangan='".$GroupKeterangan['group_keterangan']."'"));
    				$Pembayaran = mysqli_fetch_array(mysqli_query($conn,"select * from pembayaran where kode_pemesanan='".$Pemesanan['kode_pemesanan']."'"));
    				?>
    				<div class="row">
    					
    					<div class="col-12">
    						<div class="card">
    							<div class="card-body">
    								<h4 class="header-title"> Informasi Pemesanan Jasa</h4>
    								<hr>
    								<div class="row">
    									<div class="col-12">
    										<div class="card">
    											<div class="card-body">
    												<h4 class="header-title"> Jasa</h4>
    												<div class="form-row">
    													<div class="form-group col-md-3">
    														<label for="inputAddress" class="col-form-label">Kategori Jasa</label>
    														<input type="text" class="form-control"  value="<?=$KetentuanTarif['nama_jasa'];?>" id="inputnama" name="inputnama" placeholder="Nama Pengirim" readonly/>
    													</div>
    													<div class="form-group col-md-3">
    														<label for="inputAddress" class="col-form-label">Tipe Penggunaan Jasa</label>
    														<input type="text" class="form-control"  value="<?=$KetentuanTarif['nama_ketentuan'];?>" id="inputnama" name="inputnama" placeholder="Nama Pengirim" readonly/>
    													</div>
    													<div class="form-group col-md-3">
    														<label for="inputAddress" class="col-form-label">Beban Maks</label>
    														<input type="text" class="form-control"  value="<?=$KeteranganTarifNya['berat'].' Kg';?>" id="inputnama" name="inputnama" placeholder="Nama Pengirim" readonly/>
    													</div>
    													<div class="form-group col-md-3">
    														<label for="inputAddress" class="col-form-label">Harga Jasa</label>
    														<input type="text" class="form-control"  value="Rp. <?=number_format($KeteranganTarifNya['total_tarif_nilai']);?>" id="inputnama" name="inputnama" placeholder="Nama Pengirim" readonly/>
    													</div>
    												</div>


    											</div> 
    										</div> 
    									</div> 
    								</div>
    								<div class="row">
    									<div class="col-12">
    										<div class="card">
    											<div class="card-body">
    												<h4 class="header-title"> Pengirim</h4>
    												<div class="form-row">
    													<div class="form-group col-md-3">
    														<label for="inputEmail4" class="col-form-label">Nama Pengirim</label>
    														<input type="text" class="form-control" value="<?=$Pengirim['nama'];?>" id="inputnama" name="inputnama" placeholder="Nama Pengirim" readonly/>
    													</div>
    													<div class="form-group col-md-6">
    														<label for="inputPassword4" class="col-form-label">Alamat</label>
    														<textarea class="form-control"  name="alamat" id="alamat" placeholder="alamat pengirim" readonly/><?=$Pengirim['alamat'];?></textarea>
    													</div>
    													<div class="form-group col-md-3">
    														<label for="inputEmail4" class="col-form-label">Nomor Telphone</label>
    														<input type="number" value="<?=$Pengirim['no_telphone'];?>" class="form-control" id="inputhp1" name="inputhp1" placeholder="Nomor HP" readonly/>
    													</div>
    												</div>
    											</div>
    										</div>
    									</div>
    								</div>
    								<div class="row">
    									<div class="col-12">
    										<div class="card">
    											<div class="card-body">
    												<h4 class="header-title"> Penerima</h4>
    												<div class="form-row">
    													<div class="form-group col-md-3">
    														<label for="inputEmail4" class="col-form-label">Nama Penerima</label>
    														<input type="text" class="form-control" value="<?=$Penerima['nama'];?>" id="inputnama2" name="inputnama2" placeholder="Nama Penerima" readonly/>
    													</div>
    													<div class="form-group col-md-6">
    														<label for="inputPassword4" class="col-form-label">Alamat</label>
    														<textarea class="form-control" name="alamat2" id="alamat2" placeholder="alamat Penerima" readonly/><?=$Penerima['alamat'];?></textarea>
    													</div>
    													<div class="form-group col-md-3">
    														<label for="inputEmail4" class="col-form-label">Nomor Telphone</label>
    														<input type="number" value="<?=$Penerima['no_telp'];?>" class="form-control" id="inputhp2" name="inputhp2" placeholder="Nomor HP" readonly/>
    													</div>

    												</div>
    											</div>
    										</div>
    									</div>
    								</div>
    								<div class="row">
    									<div class="col-12">
    										<div class="card">
    											<div class="card-body">
    												<h4 class="header-title"> Barang Pelanggan</h4>
    												<div class="form-row">
    													<div class="form-group col-md-4">
    														<label for="inputEmail4" class="col-form-label">Nama Barang </label>
    														<input type="text" class="form-control" value="<?=$Pemesanan['nama_barang_pelanggan'];?>" id="inputbarang" name="inputbarang" placeholder="Sebutkan nama barangnya" readonly/>
    													</div>
    													<div class="form-group col-md-4">
    														<label for="inputPassword4" class="col-form-label">Berat nya</label>
    														<input type="text" class="form-control"  id="inputberat" name="inputberat" placeholder="Berat Barang" value="<?=$Pemesanan['berat'].' Kg';?>" readonly/>
    													</div>
    													<div class="form-group col-md-4">
    														<label for="inputEmail4" class="col-form-label">Jarak Pengiriman</label>
    														<input type="text" class="form-control" value="<?=$Pemesanan['jarak'].' Km';?>" id="inputjarak" name="inputjarak" placeholder="Jarak Pengiriman" readonly/>
    													</div>

    												</div>
    											</div>
    										</div>
    									</div>
    								</div>
    								<div class="col-12">
    									<div class="card">
    										<div class="card-body">
    											<h4 class="header-title"> Pembayaran</h4>
    											<div class="form-row">
    												<div class="form-group col-md-4">
    													<label for="inputEmail4" class="col-form-label">Kode Pemesanan </label>
    													<input type="text" class="form-control" value="<?=$Pemesanan['kode_pemesanan'];?>" id="inputbarang" name="inputbarang" placeholder="Sebutkan nama barangnya" readonly/>
    												</div>
    												<div class="form-group col-md-4">
    													<label for="inputPassword4" class="col-form-label">Jumlah Bayar</label>
    													<input type="text" class="form-control"  id="inputberat" name="inputberat" placeholder="Berat Barang" value="Rp. <?=number_format($Pembayaran['jumlah_bayar']);?>" readonly/>
    												</div>
    												<div class="form-group col-md-4">
    													<label for="inputEmail4" class="col-form-label">Status Pengiriman</label>
    													<input type="text" class="form-control" value="<?=$Pemesanan['pengiriman_status'] == 1 ? 'Menunggu pembayaran' : ($Pemesanan['pengiriman_status'] == 2 ? 'Proses' : 'Selesai');?>" id="inputjarak" name="inputjarak" placeholder="Jarak Pengiriman" readonly/>
    												</div>

    											</div>
    										</div>
    									</div>
    								</div>
    								<hr>
    								<div class="form-group mb-0 justify-content-end row">
    									<a href="?Halaman=_Bea_jasa">
    										<button type="button" id="PostData" class="btn btn-info waves-effect waves-light">Back</button>
    									</a>
    								</div>
    							</div>
    						</div>

    					</div>

    				</div>

    			</form>

    		</div> 
    	</div> 
