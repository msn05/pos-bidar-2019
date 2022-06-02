<?php
require_once(__DIR__.'/../../_function/url.php');
require_once(__DIR__.'/../../_function/database.php');

if(isset($_GET['Simpan'])){
	$id = $_POST['id'];
	$inputjasa = $_POST['inputjasa'];
	$dateTime = date('Y-m-d H:i:s');

	if($id != NULL){
		if ($inputjasa != '') {
			if($inputjasa == 3){
				$GETKodePemesanan = mysqli_fetch_array(mysqli_query($conn,"select * from pengiriman join pembayaran on pembayaran.id_pembayaran=pengiriman.id_pembayaran join pemesanan on pemesanan.kode_pemesanan=pembayaran.kode_pemesanan"));
				$InsertData = mysqli_query($conn,"UPDATE `pengiriman` SET tanggal_pengiriman='$dateTime',lock_pengiriman='$inputjasa' WHERE id_pengiriman_barang='".$id."'");
				$UpdatePemesanan = mysqli_query($conn,"UPDATE `pemesanan` SET pengiriman_status='$inputjasa' WHERE kode_pemesanan='".$GETKodePemesanan['kode_pemesanan']."'");
				$respone = [
					'status' => 'success',
					'message'=> 'Berhasil Update',
				];
			}else{
				$InsertData = mysqli_query($conn,"UPDATE `pengiriman` SET tanggal_pengiriman='$dateTime',lock_pengiriman='$inputjasa' WHERE id_pengiriman_barang='".$id."'");
				if ($InsertData == true) {
					$respone = [
						'status' => 'success',
						'message'=> 'Berhasil Update',
					];
				}else{
					$respone = [
						'status' => 'error',
						'message'=> 'Gagal Update ',
					];
				}
			}
		}else{
			$respone = [
				'status' => 'error',
				'message'=> 'Maaf Anda Tidak Memilih Status Pengiriaman ',
			];
		}
	}else{
		$respone = [
			'status' => 'error',
			'message'=> 'Terjadi Kesalahan ',
		];
	}

}

echo json_encode($respone);