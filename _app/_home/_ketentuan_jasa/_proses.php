<?php
require_once(__DIR__.'/../../_function/url.php');
require_once(__DIR__.'/../../_function/database.php');

if (isset($_GET['Kirim'])) {
	$inputnama 		 = $_POST['inputnama'];
	$inputketentuan  	 = $_POST['inputketentuan'];
	$inputjarak  	 = $_POST['inputjarak'];
	$inputnormal  	 = $_POST['inputnormal'];
	$inputberat  	 = $_POST['inputberat'];
	$inputppn  	 = $_POST['inputppn'];
	$inputtax  	 = $_POST['inputtax'];
	$inputtarif  	 = $_POST['inputtarif'];
	$inputkirim  	 = $_POST['inputkirim'];
	$tarif = rand(1000,99999);
	$tarifid = rand(1000,99999);
	if (!empty($inputnormal)  && !empty($inputketentuan) && !empty($inputjarak) && !empty($inputberat) && !empty($inputppn) && !empty($inputtax) && !empty($inputtarif) && !empty($inputkirim)) {

		if ($inputnormal != '') {
			if ($inputketentuan != '') {
				if ($inputjarak != '') {
					if ($inputppn != '') {
						if ($inputtax != '') {
							if ($inputkirim != '') {
								$CekIn = mysqli_query($conn,"select * from ketentuan_jasa  where kode_jasa='".$inputnama."' and nama_ketentuan='".$inputketentuan."'");
								if (mysqli_num_rows($CekIn) > 0) {
									$respone = [
										'status' => 'error',
										'message'=> 'Maaf Sudah Tidak Bisa Menambahkan lagi ketentuan harga pada ketentuan ini',
									];
								}else{
									$InsertKet = mysqli_query($conn,"INSERT INTO `ketentuan_jasa`(`id`, `kode_jasa`, `nama_ketentuan`, `id_tarif`) VALUES ('$tarif','$inputnama','$inputketentuan','$tarifid')");
									$PerhitunganTarifData = mysqli_query($conn,"select * from perhitungan_tarif_jasa order by id_perhitungan_tarif asc");
									while ($DataTarif = mysqli_fetch_array($PerhitunganTarifData)) {
										$idData[] = $DataTarif['id_perhitungan_tarif'];
									}
									$InsertTarif = mysqli_query($conn,"INSERT INTO `tarif`(`id_perhitungan_tarif_jasa`, `nilai`, `id`, `id_ketentuan_jasa`, `group_keterangan`) VALUES ('".$idData[0]."','$inputnormal','','$tarif','$tarifid')");
									$InsertTarif1 = mysqli_query($conn,"INSERT INTO `tarif`(`id_perhitungan_tarif_jasa`, `nilai`, `id`, `id_ketentuan_jasa`, `group_keterangan`) VALUES ('".$idData[1]."','$inputtax','','$tarif','$tarifid')");
									$InsertTarif2 = mysqli_query($conn,"INSERT INTO `tarif`(`id_perhitungan_tarif_jasa`, `nilai`, `id`, `id_ketentuan_jasa`, `group_keterangan`) VALUES ('".$idData[2]."','$inputppn','','$tarif','$tarifid')");

									$InsertKeteranganTarif = mysqli_query($conn,"INSERT INTO `keterangan_tarif`(`id_keterangan_tarif`, `id_tarif_keterangan`, `jarak`, `berat`, `total_tarif_nilai`,`kecepatan_kirim`) VALUES ('','$tarifid','$inputjarak','$inputberat','$inputtarif','$inputkirim')");
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
	echo json_encode($respone);

}
