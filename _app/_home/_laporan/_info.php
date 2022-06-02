 <div class="content-page">
 	<div class="content">
 		<div class="container-fluid">
 			<div class="row">
 				<div class="col-12">
 					<div class="page-title-box">
 						<div class="page-title-right">
 							<ol class="breadcrumb m-0">
 								<li class="breadcrumb-item"><a href="javascript: void(0);">SIPT POS </a></li>
 								<li class="breadcrumb-item active">Laporan</li>
 							</ol>
 						</div>
 						<?php
 						$id = $_GET['Id'];
 						if ($id == 1) {
 							$id = 'Ketentuan Perhitungan';
 						}elseif ($id == 2) {
 							$id = 'Ketentuan Tarif';
 						}elseif ($id == 3) {
 							$id = 'Jasa';
 						}elseif ($id == 4) {
 							$id = 'Bea Jasa';
 						}else{
 							$id ='Pelanggan';
 						}
 						?>
 						<h4 class="page-title">Data Laporan <?=$id;?></h4>
 					</div>
 				</div>
 			</div>
 			<div class="row">
 				<div class="col-12">
 					<div class="card-box">
 						<table id="basic-datatable" class="table dt-responsive nowrap w-100">
 							<?php if($_GET['Id'] == 1){?>
 								<thead>
 									<tr>
 										<th>No</th>
 										<th>Perihal</th>
 										<th>Note Perhitungan</th>
 									</tr>
 								</thead>
 								<tbody>
 									<?php
 									$no = 1;
 									$Jasa = mysqli_query($conn,'select * from perhitungan_tarif_jasa');
 									while($Data = mysqli_fetch_array($Jasa)){
 										?>	
 										<tr>
 											<td><?=$no++;?></td>
 											<td><?=$Data['perihal'];?></td>
 											<td><?=$Data['hal'];?></td>
 										</tr>
 									<?php }?>
 									<a href="Cetak.php?Keterangan=KetentuanPerhitungan" title="cetak"  >
 										<button type="button" title="Cetak" class="mb-2 btn btn-success waves-effect waves-light"><i class="mdi mdi-cloud-print-outline"></i></button>
 									</a>
 									
 								<?php }elseif($_GET['Id'] == 2){?>
 									<thead>
 										<tr>
 											<th>No</th>
 											<th>Nama Jasa</th>
 											<th>Ketentuan Pengiriman</th>
 											<th>Lama Pengiriman</th>
 											<th>Jarak</th>
 											<th>Beban</th>
 											<th>Tarif</th>
 											
 										</tr>
 									</thead>
 									<tbody>
 										<?php
 										$no = 1;
 										$KetentuanTarif = mysqli_query($conn,'select a.id as IdJasa, a.kode_jasa,a.nama_jasa,b.id as idKetentuanJasa,b.nama_ketentuan,b.kode_jasa from jasa as a join ketentuan_jasa as b on b.kode_jasa=a.id');
 										while($Data = mysqli_fetch_array($KetentuanTarif)){
 											$GroupKeterangan = mysqli_fetch_array(mysqli_query($conn,"select * from tarif where id_ketentuan_jasa='".$Data['idKetentuanJasa']."' group by group_keterangan"));
 											$KeteranganTarifNya = mysqli_fetch_array(mysqli_query($conn,"select * from keterangan_tarif where id_tarif_keterangan='".$GroupKeterangan['group_keterangan']."'"));
 											?>	
 											<tr>
 												<td><?=$no++;?></td>
 												<td><?=$Data['nama_jasa'];?></td>
 												<td><?=($Data['nama_ketentuan'] == 1 ? 'Dokument' :($Data['nama_ketentuan'] == 2 ? 'Barang Kecil' : 'Barang Besar'));?></td>

 												<td><?=$KeteranganTarifNya['kecepatan_kirim'];?> Hari</td>
 												<td><?=$KeteranganTarifNya['jarak'];?> KM</td>
 												<td><?=$KeteranganTarifNya['berat'];?> KG</td>
 												<td>Rp. <?=$KeteranganTarifNya['total_tarif_nilai'];?></td>
 												<?php if(isset($_GET['Data'])){echo'

 												';}?>
 											</tr>
 										<?php }?>
 									</tbody>
 									<a href="Cetak.php?Keterangan=KeteranganTarif" title="cetak"  >
 										<button type="button" title="Cetak" class="mb-2 btn btn-success waves-effect waves-light"><i class="mdi mdi-cloud-print-outline"></i></button>
 									</a>
 								<?php }elseif($_GET['Id'] == 3){?>
 									<thead>
 										<tr>
 											<th>No</th>
 											<th>Kode Jasa</th>
 											<th>Nama Jasa</th>
 											<th>Tanggal Dibuat</th>
 											<th>Total Keterangan Tarif</th>
 											<th>Nama Pembuat Jasa</th>
 										</tr>
 									</thead>
 									<tbody>
 										<?php
 										if (isset($_GET['tanggal1']) && isset($_GET['tanggal2'])) {

 											$Tanggal1 = $_GET['tanggal1'];
 											$Tanggal2 = $_GET['tanggal2'];
 											if ($Tanggal1 != 'NULL' && $Tanggal2 != 'NULL') {
 												$no = 1;
 												$Jasa = mysqli_query($conn,"select * from jasa where tanggal_dibuat between '".$Tanggal1."' and '".$Tanggal2."'");
 												while($Data = mysqli_fetch_array($Jasa)){
 													$Users = mysqli_fetch_array(mysqli_query($conn,"select * from keterangan_login where id='".$Data['id_users']."'"));
 													$Total = mysqli_fetch_array(mysqli_query($conn,"select *,count(id) as Total from ketentuan_jasa where kode_jasa='".$Data['id']."'"));
 													?>	
 													<tr>
 														<td><?=$no++;?></td>
 														<td><?=$Data['kode_jasa'];?></td>
 														<td><?=$Data['nama_jasa'];?></td>
 														<td><?=$Data['tanggal_dibuat'];?></td>
 														<td>
 															<?=$Total['Total'];?>
 														</td>
 														<td><?=$Users['nama_pengguna'];?></td>

 													</tr>
 												<?php }
 											}else{
 												$no = 1;
 												$Jasa = mysqli_query($conn,"select * from jasa");
 												while($Data = mysqli_fetch_array($Jasa)){
 													$Users = mysqli_fetch_array(mysqli_query($conn,"select * from keterangan_login where id='".$Data['id_users']."'"));
 													$Total = mysqli_fetch_array(mysqli_query($conn,"select *,count(id) as Total from ketentuan_jasa where kode_jasa='".$Data['id']."'"));
 													?>	
 													<tr>
 														<td><?=$no++;?></td>
 														<td><?=$Data['kode_jasa'];?></td>
 														<td><?=$Data['nama_jasa'];?></td>
 														<td><?=$Data['tanggal_dibuat'];?></td>
 														<td>
 															<?=$Total['Total'];?>
 														</td>
 														<td><?=$Users['nama_pengguna'];?></td>

 													</tr>
 												<?php }
 											}
 										}?>
 									</tbody>

 									<a href="Cetak.php?Keterangan=Jasa&Tanggal1=<?=$Tanggal1;?>&Tanggal2=<?=$Tanggal2;?>" title="cetak"  >
 										<button type="button" title="Cetak" class="mb-2 btn btn-success waves-effect waves-light"><i class="mdi mdi-cloud-print-outline"></i></button>
 									</a>
 								<?php }elseif($_GET['Id'] == 4){?>
 									<thead>
 										<tr>
 											<th>No</th>
 											<th>Kode Resi</th>
 											<th>Nama Karyawan</th>
 											<th>Nama Pengirim</th>
 											<th>Kategori Jasa</th>
 											<th>Tanggal Pembuaran Resi</th>
 											<th>Total Tarif</th>
 										</tr>
 									</thead>
 									<tbody>
 										<?php
 										$no = 1;
 										if (isset($_GET['tanggal1']) && isset($_GET['tanggal2'])) {
 											$Tanggal1 = $_GET['tanggal1'];
 											$Tanggal2 = $_GET['tanggal2'];
 											if ($Tanggal1 != 'NULL' && $Tanggal2 != 'NULL') {
 												$Pemesanan = mysqli_query($conn,"select * from pemesanan join ketentuan_jasa on ketentuan_jasa.id=pemesanan.id_jasa join jasa on jasa.id=ketentuan_jasa.kode_jasa where  pemesanan.tanggal_pemesanan >= '$Tanggal1' and pemesanan.tanggal_pemesanan <= '$Tanggal2' order by jasa.kode_jasa asc");
 												while($Data = mysqli_fetch_array($Pemesanan)){
 													$Pengirim = mysqli_fetch_array(mysqli_query($conn,"select * from pengirim where id_pengirim='".$Data['id_pengirim']."'"));
 													$Penermia = mysqli_fetch_array(mysqli_query($conn,"select * from penerima where id_penerima='".$Data['id_penerima']."'"));
 													$Karyawan = mysqli_fetch_array(mysqli_query($conn,"select * from  keterangan_login where keterangan_login.id='".$Data['id_users_data']."'"));
 													$Jasa = mysqli_fetch_array(mysqli_query($conn,"select * from jasa join ketentuan_jasa on ketentuan_jasa.kode_jasa=jasa.id where ketentuan_jasa.id='".$Data['id_jasa']."'"));
 													$Pembayaran = mysqli_fetch_array(mysqli_query($conn,"select * from pembayaran where kode_pemesanan='".$Data['kode_pemesanan']."'"));
 													?>	
 													<tr>
 														<td><?=$no++;?></td>
 														<td><?=$Data['kode_pemesanan'];?></td>
 														<td><?=$Karyawan['nama_pengguna'];?></td>
 														<td><?=$Pengirim['nama'];?></td>
 														<td><?=$Jasa['nama_jasa'].'-'.($Jasa['nama_ketentuan'] == 1 ? 'Dokument' : ($Jasa['nama_ketentuan'] == 2 ? 'Barang Kecil' : 'Barang Besar'));?></td>
 														<td><?=$Data['tanggal_pemesanan'];?></td>
 														<td>Rp. <?=number_format($Data['biaya_tarif']);?></td>
 														
 													</tr>
 												<?php }
 											}else{
 												$Pemesanan = mysqli_query($conn,'select * from pemesanan');
 												while($Data = mysqli_fetch_array($Pemesanan)){
 													$Pengirim = mysqli_fetch_array(mysqli_query($conn,"select * from pengirim where id_pengirim='".$Data['id_pengirim']."'"));
 													$Penermia = mysqli_fetch_array(mysqli_query($conn,"select * from penerima where id_penerima='".$Data['id_penerima']."'"));
 													$Karyawan = mysqli_fetch_array(mysqli_query($conn,"select * from  keterangan_login where keterangan_login.id='".$Data['id_users_data']."'"));
 													$Jasa = mysqli_fetch_array(mysqli_query($conn,"select * from jasa join ketentuan_jasa on ketentuan_jasa.kode_jasa=jasa.id where ketentuan_jasa.id='".$Data['id_jasa']."'"));
 													$Pembayaran = mysqli_fetch_array(mysqli_query($conn,"select * from pembayaran where kode_pemesanan='".$Data['kode_pemesanan']."'"));
 													?>	
 													<tr>
 														<td><?=$no++;?></td>
 														<td><?=$Data['kode_pemesanan'];?></td>
 														<td><?=$Karyawan['nama_pengguna'];?></td>
 														<td><?=$Pengirim['nama'];?></td>
 														<td><?=$Jasa['nama_jasa'].'-'.($Jasa['nama_ketentuan'] == 1 ? 'Dokument' : ($Jasa['nama_ketentuan'] == 2 ? 'Barang Kecil' : 'Barang Besar'));?></td>
 														<td><?=$Data['tanggal_pemesanan'];?></td>
 														<td>Rp. <?=number_format($Data['biaya_tarif']);?></td>
 														
 													</tr>
 												<?php }
 											}

 										}
 										?>
 									</tbody>
 									<a href="Cetak.php?Keterangan=Pemesanan&Tanggal1=<?=$Tanggal1;?>&Tanggal2=<?=$Tanggal2;?>" title="cetak"  >
 										<button type="button" title="Cetak" class="mb-2 btn btn-success waves-effect waves-light"><i class="mdi mdi-cloud-print-outline"></i></button>
 									</a>
 								<?php }?>
 								<a href="?Halaman=_laporan">
 									<button type="button" title="Kembali" class="mb-2 btn btn-warning waves-effect waves-light"><i class="mdi mdi-arrow-collapse-left"></i></button>
 								</a>
 							</table>
 						</div>
 					</div>
 				</div>

 			</div>
 		</div>
