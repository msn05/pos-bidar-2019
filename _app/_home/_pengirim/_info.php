 <div class="content-page">
 	<div class="content">
 		<div class="container-fluid">
 			<div class="row">
 				<div class="col-12">
 					<div class="page-title-box">
 						<div class="page-title-right">
 							<ol class="breadcrumb m-0">
 								<li class="breadcrumb-item"><a href="javascript: void(0);">SIPT POS </a></li>
 								<li class="breadcrumb-item">Pelanggan</li>
 								<li class="breadcrumb-item active">Pengirim</li>
 							</ol>
 						</div>
 						<h4 class="page-title">Data Pengirim</h4>
 					</div>
 				</div>
 			</div> 
 			<form id="Form" method="POST">
 				<?php

 				$Data = $_GET['Data'];
 				$Pengirim = mysqli_fetch_array(mysqli_query($conn,"select * from pengirim where id_pengirim='".$Data."'"));
 				?>
 				<div class="row">
 					<div class="col-12">
 						<div class="card">
 							<div class="card-body">
 								<h4 class="header-title"> Jasa</h4>
 								<div class="form-row">
 									<div class="form-group col-md-3">
 										<label for="inputEmail4" class="col-form-label">Nama Pengirim</label>
 										<input type="hidden" class="form-control" value="<?=$Pengirim['id_pengirim'];?>" id="inputid" name="inputid" placeholder="Nama Pengirim" required/>
 										<input type="text" class="form-control" value="<?=$Pengirim['nama'];?>" id="inputnama" name="inputnama" placeholder="Nama Pengirim" required/>
 									</div>
 									<div class="form-group col-md-6">
 										<label for="inputPassword4" class="col-form-label">Alamat</label>
 										<textarea class="form-control"  name="alamat" id="alamat" placeholder="alamat pengirim" required/><?=$Pengirim['alamat'];?></textarea>
 									</div>
 									<div class="form-group col-md-3">
 										<label for="inputEmail4" class="col-form-label">Nomor Telphone</label>
 										<input type="number" value="<?=$Pengirim['no_telphone'];?>" class="form-control" id="inputhp1" name="inputhp1" placeholder="Nomor HP" required/>
 									</div>
 								</div>
 								<hr>
 								<div class="form-group mb-0 justify-content-end row">
 									<button type="submit" id="PostData" class="mr-2 btn btn-primary waves-effect waves-light">Save</button>
 									<a href="?Halaman=_pengirim">
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
 </div>
 <script>
 	$("#Form").on('submit',(function(e) {
 		e.preventDefault();
 		var Form = $(this);
 		$.ajax({
 			url: '_pengirim/_proses.php?Update',
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
 						window.location = "?Halaman=_pengirim";
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

