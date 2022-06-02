<?php
require_once(__DIR__.'/../../_function/url.php');
require_once(__DIR__.'/../../_function/database.php');

if (isset($_GET['Kirim'])) {
	session_start();
	$inputnama 		 = $_POST['inputnama'];
	$inputjasa  	 = $_POST['inputjasa'];
	$inputtanggal  	 = $_POST['inputtanggal'];
	$idSession 		 = $_SESSION['id'];

	if (!empty($inputnama)  && !empty($inputjasa) && !empty($inputtanggal)) {

		if ($inputnama != '') {
			if ($inputjasa != '') {
				if ($inputtanggal != '') {
					$CekIn = mysqli_query($conn,"select kode_jasa,nama_jasa,aktif from jasa where kode_jasa='".$inputnama."' and nama_jasa='".$inputjasa."' and aktif='1' || kode_jasa='".$inputnama."' and aktif='1' || nama_jasa='".$inputjasa."'");
					if (mysqli_num_rows($CekIn) > 0) {
						$respone = [
							'status' => 'error',
							'message'=> 'Jasa Sudah Ada dan masih Aktif',
						];
					}else{
						$InsertKetLogin = mysqli_query($conn,"INSERT INTO `jasa`(`id`, `kode_jasa`, `nama_jasa`, `tanggal_dibuat`, `id_users`, `aktif`) VALUES ('','$inputnama','$inputjasa','$inputtanggal','$idSession','1')");
						$respone = [
							'status' => 'success',
							'message'=> 'Berhasil',
						];
					}
				}else{
					$respone = [
						'status' => 'error',
						'message'=> 'Tanggal Kosong ',
					];
				}
			}else{
				$respone = [
					'status' => 'error',
					'message'=> 'Nama Jasa Kosong ',
				];
			}
		}else{
			$respone = [
				'status' => 'error',
				'message'=> 'Kode Jasa Kosong ',
			];
		}
	}else{
		$respone = [
			'status' => 'error',
			'message'=> 'Mohon Periksa Form Kembali',
		];
	}

}elseif (isset($_GET['Ubah'])) {

	$inputnama 		 = $_POST['inputnama'];
	$inputjasa  = $_POST['inputjasa'];
	$inputtanggal 	 = $_POST['inputtanggal'];
	$inputid  	 = $_POST['inputid'];


	$DataInputCek = mysqli_fetch_array(mysqli_query($conn,"select * from jasa where id='".$inputid."'"));
	if ($inputid != '') {
		if ($inputnama == $DataInputCek['kode_jasa']) {
			if ($inputjasa == $DataInputCek['nama_jasa']) {
				$InsertBaru = mysqli_query($conn,"UPDATE `jasa` SET kode_jasa='$inputnama', nama_jasa='$inputjasa',tanggal_dibuat='$inputtanggal.'  WHERE id='".$inputid."'");
				$respone = [
					'status' => 'success',
					'message'=> 'Berhasil',
				];
			}else{
				$CekIn = mysqli_query($conn,"select nama_jasa,kode_jasa from jasa where kode_jasa='".$inputnama."' and nama_jasa='".$inputjasa."'");
				if (mysqli_num_rows($CekIn) > 0) {
					$respone = [
						'status' => 'error',
						'message'=> 'Kode atau Nama Jasa Sudah Ada',
					];
				}else{
					$InsertBaru = mysqli_query($conn,"UPDATE `jasa` SET kode_jasa='$inputnama', nama_jasa='$inputjasa',tanggal_dibuat='$inputtanggal.'  WHERE id='".$inputid."'");
					$respone = [
						'status' => 'success',
						'message'=> 'Berhasil',
					];
				}	
			}	
		}else{
			$CekIn = mysqli_query($conn,"select nama_jasa,kode_jasa from jasa where kode_jasa='".$inputnama."' ");
			if (mysqli_num_rows($CekIn) > 0) {
				$respone = [
					'status' => 'error',
					'message'=> 'Kode Jasa Sudah Ada',
				];
			}else{
				$CekIns = mysqli_query($conn,"select nama_jasa,kode_jasa from jasa where nama_jasa='".$inputjasa."' and kode_jasa='".$inputjasa."'");
				if (mysqli_num_rows($CekIns) > 0) {
					$respone = [
						'status' => 'error',
						'message'=> 'Kode dan Nama Jasa Sudah Ada',
					];
				}else{
					$InsertBaru = mysqli_query($conn,"UPDATE `jasa` SET kode_jasa='$inputnama', nama_jasa='$inputjasa',tanggal_dibuat='$inputtanggal.'  WHERE id='".$inputid."'");
					$respone = [
						'status' => 'success',
						'message'=> 'Berhasil',
					];
				}
			}
		}

	}else{
		$respone = [
			'status' => 'error',
			'message'=> 'Gagal',
		];
	}
}elseif(isset($_GET['Delete'])){
	$id = 	$_POST['id'];
	if($id != ''){
		$DeleteId = mysqli_query($conn,"UPDATE `jasa` SET aktif='2' WHERE id='".$id."'");
		if ($DeleteId == true) {
			$respone = [
				'status' => 'success',
				'message'=> 'Berhasil',
			];
		}else{
			$respone = [
				'status' => 'error',
				'message'=> 'Gagal',
			];
		}
	}
}

echo json_encode($respone);
