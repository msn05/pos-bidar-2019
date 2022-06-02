<?php
require_once(__DIR__.'/../../_function/url.php');
require_once(__DIR__.'/../../_function/database.php');


if(isset($_GET['Cari'])){
	$inputjasa = $_POST['inputjasa'];
	$Tanggal1=$_POST['tanggal1'];
	$Tanggal2=$_POST['tanggal2'];
	if ($inputjasa != '') {
		if ($inputjasa == 1) {
			$CeKKetentuan = mysqli_query($conn,"select * from perhitungan_tarif_jasa");
			if (mysqli_num_rows($CeKKetentuan) > 0) {
				$respone = [
					'status' => 'success',
					'message'=> 'Data Tersedia',
					'Id'	=>$inputjasa,
					'tanggal1'=>'NULL',
					'tanggal2'=>'NUll',
				];
			}else{
				$respone = [
					'status' => 'error',
					'message'=> 'Data Tidak Tersedia',
				];
			}
		}elseif($inputjasa == 2){
			$CeKKetentuans = mysqli_query($conn,"select * from keterangan_tarif");
			if (mysqli_num_rows($CeKKetentuans) > 0) {
				$respone = [
					'status' => 'success',
					'message'=> 'Data Tersedia',
					'Id'	=>$inputjasa,
					'tanggal1'=>'NULL',
					'tanggal2'=>'NUll',
				];
			}else{
				$respone = [
					'status' => 'error',
					'message'=> 'Data Tidak Tersedia',
				];
			}
		}elseif($inputjasa == 3){
			if ($Tanggal1 != '' && $Tanggal2 != '') {
				$CeKKetentuanss = mysqli_query($conn,"select * from jasa where tanggal_dibuat between  '".$Tanggal1."' and '".$Tanggal2."'");
				if (mysqli_num_rows($CeKKetentuanss) > 0) {
					$respone = [
						'status' => 'success',
						'message'=> 'Data Tersedia',
						'Id'	=>$inputjasa,
						'tanggal1'=>$Tanggal1,
						'tanggal2'=>$Tanggal2,
					];
				}else{
					$respone = [
						'status' => 'error',
						'message'=> 'Data Tidak Tersedia',
					];
				}
			}else{
				$CeKKetentuanss = mysqli_query($conn,"select * from jasa ");
				if (mysqli_num_rows($CeKKetentuanss) > 0) {
					$respone = [
						'status' => 'success',
						'message'=> 'Data Tersedia',
						'Id'	=>$inputjasa,
						'tanggal1'=>'NULL',
						'tanggal2'=>'NULL',
					];
				}else{
					$respone = [
						'status' => 'error',
						'message'=> 'Data Tidak Tersedia',
					];
				}
			}

		}elseif ($inputjasa == 4) {
			if ($Tanggal1 != '' && $Tanggal2 != '') {
				$CeKKetentuansss = mysqli_query($conn,"select * from pemesanan where tanggal_pemesanan between  '".$Tanggal1."' and '".$Tanggal2."'");
				if (mysqli_num_rows($CeKKetentuansss) > 0) {
					$respone = [
						'status' => 'success',
						'message'=> 'Data Tersedia',
						'Id'	=>$inputjasa,
						'tanggal1'=>$Tanggal1,
						'tanggal2'=>$Tanggal2,
					];
				}else{
					$respone = [
						'status' => 'error',
						'message'=> 'Data Tidak Tersedia',
					];
				}
			}else{
				$CeKKetentuanss = mysqli_query($conn,"select * from pemesanan ");
				if (mysqli_num_rows($CeKKetentuanss) > 0) {
					$respone = [
						'status' => 'success',
						'message'=> 'Data Tersedia',
						'Id'	=>$inputjasa,
						'tanggal1'=>'NULL',
						'tanggal2'=>'NULL',
					];
				}else{
					$respone = [
						'status' => 'error',
						'message'=> 'Data Tidak Tersedia',
					];
				}
			}
		}
	}else{
		$respone = [
			'status' => 'error',
			'message'=> 'Anda Tidak memilih jenis laporan',
		];
	}
}
echo json_encode($respone);