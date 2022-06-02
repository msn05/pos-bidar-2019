<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="page-title-box">
						<div class="page-title-right">
							<ol class="breadcrumb m-0">
								<li class="breadcrumb-item"><a href="javascript: void(0);">SIPT POS </a></li>
								<li class="breadcrumb-item active"> Setting</li>
							</ol>
						</div>
						<h4 class="page-title">Akun Setting</h4>
					</div>
				</div>
			</div> 
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<h4 class="header-title">Form Ubah Data</h4>
							<hr>
							<?php
							$id = $_GET['Data'];
							$Users = mysqli_fetch_array(mysqli_query($conn,"select * from users as a join keterangan_login as b on b.id=a.id_keterangan_data join level as c on c.id_level=b.level_pengguna where a.id_keterangan_data='".$id."'"));
							?>
							<form id="Form"   method="POST">
								<div class="form-row">
									<div class="form-group col-md-3">
										<label for="inputEmail4" class="col-form-label">Username</label>
										<input type="text" class="form-control" value="<?=$Users['nama_pengguna'];?>" id="inputnama" name="inputnama" placeholder="Kode Jasa" required/>
										<input type="hidden" class="form-control" id="inputid" name="inputid" value="<?=$Users['id'];?>" />
									</div>
									<div class="form-group col-md-3">
										<label for="inputPassword4" class="col-form-label">Kode Login</label>
										<input type="text" value="<?=$Users['kode_login'];?>" class="form-control" id="inputketentuan" name="inputketentuan" placeholder="Nama Ketentuan Jasa" readonly/>
									</div>
									<div class="form-group col-md-3">
										<label for="inputEmail4" class="col-form-label">Password</label>
										<input type="password" class="form-control" id="inputjarak" placeholder='Isi Jika Ingin Mengganti' name="inputjarak"/>
									</div>
									<div class="form-group col-md-3">
										<label for="inputPassword4" class="col-form-label">Konf Password</label>
										<input type="password" class="form-control" id="inputkirim" name="inputkirim" placeholder="Masukkan Password Lagi" />
									</div>
								</div>

								<hr>
								<button type="submit" id="PostData" class="btn btn-primary waves-effect waves-light">Update</button>
								<a href="web.php">
									<button type="button" id="PostData" class="btn btn-info waves-effect waves-light">Back</button>
								</a>
							</form>

						</div> 
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$("#Form").on('submit',(function(e) {
			e.preventDefault();
			var Form = $(this);
			var id = $(this).val('#inputid');
			$.ajax({
				url: '_akun/_proses.php?Update',
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
							location.reload(true);
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