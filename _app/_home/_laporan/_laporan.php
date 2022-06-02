 <div class="content-page">
 	<div class="content">
 		<div class="container-fluid">
 			<div class="row">
 				<div class="col-12">
 					<div class="page-title-box">
 						<div class="page-title-right">
 							<ol class="breadcrumb m-0">
 								<li class="breadcrumb-item"><a href="javascript: void(0);">SIPT POS </a></li>
 								<li class="breadcrumb-item active">Laporan</li>
 							</ol>
 						</div>
 						<h4 class="page-title">Data Laporan</h4>
 					</div>
 				</div>
 			</div> 
 			<form id="Form" method="POST">
 				
 				<div class="row">
 					<div class="col-12">
 						<div class="card">
 							<div class="card-body">
 								<h4 class="header-title"> Form Laporan</h4>
 								<div class="form-row">
 									<div class="form-group col-md-4">
 										<label for="inputEmail4" class="col-form-label">Tipe Laporan</label>
 										<select class="form-control" name="inputjasa" id="inputjasa" data-style="btn-light">
 											<option value="">Pilih</option>
 											<option value="1">Ketentuan Perhitungan</option>
 											<option value="2">Ketentuan Tarif</option>
 											<option value="3">Jasa</option>
 											<option value="4">Bea Jasa</option>
 										</select>
 										
 									</div>
 									<div class="form-group col-md-4">
 										<label for="inputPassword4" class="col-form-label">Tanggal 1</label>
 										<input type="date" class="form-control" name="tanggal1" id="tanggal1" placeholder="Pilih Tanggal pertama pencarian">
 									</div>
 									<div class="form-group col-md-4">
 										<label for="inputEmail4" class="col-form-label">Tanggal 2</label>
 										<input type="date" class="form-control" name="tanggal2" id="tanggal2" placeholder="Pilih Tanggal kedua pencarian">
 									</div>
 								</div>
 								<hr>
 								<div class="form-group mb-0 justify-content-end row">
 									<button type="submit" id="PostData" class="mr-2 btn btn-primary waves-effect waves-light">Cari</button>
 								</div>
 							</div> 
 						</div>
 					</div> 
 				</div>
 			</form>
 			<div id="Data"></div>
 		</div>
 	</div>
 </div>
 <script>
 	$("#Form").on('submit',(function(e) {
 		e.preventDefault();
 		var Form = $(this);
 		$.ajax({
 			url: '_laporan/_proses.php?Cari',
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
 						window.location = "?Halaman=_laporan&Aksi=_info&Id="+respone.Id+"&tanggal1="+respone.tanggal1+"&tanggal2="+respone.tanggal2;
 					}
 					);
 				} else{
 					swal.fire({
 						title: respone.status,
 						text: respone.message,
 						icon: respone.status
 					}).then(function(){ 
 					}
 					);
 				}
 			}
 		});
 	}));

 </script>

