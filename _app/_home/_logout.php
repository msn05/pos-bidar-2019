<?php
session_start();
session_destroy();

require_once(__DIR__.'/../_function/url.php');
require_once(__DIR__.'/../_function/database.php');

$name 		= $_POST['id']; 
if (!empty($name)) {
	unset($name);
	$respone = [
		'status' => 'success',
		'message'=> 'Anda Berhasil Keluar....!',
	];
}else{
	$respone = [
		'status' => 'error',
		'message'=> 'Terjadi Kesalahan....!',
	];
}
echo json_encode($respone);