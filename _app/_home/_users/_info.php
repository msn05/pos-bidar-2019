<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="page-title-box">
						<div class="page-title-right">
							<ol class="breadcrumb m-0">
								<li class="breadcrumb-item"><a href="javascript: void(0);">SIPT POS </a></li>
								<li class="breadcrumb-item active">Users</li>
							</ol>
						</div>
						<h4 class="page-title">Users</h4>
					</div>
				</div>
			</div> 
			<div class="row">
				<div class="col-xl-6">
					<div class="card">
						<div class="card-body">
							<?php
							if ($_GET['Data'] != '') {
								$Users = mysqli_fetch_array(mysqli_query($conn,"select * from users as a join keterangan_login as b on b.id=a.id_keterangan_data join level as c on c.id_level=b.level_pengguna where a.id_keterangan_data='".$_GET['Data']."'"));
								$I = $Users['level_pengguna'];
							}
							?>
							<h4 class="header-title mb-3"> Form Ubah Data Atas Nama <?=$Users['nama_pengguna'];?></h4>

							<form id="UpdateData" enctype="multipart/form-data" method="POST">
								<div id="basicwizard">
									<ul class="nav nav-pills bg-light nav-justified form-wizard-header mb-4">
										<li class="nav-item">
											<a href="#basictab1" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2"> <i class="mdi mdi-account-circle mr-1"></i>
												<span class="d-none d-sm-inline">Akun</span>
											</a>
										</li>
										<li class="nav-item">
											<a href="#basictab2" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
												<i class="mdi mdi-face-profile mr-1"></i>
												<span class="d-none d-sm-inline">Profile</span>
											</a>
										</li>
									</ul>
									<div class="tab-content b-0 mb-0 pt-0">
										<div class="tab-pane" id="basictab1">
											<div class="row">
												<div class="col-12">
													<div class="form-row">
														<div class="form-group col-md-3">
															<label for="inputEmail4" class="col-form-label">Nama Pengguna</label>
															<input type="text" class="form-control" value="<?=$Users['nama_pengguna'];?>" id="inputnama" name="inputnama" placeholder="Nama Pengguna" required/>
														</div>
														<div class="form-group col-md-3">
															<label for="inputPassword4" class="col-form-label">Kode Login</label>
															<input type="text" class="form-control" id="inputkodelogin" name="inputkodelogin" value="<?=$Users['kode_login'];?>" readonly/>
														</div>
														<div class="form-group col-md-3">
															<label for="inputAddress" class="col-form-label">Password</label>
															<input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Password">
														</div>
														<div class="form-group col-md-3">
															<label for="inputAddress" class="col-form-label">Repeat</label>
															<input type="password" class="form-control" id="inputPassword2" name="inputPassword2" placeholder="Password Verifive">
														</div>
													</div>
													<div class="form-row">
														<div class="form-group col-md-3">
															<label for="inputAddress" class="col-form-label">Tanggal Lahir</label>
															<input type="date" class="form-control" value="<?=$Users['tanggal_lahir'];?>" name="datetanggal" id="datetanggal" placeholder="Password Nya" required="">
														</div>

														<div class="form-group col-6">
															<label for="inputAddress2" class="col-form-label">Tempat Lahir</label>
															<input type="text" class="form-control" value="<?=$Users['tempat_lahir'];?>" id="texttempat" name="texttempat" placeholder="Tempat Lahir" required="">
														</div>
														<div class="form-group col-md-3">
															<label for="inputState" class="col-form-label">Level</label>
															<select id="optionLevel" name="optionLevel" class="form-control" required="">
																<option>Pilih</option>
																<?php 
																$Level = mysqli_query($conn,"select * from level where nama_level !='admin'");
																while($DataLevel = mysqli_fetch_array($Level)){?>
																	<option value="<?=$DataLevel['id_level'];?>"<?=$I == $DataLevel['id_level'] ? 'selected' : '';?>><?=$DataLevel['nama_level'];?></option>
																<?php }?>
															</select>
														</div>
													</div>
													<div class="form-row">
														<div class="col-lg-4">
															<label for="inputState" class="col-form-label">Nomor Telphone</label>
															<input type="text" maxlength="12" value="<?=$Users['no_telphone'];?>" id="textnomor" class="form-control" name="textnomor"  />
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="tab-pane" id="basictab2">
											<div class="row">
												<div class="col-12">
													<div class="form-row">
														<div class="col-lg-6">
															<label for="inputState" class="col-form-label">File Upload Foto</label>
															<input type="file" id="foto" class="form-control" name="foto"  />
														</div>

														<div class="col-lg-6">
															<label for="inputState" class="col-form-label">Foto</label>
															<img  height="100px"  src="<?=Image('foto/'.$Users['foto_pengguna']);?>">
														</div>
													</div>
												</div>
											</div>
											<br>
											<button type="submit" id="PostData" class="btn btn-primary waves-effect waves-light">Update</button>
											<a href="?Halaman=_users">
												<button type="button" id="PostData" class="btn btn-info waves-effect waves-light">Back</button>
											</a>
										</div>
									</div>
								</div>

							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="<?=Assets('');?>/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script> <script src="<?=Assets('');?>/js/pages/form-wizard.init.js"></script>

<script>
	$("#UpdateData").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
			url: '_users/_proses.php?Update',
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
					window.location = "?Halaman=_users";
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