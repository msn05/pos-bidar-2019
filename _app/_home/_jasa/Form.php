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
						<h4 class="page-title">Daftar Jasa</h4>
					</div>
				</div>
			</div> 

			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<h4 class="header-title">Form Tambah Jasa</h4>
							<form id="Form"  enctype="multipart/form-data" method="POST">
								<div class="form-row">
									<div class="form-group col-md-4">
										<label for="inputEmail4" class="col-form-label">Kode Jasa</label>
										<input type="text" class="form-control" id="inputnama" name="inputnama" placeholder="Kode Jasa" required/>
									</div>
									<div class="form-group col-md-4">
										<label for="inputPassword4" class="col-form-label">Nama Jasa</label>
										<input type="text" class="form-control" id="inputjasa" name="inputjasa" placeholder="Nama Jasa" required/>
									</div>
									<div class="form-group col-md-4">
										<label for="inputAddress" class="col-form-label">Tanggal Dibuat</label>
										<input type="date" class="form-control" id="inputtanggal" name="inputtanggal" placeholder="Password" required="">
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
			$.ajax({
				url: '_jasa/_proses.php?Kirim',
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
							location.reload(true);
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