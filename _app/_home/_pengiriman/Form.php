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
						<h4 class="page-title">Pengiriman</h4>
					</div>
				</div>
			</div> 
			<?php
			$DataUpdate = mysqli_fetch_array(mysqli_query($conn,"select * from pengiriman join pembayaran on pembayaran.id_pembayaran=pengiriman.id_pembayaran where pengiriman.id_pengiriman_barang='".$_GET['Data']."'"));
			?>

			<form id="Form" method="POST">
				<div class="row">
					<div class="col-4">
						<div class="card">
							<div class="card-body">
								<h4 class="header-title"> Form Pengiriman</h4>
								<hr>
								<div class="form-group col-md-12">
									<input type="hidden" name="id" id="id" value="<?=$DataUpdate['id_pengiriman_barang'];?>">
									<label for="inputAddress" class="col-form-label">Pilih Status Jasa</label>
									<select class="form-control" name="inputjasa" id="inputjasa" data-style="btn-light">
										<option value="">Pilih</option>
										<option value="1"<?=$DataUpdate['lock_pengiriman'] == 1 ? 'selected' : '';?>>Proses</option>
										<option value="2"<?=$DataUpdate['lock_pengiriman'] == 2 ? 'selected' : '';?>>Sedang Dikirim</option>
										<option value="3"<?=$DataUpdate['lock_pengiriman'] == 3 ? 'selected' : '';?>>Selesai</option>
									</select>
								</div>

								<hr>
								<div class="form-group mb-0 justify-content-end row">
									<button type="submit" id="PostData" class="mr-2 btn btn-primary waves-effect waves-light">Save</button>
									<a href="?Halaman=_pemesanan">
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

	<script type="text/javascript">
		$("#Form").on('submit',(function(e) {
			e.preventDefault();
			var Form = $(this);
			$.ajax({
				url: '_pengiriman/_proses.php?Simpan',
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
							window.location = "?Halaman=_pengiriman";
						}
						);
					} else{
						swal.fire({
							title: respone.status,
							text: respone.message,
							icon: respone.status
						}).then(function(){ 
    								// location.reload(true);
    							}
    							);
					}
				}
			});
		}));

	</script>