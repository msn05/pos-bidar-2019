<?php
require_once(__DIR__.'/../../_vendors/dompdf/autoload.inc.php');
require_once(__DIR__.'/../_function/url.php');
require_once(__DIR__.'/../_function/database.php');
use Dompdf\Dompdf;
$dompdf = new Dompdf();

if (isset($_GET['Keterangan'])) {

	$Keterangan = $_GET['Keterangan'];
	if ($Keterangan == 'Pembayaran') {
		$id = $_GET['Data'];
		$PemesananData = mysqli_fetch_array(mysqli_query($conn,"select * from pemesanan join pembayaran on pembayaran.kode_pemesanan=pemesanan.kode_pemesanan where pemesanan.kode_pemesanan='".$id."'"));
		$Pengirim = mysqli_fetch_array(mysqli_query($conn,"select * from pengirim where id_pengirim='".$PemesananData['id_pengirim']."' group by id_pengirim"));
		$Penerima = mysqli_fetch_array(mysqli_query($conn,"select * from penerima where id_penerima='".$PemesananData['id_penerima']."' group by id_penerima"));
		$KetentuanTarif = mysqli_fetch_array(mysqli_query($conn,"select a.id as IdJasa,a.nama_jasa,b.id as idKetentuanJasa,b.nama_ketentuan,b.kode_jasa from jasa as a join ketentuan_jasa as b on b.kode_jasa=a.id where b.id='".$PemesananData['id_jasa']."'"));
		$GroupKeteranganData = mysqli_query($conn,"select * from tarif where id_ketentuan_jasa='".$KetentuanTarif['idKetentuanJasa']."' ");
		while ($DataKeterangan = mysqli_fetch_array($GroupKeteranganData)) {
			$dataPerhit[] = [$DataKeterangan['id_perhitungan_tarif_jasa'],$DataKeterangan['nilai']];
		}
		$PPN = ($dataPerhit[2][1] * $dataPerhit[0][1] / 100) ;
		$FAF = Image('logo/logo-print.png');
		$html = '
		<link href="../../_vendors/dompdf/_css_print.css" rel="stylesheet" type="text/css" />
		<div class="invoice-box">
		<table cellpadding="0" cellspacing="0">
		<tr class="top">
		<td colspan="5">
		<table>
		<tr>
		<td class="title">
		<img src="../image/logo/logo-print.png" alt="" height="50""><br>
		Hallo, '.$Pengirim['nama'].'<br>
		Terima kasih telah melakukan pemesanan
		jasa pada POS INDONESIA, silakan tunggu
		proses kelanjutann atas pemesanannya.
		</td>

		<td>
		<i class="bt">Invoice</i><br>
		Order Date: '.$PemesananData['tanggal_pemesanan'].'<br>
		Order Status : '.($PemesananData['pengiriman_status'] == 2 ? 'Selesai' : '').'<br>
		Order No : '.$PemesananData['kode_pemesanan'].'
		</td>
		</tr>
		</table>
		</td>
		</tr>

		<tr class="information">
		<td colspan="5">
		<table>
		<tr>
		<td>
		<i class="bt">Billing Address</i><br>
		'.$Pengirim['nama'].'<br>
		'.$Pengirim['alamat'].'<br>
		'.$Pengirim['no_telphone'].'
		</td>

		<td>
		<i class="bt">Shipping Address</i><br>
		'.$Penerima['nama'].'<br>
		'.$Penerima['alamat'].'<br>
		'.$Penerima['no_telp'].'
		</td>
		</tr>
		</table>
		</td>
		</tr>

		<tr class="heading">
		<td>
		Item
		</td>
		<td>
		Tipe Pengiriman
		</td>
		<td>Jarak</td>
		<td>Berat</td>
		<td>
		Nominal
		</td>
		</tr>
		<tr class="details">
		<td>'.$PemesananData['nama_barang_pelanggan'].'</td>
		<td>'.$KetentuanTarif['nama_jasa'].'-'.$KetentuanTarif['nama_ketentuan'].'</td>
		<td>'.$PemesananData['jarak'].' Km</td>
		<td>'.$PemesananData['berat'].' Kg</td>
		<td>Rp. '.number_format($PemesananData['biaya_tarif']).'</td>
		</tr>

	
		</table>
		</div>
		';
		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();
		$dompdf->stream('FAKTUR PEMBAYARAN JASA',array("Attachment" => false));

	}elseif($Keterangan == 'KeteranganTarif'){
		$html = '
		
		<table>
		<tr>
		<th>
		<img class="center" src="../image/logo/logo-sm.png" alt="" height="60">
		</th>
		<th>
		POS INDONESIA CABANG PALEMBANG<br>
		Jalan Sudirman 0 Km Palembang, Sumatera Selatan
		</th>
		</tr>
		</table>
		<hr>';
		
		$html.='
		<table width="100%" border="1px">
		<tr style="background-color: #fefbd8;">
		<th>No</th>
		<th>Nama Jasa</th>
		<th>Ketentuan Pengiriman</th>
		<th>Lama Pengiriman</th>
		<th>Jarak</th>
		<th>Beban</th>
		<th>Tarif</th>
		</tr>';
		$no = 1;
		$KetentuanTarif = mysqli_query($conn,'select a.id as IdJasa, a.kode_jasa,a.nama_jasa,b.id as idKetentuanJasa,b.nama_ketentuan,b.kode_jasa from jasa as a join ketentuan_jasa as b on b.kode_jasa=a.id');
		while($Data = mysqli_fetch_array($KetentuanTarif)){
			$GroupKeterangan = mysqli_fetch_array(mysqli_query($conn,"select * from tarif where id_ketentuan_jasa='".$Data['idKetentuanJasa']."' group by group_keterangan"));
			$KeteranganTarifNya = mysqli_fetch_array(mysqli_query($conn,"select * from keterangan_tarif where id_tarif_keterangan='".$GroupKeterangan['group_keterangan']."'"));
			$html.='
			<tr class="details">
			<td>'.$no++.'</td>
			<td>'.$Data['nama_jasa'].'</td>
			<td>'.($Data['nama_ketentuan'] == 1 ? 'Dokument' : ($Data['nama_ketentuan'] == 2 ? 'Barang Kecil' : 'Barang Besar')).'</td>

			<td>'.$KeteranganTarifNya['kecepatan_kirim'].' Hari</td>
			<td>'.$KeteranganTarifNya['jarak'].' KM</td>
			<td>'.$KeteranganTarifNya['berat'].' KG</td>
			<td>Rp. '.$KeteranganTarifNya['total_tarif_nilai'].'</td>


			</tr>
			';
		}
		$html.='
		</table>
		';
		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'landscape');
		$dompdf->render();
		$dompdf->stream('DAFTAR KETERANGAN  TARIF',array("Attachment" => false));

	}elseif($Keterangan == 'Jasa'){
		$html = '
		
		<table>
		<tr>
		<th>
		<img class="center" src="../image/logo/logo-sm.png" alt="" height="60">
		</th>
		<th>
		POS INDONESIA CABANG PALEMBANG<br>
		Jalan Sudirman 0 Km Palembang, Sumatera Selatan
		</th>
		</tr>
		</table>
		<hr>';

		$html.='
		<table width="100%" border="1px">
		<tr style="background-color: #fefbd8;">
		<th>No</th>
		<th>Kode Jasa</th>
		<th>Nama Jasa</th>
		<th>Tanggal Dibuat</th>
		<th>Total Keterangan Tarif</th>
		<th>Nama Pembuat Jasa</th>
		</tr>';
		if (isset($_GET['Tanggal1']) && isset($_GET['Tanggal2'])) {
			$Tanggal1 = $_GET['Tanggal1'];
			$Tanggal2 = $_GET['Tanggal2'];
			if ($Tanggal1 != 'NULL' && $Tanggal2 != 'NULL') {
				$no = 1;
				$Jasa = mysqli_query($conn,"select * from jasa where tanggal_dibuat between '".$Tanggal1."' and '".$Tanggal2."'");
				while($Data = mysqli_fetch_array($Jasa)){
					$Users = mysqli_fetch_array(mysqli_query($conn,"select * from keterangan_login where id='".$Data['id_users']."'"));
					$Total = mysqli_fetch_array(mysqli_query($conn,"select *,count(id) as Total from ketentuan_jasa where kode_jasa='".$Data['id']."'"));


					$html.='
					<tr class="details">
					<td>'.$no++.'</td>
					<td>'.$Data['kode_jasa'].'</td>
					<td>'.$Data['nama_jasa'].'</td>
					<td>'.$Data['tanggal_dibuat'].'</td>
					<td>'.$Total['Total'].'Data</td>
					<td>'.$Users['nama_pengguna'].'</td>
					</tr>
					';
				}
			}else{
				$no = 1;
				$Jasa = mysqli_query($conn,"select * from jasa ");
				while($Data = mysqli_fetch_array($Jasa)){
					$Users = mysqli_fetch_array(mysqli_query($conn,"select * from keterangan_login where id='".$Data['id_users']."'"));
					$Total = mysqli_fetch_array(mysqli_query($conn,"select *,count(id) as Total from ketentuan_jasa where kode_jasa='".$Data['id']."'"));


					$html.='
					<tr class="details">
					<td>'.$no++.'</td>
					<td>'.$Data['kode_jasa'].'</td>
					<td>'.$Data['nama_jasa'].'</td>
					<td>'.$Data['tanggal_dibuat'].'</td>
					<td>'.$Total['Total'].'Data</td>
					<td>'.$Users['nama_pengguna'].'</td>
					</tr>
					';
				}
			}
		}
		$html.='
		</table>
		';
		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();
		$dompdf->stream('JASA PERUSAHAAN',array("Attachment" => false));


	}elseif($Keterangan == 'Pemesanan'){
		$html = '
		
		<table>
		<tr>
		<th>
		<img class="center" src="../image/logo/logo-sm.png" alt="" height="60">
		</th>
		<th>
		POS INDONESIA CABANG PALEMBANG<br>
		Jalan Sudirman 0 Km Palembang, Sumatera Selatan
		</th>
		</tr>
		</table>
		<hr>';

		$html.='
		<table width="100%" border="1px">
		<tr style="background-color: #fefbd8;">
		<th>No</th>
		<th>Kode Resi</th>
		<th>Nama Karyawan</th>
		<th>Nama Pengirim</th>
		<th>Kategori Jasa</th>
		<th>Tanggal Pembuatan Resi</th>
		<th>Total Tarif</th>
		</tr>';
		if (isset($_GET['Tanggal1']) && isset($_GET['Tanggal2'])) {
			$Tanggal1 = $_GET['Tanggal1'];
			$Tanggal2 = $_GET['Tanggal2'];
			$no = 1;
			
			if ($Tanggal1 != 'NULL' && $Tanggal2 != 'NULL') {
				$Pemesanan = mysqli_query($conn,"select * from pemesanan where `tanggal_pemesanan` >= '$Tanggal1' and `tanggal_pemesanan` <= '$Tanggal2'");
				while($Data = mysqli_fetch_array($Pemesanan)){
					$Pengirim = mysqli_fetch_array(mysqli_query($conn,"select * from pengirim where id_pengirim='".$Data['id_pengirim']."'"));
					$Penermia = mysqli_fetch_array(mysqli_query($conn,"select * from penerima where id_penerima='".$Data['id_penerima']."'"));
					$Karyawan = mysqli_fetch_array(mysqli_query($conn,"select * from  keterangan_login where keterangan_login.id='".$Data['id_users_data']."'"));
					$Jasa = mysqli_fetch_array(mysqli_query($conn,"select * from jasa join ketentuan_jasa on ketentuan_jasa.kode_jasa=jasa.id where ketentuan_jasa.id='".$Data['id_jasa']."'"));
					$Pembayaran = mysqli_fetch_array(mysqli_query($conn,"select * from pembayaran where kode_pemesanan='".$Data['kode_pemesanan']."'"));


					$html.='
					<tr class="details">
					<td>'.$no++.'</td>
					<td>'.$Data['kode_pemesanan'].'</td>
					<td>'.$Karyawan['nama_pengguna'].'</td>
					<td>'.$Pengirim['nama'].'</td>
					<td>'.$Jasa['nama_jasa'].'-'.$Jasa['nama_ketentuan'].'</td>
					<td>'.$Data['tanggal_pemesanan'].'</td>
					<td>Rp. '.number_format($Data['biaya_tarif']).'</td>
					</tr>
					';
				}
			}else{
				$Pemesanan = mysqli_query($conn,'select * from pemesanan');
				while($Data = mysqli_fetch_array($Pemesanan)){
					$Pengirim = mysqli_fetch_array(mysqli_query($conn,"select * from pengirim where id_pengirim='".$Data['id_pengirim']."'"));
					$Penermia = mysqli_fetch_array(mysqli_query($conn,"select * from penerima where id_penerima='".$Data['id_penerima']."'"));
					$Karyawan = mysqli_fetch_array(mysqli_query($conn,"select * from  keterangan_login where keterangan_login.id='".$Data['id_users_data']."'"));
					$Jasa = mysqli_fetch_array(mysqli_query($conn,"select * from jasa join ketentuan_jasa on ketentuan_jasa.kode_jasa=jasa.id where ketentuan_jasa.id='".$Data['id_jasa']."'"));
					$Pembayaran = mysqli_fetch_array(mysqli_query($conn,"select * from pembayaran where kode_pemesanan='".$Data['kode_pemesanan']."'"));


					$html.='
					<tr class="details">
					<td>'.$no++.'</td>
					<td>'.$Data['kode_pemesanan'].'</td>
					<td>'.$Karyawan['nama_pengguna'].'</td>
					<td>'.$Pengirim['nama'].'</td>
					<td>'.$Jasa['nama_jasa'].'-'.$Jasa['nama_ketentuan'].'</td>
					<td>'.$Data['tanggal_pemesanan'].'</td>
					<td>Rp. '.number_format($Data['biaya_tarif']).'</td>
					</tr>
					';
				}
			}
		}
		$html.='
		</table>
		';
		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();
		$dompdf->stream('JASA PERUSAHAAN',array("Attachment" => false));

	}elseif($Keterangan == 'KetentuanPerhitungan'){

		$html = '

		<table>
		<tr>
		<th>
		<img class="center" src="../image/logo/logo-sm.png" alt="" height="60">
		</th>
		<th>
		POS INDONESIA CABANG PALEMBANG<br>
		Jalan Sudirman 0 Km Palembang, Sumatera Selatan
		</th>
		</tr>
		</table>
		<hr>';


		$html.='
		<table width="100%" border="1px">
		<tr style="background-color: #fefbd8;">
		<td>
		No
		</td>
		<td>
		Perihal
		</td>
		<td>Ketentuan</td>
		</td>
		</tr>';
		$no = 1;
		$Jasa = mysqli_query($conn,'select * from perhitungan_tarif_jasa');
		while($Data = mysqli_fetch_array($Jasa)){
			$html.='
			<tr class="details">
			<td>'.$no++.'</td>
			<td>'.$Data['perihal'].'</td>
			<td>'.$Data['hal'].'</td>
			</tr>
			';
		}
		$html.='
		</table>
		';
		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();
		$dompdf->stream('KETENTUAN PERHITUNGAN TARIF',array("Attachment" => false));
	}
}



