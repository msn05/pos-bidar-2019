<?php
error_reporting(0);
require_once(__DIR__.'/../../_function/url.php');
require_once(__DIR__.'/../../_function/database.php');

if(isset($_GET['DataJasa'])){

	$inputjasa = $_POST['inputjasa'];
	echo'
	<div class="card">
	<div class="card-body">
	<h4 class="header-title">Data Jasa Jasa</h4>
	<table  class="table dt-responsive ">
	<thead>
	<tr>
	<th>Pilih</th>
	<th>Jarak</th>
	<th>Beban</th>
	<th>Lama Pengiriman</th>
	<th>Harga</th>
	</tr>
	</thead>
	<tbody>
	';
	// <input class="radio" name="inputberatketentuan" id="inputberatketentuan" value='.$KeteranganTarifNya['berat'].' type="hidden">
	// <input class="radio" name="inputjarakmaks" id="inputjarakmaks" value='.$KeteranganTarifNya['jarak'].' type="hidden">
	// <input class="radio" name="inputuang" id="inputuang" value='.$KeteranganTarifNya['total_tarif_nilai'].' type="hidden">
	$DataJasaKeterangan = mysqli_query($conn,"select * from ketentuan_jasa where kode_jasa='".$inputjasa."'");
	while ($Data = mysqli_fetch_array($DataJasaKeterangan)) {
		$GroupKeterangan = mysqli_fetch_array(mysqli_query($conn,"select * from tarif where id_ketentuan_jasa='".$Data['id']."'"));
		$KeteranganTarifNya = mysqli_fetch_array(mysqli_query($conn,"select * from keterangan_tarif where id_tarif_keterangan='".$GroupKeterangan['group_keterangan']."'"));
		echo'
		<tr>
		<td>
		<input  name="inputkodejasa" id="inputkodejasa" type="radio" name="radio" id="radio" value='.$Data['id'].'>
		
		<label for="radio">
		'.($Data['nama_ketentuan'] == 1 ? 'Dokumen' : ($Data['nama_ketentuan'] == 2 ? 'Barang Kecil' : 'Barang Besar')).'
		</label>
		</td>
		<td>'.$KeteranganTarifNya['jarak'].' Km </td>
		<td>'.$KeteranganTarifNya['berat'].' Kg </td>
		<td>'.$KeteranganTarifNya['kecepatan_kirim'].' Hari </td>
		<td>Rp. '.number_format($KeteranganTarifNya['total_tarif_nilai'],3).'<td>
		</tr>

		';

	}
	echo'</tbody>
	</table>
	</div>
	</div>
	';
	}elseif(isset($_GET['PerhitunganJarak'])){
    
	$inputkodejasa = $_POST['inputkodejasa'];
	$inputberat = $_POST['inputberat'];
	$inputjarak = $_POST['inputjarak'];
    
    if($inputkodejasa != '' && $inputberat != '' && $inputjarak != ''){
    
        
   
        $GetTarif = mysqli_fetch_array(mysqli_query($conn,"select * from ketentuan_jasa where id='".$inputkodejasa."'"));
       
        $GroupKeterangan = mysqli_fetch_array(mysqli_query($conn,"select * from tarif where id_ketentuan_jasa='".$GetTarif['id']."'"));
		$KeteranganTarifNya = mysqli_fetch_array(mysqli_query($conn,"select * from keterangan_tarif where id_tarif_keterangan='".$GroupKeterangan['group_keterangan']."'"));
       if($inputjarak > $KeteranganTarifNya['jarak'] && $inputberat <= $KeteranganTarifNya['berat']){
            $data = (($inputjarak * $KeteranganTarifNya['total_tarif_nilai'] / 2)+$KeteranganTarifNya['total_tarif_nilai']);
            echo"".$data."";
        }elseif($inputjarak <= $KeteranganTarifNya['jarak'] && $inputberat > $KeteranganTarifNya['berat']){
               $data = (($inputberat * $KeteranganTarifNya['total_tarif_nilai'] / 2)+$KeteranganTarifNya['total_tarif_nilai']);
            echo"".$data."";
        }elseif($inputjarak > $KeteranganTarifNya['jarak'] && $inputberat > $KeteranganTarifNya['berat']){
            $data = (($inputjarak * $KeteranganTarifNya['total_tarif_nilai'] / 2) + ($inputberat * $KeteranganTarifNya['total_tarif_nilai'] / 2));
            echo"".$data."";
      
        }elseif($inputjarak <= $KeteranganTarifNya['jarak'] && $inputberat <=$KeteranganTarifNya['berat']){
            echo"".$KeteranganTarifNya['total_tarif_nilai']."";
        }
          
        }else{
            echo'Terjadi Kesalahan Perhitungan. Silakan Cek Data Kembali';
        }
      
        

}elseif(isset($_GET['DeletePemesanan'])){
	$id 		= $_POST['id'];
	if ($id != '') {
		$InsertPenerima = mysqli_query($conn,"DELETE FROM `pemesanan` WHERE id='".$id."'");
		if ($InsertPenerima == true) {
			$respone = [
				'status' => 'success',
				'message'=> 'Berhasil ',
			];
		}else{
			$respone = [
				'status' => 'error',
				'message'=> 'Gagal',
			];
		}
	}else{
		$respone = [
			'status' => 'error',
			'message'=> 'Kode Kosong ',
		];
	}
	echo json_encode($respone);

}elseif(isset($_GET['Simpan'])){
	session_start();
	require_once(__DIR__.'/../../_function/_kode_unik.php');
	$inputkodejasa 	= $_POST['inputkodejasa'];

	$idSession 		= $_SESSION['id'];


	$inputnama 		= $_POST['inputnama'];
	$alamat 		= $_POST['alamat'];
	$inputhp2 		= $_POST['inputhp2'];
	$inputhp1 		= $_POST['inputhp1'];
	$inputnama2 	= $_POST['inputnama2'];
	$alamat2 		= $_POST['alamat2'];
	$inputjasa 		= $_POST['inputjasa'];

	$inputbarang 	= $_POST['inputbarang'];
	$inputberat 	= $_POST['inputberat'];
	$inputjarak 	= $_POST['inputjarak'];
	$inputuang 	    = $_POST['Jasas'];


	$inputkode 		= _pemesanan();
	$inputwaktu 	= date('Y-m-d H:i:s');
	$randPengirim   = rand(1,10000000);
	$randPenerima   = rand(1,10000000);

   if($inputjasa != ''){
   
					$CekDataInputKode = mysqli_query($conn,"select * from pemesanan  where kode_pemesanan='".$inputkode."' and pengiriman_status='1'");
					if (mysqli_num_rows($CekDataInputKode) > 0) {
						$respone = [
							'status' => 'error',
							'message'=> 'Kode Pemesanan Sudah Ada ',
						];
					}else{
						$InsertPemesanan = mysqli_query($conn,"INSERT INTO `pemesanan`(`id`, `kode_pemesanan`, `id_pengirim`, `id_penerima`, `id_jasa`, `nama_barang_pelanggan`, `berat`, `jarak`, `biaya_tarif`, `tanggal_pemesanan`, `id_users_data`, `pengiriman_status`) VALUES ('','$inputkode','$randPengirim','$randPenerima','$inputkodejasa','$inputbarang','$inputberat','$inputjarak','$inputuang','$inputwaktu','$idSession','1')");	

				// var_dump($InsertPemesanan);die();
						if ($InsertPemesanan == true) {
							$InsertPengirim = mysqli_query($conn,"INSERT INTO `pengirim`(`id_pengirim`, `nama`, `alamat`, `no_telphone`) VALUES ('$randPengirim','$inputnama','$alamat','$inputhp1')");
							$InsertPenerima = mysqli_query($conn,"INSERT INTO `penerima`(`id_penerima`, `nama`, `alamat`, `no_telp`) VALUES ('$randPenerima','$inputnama2','$alamat2','$inputhp2')");

							$respone = [
								'status' => 'success',
								'message'=> 'Berhasil ',
							];
						}else{
							$respone = [
								'status' => 'error',
								'message'=> 'Terjadi Kesalahan Pada Pengisian Form nya ',
							];
						}
					}
			

		
	}else{
		$respone = [
			'status' => 'error',
			'message'=> 'Maaf Anda Tidak Memilih Tipe Jasa nya ',
		];
	}

	echo json_encode($respone);

}elseif(isset($_GET['Update'])){
	session_start();
	require_once(__DIR__.'/../../_function/_kode_unik.php');


	$inputkodejasadata 	= $_POST['inputkodejasadata'];
	$inputkodejasa 	= $_POST['inputkodejasa'];


	$idSession 		= $_SESSION['id'];

	$inputbarang 	= $_POST['inputbarang'];
	$inputberat 	= $_POST['inputberat'];
	$inputjarak 	= $_POST['inputjarak'];
	$inputuang 	= $_POST['Jasas'];

	$inputwaktu 	= date('Y-m-d H:i:s');

	$CekDataLama = mysqli_fetch_array(mysqli_query($conn,"select * from pemesanan where id='".$inputkodejasadata."'"));

	if ($inputkodejasa == $CekDataLama['id_jasa'] && $inputberat == $CekDataLama['berat'] && $inputjarak == $CekDataLama['jarak']) {
		$respone = [
			'status' => 'success',
			'message'=> 'Tidak Ada Perubahan data  ',
		];
	}else{
	
				$InsertPengirim = mysqli_query($conn,"update pemesanan set jarak='$inputjarak',berat='$inputberat',id_jasa='$inputkodejasa',biaya_tarif='$inputuang' where id='".$inputkodejasadata."'");
				$respone = [
					'status' => 'success',
					'message'=> 'Berhasil ',
				];
		
	}


	echo json_encode($respone);
}