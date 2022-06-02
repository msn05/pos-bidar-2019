<?php
require_once(__DIR__.'/../../_function/url.php');
require_once(__DIR__.'/../../_function/database.php');


if(isset($_GET['Bayar'])){
	session_start();
	$idSession = $_SESSION['id'];
	$inputid 			= $_POST['inputid'];
	$inputnominal 		= $_POST['inputnominal'];
	$inputtanggals 			= $_POST['inputtanggals'];
	$inputnama 			= $_POST['inputnama'];
	$date 				= date('Y-m-d H:i:s');
	if($inputnominal != ''){
		if ($inputnominal != $inputtanggals) {
			$respone = [
				'status' => 'error',
				'message'=> 'Maaf Uang Diterima Tidak Boleh Lebih dari Jumlah Jasa sebesar '.$inputtanggals.'',
			];
		}else{
			$Maxdata = mysqli_fetch_array(mysqli_query($conn,"select id_pembayaran,max(id_pembayaran) as IdPem from pembayaran"));
			$noUrut = (int) substr($Maxdata['IdPem'], 0, 11);
			$noUrut++;

			$DeleteData = mysqli_query($conn,"select * from pembayaran where kode_pemesanan='".$inputnama."'");
			if (mysqli_num_rows($DeleteData) > 0) {
				$respone = [
					'status' => 'error',
					'message'=> 'Data Sudah Ada Sebelumnya',
				];
			}else{
				$InsertData = mysqli_query($conn,"INSERT INTO `pembayaran`(`id_pembayaran`, `kode_pemesanan`, `jumlah_bayar`, `pembayaran_status`, `id_penerima_pembayaran`, `tanggal_bayar`) VALUES ('$noUrut','$inputnama','$inputnominal','1','$idSession','$date')");
				if ($InsertData == true) {
					$DeleteData2 = mysqli_query($conn,"update pemesanan set pengiriman_status='2' where id='".$inputid."'");
					$InsertPengiriman = mysqli_query($conn,"INSERT INTO `pengiriman`(`id_pengiriman_barang`, `id_pembayaran`, `tanggal_pengiriman`, `lock_pengiriman`) VALUES ('','$noUrut',NULL,'1')");
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
	}else{
		$respone = [
			'status' => 'error',
			'message'=> 'Terjadi Kesalahan ',
		];
	}
}

echo json_encode($respone);



