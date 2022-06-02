<?php
require_once(__DIR__.'/../../_function/url.php');
require_once(__DIR__.'/../../_function/database.php');

if(isset($_GET['Update'])){
	
	$inputid 	= $_POST['inputid'];
	$inputnama 	= $_POST['inputnama'];
	$alamat 	= $_POST['alamat'];
	$inputhp1	= $_POST['inputhp1'];

	if ($inputid != '') {
		$CekDataLama = mysqli_fetch_array(mysqli_query($conn,"select * from penerima where id_penerima='".$inputid."'"));
		if ($inputhp1 == $CekDataLama['no_telp']) {
			$InsertData = mysqli_query($conn,"UPDATE `penerima` SET nama='$inputnama',alamat='$alamat',no_telp='$inputhp1' WHERE id_penerima='".$inputid."'");
			$respone = [
				'status' => 'success',
				'message'=> 'Berhasil ',
			];
		}else{
			$CekDataLamaId = mysqli_query($conn,"select * from penerima where no_telp='".$inputhp1."'");
			if (mysqli_num_rows($CekDataLamaId) > 0) {
				$respone = [
					'status' => 'error',
					'message'=> 'Nomor Telphone Sudah Ada',
				];
			}else{
				$InsertData = mysqli_query($conn,"UPDATE `penerima` SET nama='$inputnama',alamat='$alamat',no_telp='$inputhp1' WHERE id_penerima='".$inputid."'");
				$respone = [
					'status' => 'success',
					'message'=> 'Berhasil ',
				];
			}
		}
	}else{
		$respone = [
			'status' => 'error',
			'message'=> 'Terjadi Kesalahan ',
		];
	}

}

echo json_encode($respone);