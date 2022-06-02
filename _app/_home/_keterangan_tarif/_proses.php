<?php
require_once(__DIR__.'/../../_function/url.php');
require_once(__DIR__.'/../../_function/database.php');

if(isset($_GET['Delete'])){
	$nameid = 	$_POST['nameid'];
	
	if($nameid != ''){
	
	$CekdataBea = mysqli_query($conn,"select * from pemesanan where id_jasa='".$nameid."'");
if(mysqli_num_rows($CekdataBea) > 0 ){

$respone = [
				'status' => 'error',
				'message'=> 'Data Telah digunakan pada bea jasa',
			];
}else{

	$DeleteData = mysqli_query($conn,"DELETE FROM `tarif` WHERE id_ketentuan_jasa='".$nameid."'");
		if ($DeleteData == true) {
			$DeleteData2 = mysqli_query($conn,"DELETE FROM `ketentuan_jasa` where id='".$nameid."'");

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

	}else{
		$respone = [
			'status' => 'error',
			'message'=> 'Terjadi Kesalahan',
		];
	}

}elseif (isset($_GET['Update'])) {
	$inputnama 		 = $_POST['inputnama'];
	$inputketentuan  	 = $_POST['inputketentuan'];

	$inputjarak  	 = $_POST['inputjarak'];
	$inputnormal  	 = $_POST['inputnormal'];
$groupid 	 = $_POST['groupid'];

	$inputberat  	 = $_POST['inputberat'];
	$inputppn  	 = $_POST['inputppn'];
	$inputtax  	 = $_POST['inputtax'];
	$inputtarif  	 = $_POST['inputtarif'];
	$inputkirim  	 = $_POST['inputkirim'];
	$tarif = rand(1000,99999);
	$tarifid = rand(1000,99999);
	
	$GetDataLama = mysqli_fetch_array(mysqli_query($conn,"select * from ketentuan_jasa where kode_jasa='".$inputnama."' "));

	
	$OKE = $GetDataLama['id'];

	if (!empty($inputnormal)  && !empty($inputketentuan) && !empty($inputjarak) && !empty($inputberat) && !empty($inputppn) && !empty($inputtax) && !empty($inputtarif) && !empty($inputkirim)) {
        
		if ($inputnormal != '') {
			if ($inputketentuan != '') {
				if ($inputjarak != '') {
					if ($inputppn != '') {
						if ($inputtax != '') {
							if ($inputkirim != '') {
							    if($inputketentuan != $GetDataLama['nama_ketentuan'] && $inputnama != $GetDataLama['kode_jasa']){
								$CekIn = mysqli_query($conn,"select * from ketentuan_jasa  where kode_jasa='".$inputnama."' and nama_ketentuan='".$inputketentuan."'");
								if (mysqli_num_rows($CekIn) > 0) {
									$respone = [
										'status' => 'error',
										'message'=> 'Maaf Sudah Tidak Bisa Mengubah Data ini Karena Sudah Ada',
									];
								}else{
									$InsertKet = mysqli_query($conn,"
									update ketentuan_jasa set kode_jasa='.$inputnama', nama_ketentuan='.$inputketentuan' where id='".$GetDataLama['id']."'");
									$PerhitunganTarifData = mysqli_query($conn,"select * from perhitungan_tarif_jasa order by id_perhitungan_tarif asc");
									while ($DataTarif = mysqli_fetch_array($PerhitunganTarifData)) {
										$idData[] = $DataTarif['id_perhitungan_tarif'];
									}
									$InsertTarif = mysqli_query($conn,"update `tarif` set nilai='.$inputnormal.' where id_ketentuan_jasa='".$GetDataLama['id']."' and id_perhitungan_tarif_jasa='".$idData[0]."' and group_keterangan='".$groupid."'");
									
									$InsertTarif1 = mysqli_query($conn,"update `tarif` set nilai='.$inputppn.' where id_ketentuan_jasa='".$GetDataLama['id']."' and id_perhitungan_tarif_jasa='".$idData[1]."' and group_keterangan='".$groupid."'");
									$InsertTarif2 = mysqli_query($conn,"update `tarif` set nilai='.$inputtax.' where id_ketentuan_jasa='".$GetDataLama['id']."' and id_perhitungan_tarif_jasa='".$idData[2]."' and group_keterangan='".$groupid."'");

									$InsertKeteranganTarif = mysqli_query($conn,"update `keterangan_tarif` set total_tarif_nilai='$inputtarif', kecepatan_kirim='$inputkirim' where id_tarif_keterangan='".$groupid."'");
								
									$respone = [
										'status' => 'success',
										'message'=> 'Berhasil',
									];
								}
							
							}else{
$PerhitunganTarifData = mysqli_query($conn,"select * from perhitungan_tarif_jasa order by id_perhitungan_tarif asc");
									while ($DataTarif = mysqli_fetch_array($PerhitunganTarifData)) {
										$idData[] = $DataTarif['id_perhitungan_tarif'];
									}
								$InsertTarif = mysqli_query($conn,"update `tarif` set nilai='.$inputnormal.' where id_ketentuan_jasa='".$GetDataLama['id']."' and id_perhitungan_tarif_jasa='".$idData[0]."' and group_keterangan='".$groupid."'");
									
									$InsertTarif1 = mysqli_query($conn,"update `tarif` set nilai='.$inputppn.' where id_ketentuan_jasa='".$GetDataLama['id']."' and id_perhitungan_tarif_jasa='".$idData[1]."' and group_keterangan='".$groupid."'");
									$InsertTarif2 = mysqli_query($conn,"update `tarif` set nilai='.$inputtax.' where id_ketentuan_jasa='".$GetDataLama['id']."' and id_perhitungan_tarif_jasa='".$idData[2]."' and group_keterangan='".$groupid."'");

									$InsertKeteranganTarif = mysqli_query($conn,"update `keterangan_tarif` set total_tarif_nilai='$inputtarif', kecepatan_kirim='$inputkirim' where id_tarif_keterangan='".$groupid."'");
								
									$respone = [
										'status' => 'success',
										'message'=> 'Berhasil',
									];
							}
}
						}
					}
				}else{
					$respone = [
						'status' => 'error',
						'message'=> 'Jarak Tidak Boleh Kosong',
					];
				}
			}else{
				$respone = [
					'status' => 'error',
					'message'=> 'Nama ketentuan Jasa Tarif Tidak Boleh Kosong ',
				];
			}
		}else{
			$respone = [
				'status' => 'error',
				'message'=> 'Harga Tidak Boleh Kosong ',
			];
		}
	}else{
		$respone = [
			'status' => 'error',
			'message'=> 'Mohon Periksa Form Kembali',
		];
	}


}

echo json_encode($respone);
