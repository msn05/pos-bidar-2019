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
							$namaKode = mysqli_fetch_array(mysqli_query($conn,"select * from jasa where id='".$_GET['Data']."'"));
							?>							
							<form id="Form"   method="POST">
								<div class="form-row">
									<div class="form-group col-md-3">
										<label for="inputEmail4" class="col-form-label">Kode Jasa</label>
										<input type="hidden" class="form-control" value="<?=$namaKode['id'];?>" id="inputnama" name="inputnama" placeholder="Kode Jasa" readonly/>
										<input type="text" class="form-control" value="<?=$namaKode['nama_jasa'];?>" readonly/>
									</div>
									<div class="form-group col-md-3">
										<label for="inputPassword4" class="col-form-label">Nama Ketentuan</label>
										<select class="form-control" name="inputketentuan" id="inputketentuan" data-style="btn-light" required/>
 										
 											<option value="1">Dokumen</option>
 											<option value="2">Barang Sedang</option>
 											<option value="3">Barang Besar</option>
 								
 										</select>
									
									
									</div>
									<div class="form-group col-md-3">
										<label for="inputEmail4" class="col-form-label">Jarak</label>
										<input type="text" class="form-control" id="inputjarak" name="inputjarak" value="1" readonly/>
									</div>
									<div class="form-group col-md-3">
										<label for="inputPassword4" class="col-form-label">Kecepatan Kirim</label>
										<input type="number" class="form-control" id="inputkirim" name="inputkirim" placeholder='Kecepatan Kirim' required/>
									</div>
								</div>

								<div class="form-group row ">
									<label for="inputPassword4" class="col-3 col-form-label">Harga</label>
									<div class="col-4">
										<input type="number" class="form-control" id="inputnormal" name="inputnormal" placeholder="Harga Jasa Awal'" required/>
									</div>
									<label for="inputPassword3" class="col-5 col-form-label">dalam satuan rupiah (Rp)</label>
								</div>

								<div class="form-group row ">
									<label for="inputPassword3" class="col-3 col-form-label">Berat (KG)</label>
									<div class="col-4">
										<input type="number" class="form-control" id="inputberat" name="inputberat" value='1' placeholder="Berat Barang" readonly/>
									</div>
									<label for="inputPassword3" class="col-5 col-form-label">dalam Kilo Gram (KG)</label>
								</div>
								<div class="form-group row ">
									<label for="inputPassword3" class="col-3 col-form-label">PPN %</label>
									<div class="col-4">
										<input type="number" class="form-control" id="inputppn" name="inputppn" placeholder="PPN berapa %" required/>
									</div>
									<label for="inputPassword3" class="col-5 col-form-label">dalam satuan persen (%)</label>
								</div>
								<div class="form-group row ">
									<label for="inputPassword5" class="col-3 col-form-label">Tax Admin</label>
									<div class="col-4">
										<input type="number" class="form-control" id="inputtax" name="inputtax" required/>
									</div>
									<label for="inputPassword3" class="col-5 col-form-label">dalam satuan rupiah (Rp)</label>
								</div>
								<div class="form-group row ">
									<label for="inputPassword5" class="col-3 col-form-label">Tarif</label>
									<div class="col-4">
										<input type="number" class="form-control" id="inputtarif" name="inputtarif" readonly/>
									</div>
									<label for="inputPassword3" class="col-5 col-form-label">dalam satuan rupiah (Rp)</label>
								</div>

								<hr>
								<button type="submit" id="PostData" class="btn btn-primary waves-effect waves-light">Save</button>
								<a href="?Halaman=_jasa">
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
				url: '_ketentuan_jasa/_proses.php?Kirim',
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
							icon: respone.status,
							confirmButtonClass:"btn btn-confirm mt-2"
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