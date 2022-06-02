
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
			$Pemesanan = mysqli_fetch_array(mysqli_query($conn,"select * from pemesanan where kode_pemesanan='".$id."'"));
			$Pengirim = mysqli_fetch_array(mysqli_query($conn,"select * from pengirim where id_pengirim='".$Pemesanan['id_pengirim']."' group by id_pengirim"));
			$Penerima = mysqli_fetch_array(mysqli_query($conn,"select * from penerima where id_penerima='".$Pemesanan['id_penerima']."' group by id_penerima"));
			?>

			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<h4 class="header-title">Form Pembayaran</h4>
							<form id="Form"  method="POST">
								<div class="form-row">
									<div class="form-group col-md-4">
										<label for="inputEmail4" class="col-form-label">Kode Pemesanan</label>
										<input type="hidden" class="form-control" value="<?=$Pemesanan['id'];?>" id="inputid" name="inputid" placeholder="Kode Jasa" required/>
										<input type="text" class="form-control" value="<?=$Pemesanan['kode_pemesanan'];?>" id="inputnama" name="inputnama" placeholder="Kode Jasa" readonly/>
									</div>
									<div class="form-group col-md-4">
										<label for="inputPassword4" class="col-form-label">Nama Pengirim</label>
										<input type="text" class="form-control" id="inputjasa" name="inputjasa"  value="<?=$Pengirim['nama'].'-'.$Pengirim['alamat'];?>" readonly/>
									</div>
									<div class="form-group col-md-4">
										<label for="inputAddress" class="col-form-label">Tanggal Pemesanan</label>
										<input type="text" class="form-control" value="<?=$Pemesanan['tanggal_pemesanan'];?>" id="inputtanggal" name="inputtanggal" placeholder="Password" required="">
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-4">
										<label for="inputAddress" class="col-form-label">Beban biaya</label>
										<input type="hidden" class="form-control" value="<?=$Pemesanan['biaya_tarif'];?>" id="inputtanggals" name="inputtanggals" placeholder="Password" readonly="">
										<input type="text" class="form-control" value="<?=number_format($Pemesanan['biaya_tarif']);?>" id="" name="" placeholder="Password" readonly="">
									</div>
									<div class="form-group col-md-8">
										<label for="inputAddress" class="col-form-label">Masukkan Jumlah Uang Pelanggan</label>
										<input type="text" class="form-control"  id="inputnominal" name="inputnominal" placeholder="Nomminal Uang dari Pelanggan" required="">
									</div>
								</div>
								<br>
								<hr>
								<button type="submit" id="PostData" class="btn btn-primary waves-effect waves-light">Save</button>
								<a href="?Halaman=_jasa">
									<button type="button" id="PostData" class="btn btn-info waves-effect waves-light">Back</button>
								</a>
							</form>

						</div> <!-- end card-body -->
					</div> <!-- end card-->
				</div> <!-- end col -->
			</div>
		</div>
	</div>
	<script>
		$("#Form").on('submit',(function(e) {
			e.preventDefault();
			var kode_pemesanan = $('#inputnama').val();
			var Form = $(this);
			$.ajax({
				url: '_pembayaran/_proses.php?Bayar',
				type: "POST",
				data:  Form.serialize(),
				dataType: "JSON",
				cache :"false",
				success: function (respone) {
					if (respone.status == 'success') {
						swal.fire({
							title: respone.status,
							text: respone.message,
							icon: respone.status
						}).then(function(){ 
							window.location = "?Halaman=_pembayaran&Aksi=form&Data="+kode_pemesanan;
						}
						);
					} else{
						swal.fire({
							title: respone.status,
							text: respone.message,
							icon: respone.status
						}).then(function(){ 
							window.location = "?Halaman=_pembayaran";
						}
						);
					}
				}
			});
		}));

	</script>