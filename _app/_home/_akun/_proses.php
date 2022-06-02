<?php
require_once(__DIR__.'/../../_function/url.php');
require_once(__DIR__.'/../../_function/database.php');

if(isset($_GET['Update'])){
	$id 		= $_POST['inputid'];
	$inputnama 	= $_POST['inputnama'];
	$inputketentuan = $_POST['inputketentuan'];
	$inputjarak = $_POST['inputjarak'];
	$inputkirim = $_POST['inputkirim'];

	if ($inputjarak != '' && $inputkirim != '') {

		if ($inputjarak == $inputkirim) {
			$passwordbaru = password_hash($inputjarak, PASSWORD_DEFAULT);
			$Updatenama = mysqli_query($conn,"update `keterangan_login` set nama_pengguna='$inputnama' where id='".$id."'");
			$Update = mysqli_query($conn,"UPDATE `users` SET password='$passwordbaru' WHERE id_keterangan_data='".$id."'");
			$respone = [
				'status' => 'success',
				'message'=> 'Berhasil',
			];
		}else{
			$respone = [
				'status' => 'error',
				'message'=> 'Maaf Password Tidak Sama',
			];
		}

	}else{
		$Updatenama = mysqli_query($conn,"update `keterangan_login` set nama_pengguna='$inputnama' where id='".$id."'");
		$respone = [
			'status' => 'success',
			'message'=> 'Berhasil',
		];
	}

}
echo json_encode($respone);