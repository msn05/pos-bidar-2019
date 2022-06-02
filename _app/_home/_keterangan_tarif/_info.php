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
								<li class="breadcrumb-item active">Daftar Jasa</li>
							</ol>
						</div>
						<h4 class="page-title">Ketentuan Jasa</h4>
					</div>
				</div>
			</div> 

			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<h4 class="header-title">Form Tambah Ketentuan Jasa</h4>
							<hr>
							<?php
							$namaKode = mysqli_fetch_array(mysqli_query($conn,"select a.id as IdJasa,a.nama_jasa,b.id as idKetentuanJasa,b.nama_ketentuan,b.kode_jasa from jasa as a join ketentuan_jasa as b on b.kode_jasa=a.id  where b.id='".$_GET['Data']."'"));
							$GroupKeterangan = mysqli_fetch_array(mysqli_query($conn,"select * from tarif where id_ketentuan_jasa='".$namaKode['idKetentuanJasa']."' "));
							$KeteranganTarifNya = mysqli_fetch_array(mysqli_query($conn,"select * from keterangan_tarif where id_tarif_keterangan='".$GroupKeterangan['group_keterangan']."'"));

							$GroupKeteranganData = mysqli_query($conn,"select * from tarif where id_ketentuan_jasa='".$namaKode['idKetentuanJasa']."'");
							while ($DataKeterangan = mysqli_fetch_array($GroupKeteranganData)) {
								$id[] = [$DataKeterangan['id_perhitungan_tarif_jasa'],$DataKeterangan['nilai']];
							}


							?>							
							<form id="Form"   method="POST">
								<div class="form-row">
									<div class="form-group col-md-3">
										<label for="inputEmail4" class="col-form-label">Kode Jasa</label>
										<input type="hidden" name='groupid' id='groupid' value="<?=$GroupKeterangan['group_keterangan'];?>">
										<input type="hidden" class="form-control" value="<?=$namaKode['IdJasa'];?>" id="inputnama" name="inputnama" placeholder="Kode Jasa" readonly/>
										<input type="text" class="form-control" value="<?=$namaKode['nama_jasa'];?>" readonly/>
									</div>
									<div class="form-group col-md-3">
										<label for="inputPassword4" class="col-form-label">Nama Ketentuan</label>
											<select class="form-control" name="inputketentuan" id="inputketentuan" data-style="btn-light" required/>
 										
 											<option value="1"<?=$namaKode['nama_ketentuan']== 1 ? 'selected' : '';?>>Dokumen</option>
 											<option value="2"<?=$namaKode['nama_ketentuan']== 2 ? 'selected' : '';?>>Barang Sedang</option>
 											<option value="3"<?=$namaKode['nama_ketentuan']== 3 ? 'selected' : '';?>>Barang Besar</option>
 								
 										</select>
										
									
									</div>
									<div class="form-group col-md-3">
										<label for="inputEmail4" class="col-form-label">Jarak</label>
										<input type="text" class="form-control" id="inputjarak" name="inputjarak" value="<?=$KeteranganTarifNya['jarak'];?>" placeholder="Kilo Meter" readonly/>
									</div>
									<div class="form-group col-md-3">
										<label for="inputPassword4" class="col-form-label">Kecepatan Kirim</label>
										<input type="number" class="form-control" id="inputkirim" name="inputkirim" value="<?=$KeteranganTarifNya['kecepatan_kirim'];?>" placeholder='Kecepatan Kirim' required/>
									</div>
								</div>

								<div class="form-group row ">
									<label for="inputPassword4" class="col-3 col-form-label">Harga</label>
									<div class="col-4">
										<input type="number" class="form-control" id="inputnormal" name="inputnormal" value="<?=$id[0][1];?>" placeholder="Harga Jasa Awal'" required/>
									</div>
									<label for="inputPassword3" class="col-5 col-form-label">dalam satuan rupiah (Rp)</label>
								</div>

								<div class="form-group row ">
									<label for="inputPassword3" class="col-3 col-form-label">Berat (KG)</label>
									<div class="col-4">
										<input type="number" class="form-control" id="inputberat" name="inputberat" value="<?=$KeteranganTarifNya['berat'];?>" placeholder="Berat Barang" readonly/>
									</div>
									<label for="inputPassword3" class="col-5 col-form-label">dalam Kilo Gram (KG)</label>
								</div>
								<div class="form-group row ">
									<label for="inputPassword3" class="col-3 col-form-label">PPN %</label>
									<div class="col-4">
										<input type="number" class="form-control" id="inputppn" name="inputppn" value="<?=$id[2][1];?>" placeholder="PPN berapa %" required/>
									</div>
									<label for="inputPassword3" class="col-5 col-form-label">dalam satuan persen (%)</label>
								</div>
								<div class="form-group row ">
									<label for="inputPassword5" class="col-3 col-form-label">Tax Admin</label>
									<div class="col-4">
										<input type="number" value="<?=$id[1][1];?>" class="form-control"  id="inputtax" name="inputtax" required/>
									</div>
									<label for="inputPassword3" class="col-5 col-form-label">dalam satuan rupiah (Rp)</label>
								</div>
								<div class="form-group row ">
									<label for="inputPassword5" class="col-3 col-form-label">Tarif</label>
									<div class="col-4">
										<input type="number" value="<?=$KeteranganTarifNya['total_tarif_nilai'];?>" class="form-control" id="inputtarif" name="inputtarif" readonly/>
									</div>
									<label for="inputPassword3" class="col-5 col-form-label">dalam satuan rupiah (Rp)</label>
								</div>

								<hr>
								<button type="#" id="PostData" class="btn btn-primary waves-effect waves-light">Update</button>
								<a href="?Halaman=_keterangan_tarif&Data=<?=$namaKode['IdJasa'];?>">
									<button type="button" id="PostData" class="btn btn-info waves-effect waves-light">Back</button>
								</a>
							</form>

						</div> 
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		var inputnama  = $('#inputnama').val();

		$("#inputppn, #inputnormal,#inputtax").keyup(function() {
			var inputnormal  = $("#inputnormal").val();
			var inputppn = $("#inputppn").val();
			var inputtax = $("#inputtax").val();

			var total = parseInt(inputnormal) + (parseInt(inputnormal) * parseInt(inputppn) / 100) + parseInt(inputtax);

			$("#inputtarif").val(total);
		});


		$("#Form").on('submit',(function(e) {
			e.preventDefault();
			$.ajax({
				url: '_keterangan_tarif/_proses.php?Update',
				type: "POST",
				data:  new FormData(this),
				contentType: false,
				cache: false,
				processData:false,
				dataType: "JSON",
				success: function (respone) {
					if (respone.status == 'success') {
						swal.fire({
							title: respone.status,
							text: respone.message,
							icon: respone.status
						}).then(function(){ 
							window.location = "?Halaman=_keterangan_tarif&Data="+inputnama;
						}
						);
					} else{
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
		}));

	</script>