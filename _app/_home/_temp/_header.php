<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8" />
	<title><?=Title();?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
	<meta content="Coderthemes" name="author" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<!-- App favicon -->
	<link rel="shortcut icon" href="<?=Fav('');?>">
	<!--<link href="<?=Assets('');?>/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />-->
	<!-- App css -->
	
	<link href="<?=Assets('');?>/css/bootstrap-material.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
	<link href="<?=Assets('');?>/css/app-material.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

	<link href="<?=Assets('');?>/css/bootstrap-material-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" disabled />
	<link href="<?=Assets('');?>/css/app-material-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet"  disabled />
	<link href="<?=Assets('');?>/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=Assets('');?>/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
	
	<!-- icons -->
	<link href="<?=Assets('');?>/css/icons.min.css" rel="stylesheet" type="text/css" />

	<script src="<?=Assets('');?>/js/vendor.min.js"></script>
	  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<!--<script src="<?=Assets('');?>/libs/sweetalert2/sweetalert2.min.js"></script>-->
	<script src="<?=Assets('');?>/libs/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="<?=Assets('');?>/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="<?=Assets('');?>/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
	<script src="<?=Assets('');?>/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
	<!--<script src="<?=Assets('');?>/libs/sweetalert2/sweetalert2.min.js"></script>-->

</head>

<body>
	<?php
	$Id_Session = $_SESSION['id'];
	$Users = mysqli_fetch_array(mysqli_query($conn,"select * from users as a join keterangan_login as b on b.id=a.id_keterangan_data join level as c on c.id_level=b.level_pengguna where a.id_keterangan_data='".$Id_Session."'"));

	?>

	<div id="wrapper">
		<div class="navbar-custom">
			<div class="container-fluid">
				<ul class="list-unstyled topnav-menu float-right mb-0">

					<li class="dropdown d-none d-lg-inline-block">
						<a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="fullscreen" href="#">
							<i class="fe-maximize noti-icon"></i>
						</a>
					</li>
					<li class="dropdown notification-list topbar-dropdown">
						<a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
							<img src="<?=Image('/foto/'.$Users['foto_pengguna'].'');?>" alt="user-image" class="rounded-circle">
							<span class="pro-user-name ml-1">
								<?=$Users['nama_pengguna'];?> <i class="mdi mdi-chevron-down"></i> 
							</span>
						</a>
						<div class="dropdown-menu dropdown-menu-right profile-dropdown ">
							<!-- item-->
							<div class="dropdown-header noti-title">
								<h6 class="text-overflow m-0">Welcome !</h6>
							</div>

							<a href="?Halaman=_akun&Data=<?=$Users['id_keterangan_data'];?>" class="dropdown-item notify-item">
								<i class="fe-settings"></i>
								<span>Settings</span>
							</a>
							<div class="dropdown-divider"></div>
							<a href="javascript:void(0);" id='<?=$Users['id_keterangan_data'];?>' class="logout dropdown-item notify-item">
								<i class="fe-log-out"></i>
								<span>Logout</span>
							</a>

						</div>
					</li>


				</ul>

				<div class="logo-box">

					<a href="web.php" class="logo logo-light text-center">
						<span class="logo-sm">
							<img src="<?=Image('');?>/logo-sm.png" alt="" height="22">
						</span>
						<span class="logo-lg">
							<img src="<?=Image('');?>/logo-light.png" alt="" height="20">
						</span>
					</a>
				</div>

				<ul class="list-unstyled topnav-menu topnav-menu-left m-0">
					<li>
						<button class="button-menu-mobile waves-effect waves-light">
							<i class="fe-menu"></i>
						</button>
					</li>

					<li>

						<a class="navbar-toggle nav-link" data-toggle="collapse" data-target="#topnav-menu-content">
							<div class="lines">
								<span></span>
								<span></span>
								<span></span>
							</div>
						</a>
						<!-- End mobile menu toggle-->
					</li>   


				</ul>
				<div class="clearfix"></div>
			</div>
		</div>

		<script type="text/javascript">
			$('.logout').on('click',function(){
				var id            		 = $(this).attr('id');
				// var nama          = $(this).attr('nama');
				Swal.fire({
					title: 'Are you sure?',
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes!'
				}).then(function(result){ 
					if (result.value) {
						$.ajax({
							type: 'POST',
							data: {id:id},
							url: '_logout.php',
							dataType: "JSON",
							cache:"false",
							success: function(respone) {
								if (respone.status == 'success') {
									swal.fire({
										title: respone.status,
										text: respone.message,
										icon: respone.status
									}).then(function(){ 
										window.location = "../index.php";

									}
									);
								}else{
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
						})
					}
				})
			});

		</script>