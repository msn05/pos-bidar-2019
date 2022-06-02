<?php
require_once(__DIR__.'/../_function/url.php');
require_once(__DIR__.'/../_function/database.php');

$emailaddress 			= $_POST['emailaddress'];
$password 		= $_POST['password'];

if ($emailaddress != '' || $password != '') {
	$CekData= mysqli_query($conn,"select * from users as a join keterangan_login as b on b.id=a.id_keterangan_data where a.kode_login='".$emailaddress."' and a.aktif='1'");
	$Data 	= mysqli_fetch_array($CekData);
	if ($Data['level_pengguna'] > 0) {
		if (mysqli_num_rows($CekData)) {
			if(password_verify($password,$Data['password'])) {
				session_start();
				$_SESSION['id']			= $Data['id'];
				$_SESSION['id_keterangan_data']		= $Data['id_keterangan_data'];
				$_SESSION['level_pengguna']		= $Data['level_pengguna'];
				$_SESSION['LogIn']		= true;
				$respone = [
					'status' => 'success',
					'message'=> 'Anda Berhasil Terverifikasi'
				];
			}else{
				$respone = [
					'status' => 'error',
					'message'=> 'Maaf Password Anda Salah...!'
				];
			}
		}else{
			$respone = [
				'status' => 'error',
				'message'=> 'Data Anda Tidak Tersedia.!'
			];

		}
	}else{
		$respone = [
			'status' => 'error',
			'message'=> 'Anda Tidak Mempunyai Aksess..!'
		];
	}

}else{
	$respone = [
		'status' => 'error',
		'message'=> 'Wajib Diisi..!'
	];
}
echo json_encode($respone);




