    <link href="<?=Assets('');?>/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=Assets('');?>/libs/selectize/css/selectize.bootstrap3.css" rel="stylesheet" type="text/css" />
    <link href="<?=Assets('');?>/libs/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
    <script src="<?=Assets('');?>/libs/select2/js/select2.min.js"></script>
    <script src="<?=Assets('');?>/libs/jquery-mockjax/jquery.mockjax.min.js"></script>
    <script src="<?=Assets('');?>/libs/devbridge-autocomplete/jquery.autocomplete.min.js"></script>
    <script src="<?=Assets('');?>/libs/bootstrap-select/js/bootstrap-select.min.js"></script>
    <div class="content-page">
    	<div class="content">
    		<div class="container-fluid">
    			<div class="row">
    				<div class="col-12">
    					<div class="page-title-box">
    						<div class="page-title-right">
    							<ol class="breadcrumb m-0">
    								<li class="breadcrumb-item"><a href="javascript: void(0);">SIPT POS </a></li>
    								<li class="breadcrumb-item active">Pemesanan Jasa</li>
    							</ol>
    						</div>
    						<h4 class="page-title">Pemesanan Jasa</h4>
    					</div>
    				</div>
    			</div> 
    			<form id="Form" method="POST">
    				<?php
    				$id = $_GET['Data'];
    				$Pemesanan = mysqli_fetch_array(mysqli_query($conn,"select * from pemesanan join pengirim on pengirim.id_pengirim=pemesanan.id_pengirim join penerima on penerima.id_penerima=pemesanan.id_penerima where id='".$id."'"));
    				$Pengirim = mysqli_fetch_array(mysqli_query($conn,"select * from pengirim where id_pengirim='".$Pemesanan['id_pengirim']."' group by id_pengirim"));
    				$Penerima = mysqli_fetch_array(mysqli_query($conn,"select * from penerima where id_penerima='".$Pemesanan['id_penerima']."' group by id_penerima"));
    				$CekJasaNya = mysqli_fetch_array(mysqli_query($conn, "select * from ketentuan_jasa where id='".$Pemesanan['id_jasa']."'"));
    				?>
    				<div class="row">
    					<div class="col-12">
    						<div class="card">
    							<div class="card-body">
    								<h4 class="header-title"> Form Ubah Pemesanan Jasa Atas Nama Pengirim <?=$Pengirim['nama'] .' Dengan alamat '.$Pengirim['alamat'].' Dengan Penerima Atas Nama '.$Penerima['nama'].' Dengan alamat '.$Penerima['alamat'];?> Dengan Kode Pemesanan <i class="text-danger"><?=$Pemesanan['kode_pemesanan'];?> </i>Pada Tanggal <?=$Pemesanan['tanggal_pemesanan'];?></h4>
    								<hr>
    								<div class="row">
    									<div class="col-4">
    										<div class="card">
    											<div class="card-body">
    												<h4 class="header-title"> Jasa</h4>
    												<div class="form-row">
    													<div class="form-group col-md-12">
    														<label for="inputAddress" class="col-form-label">Pilih Kategori Jasa</label>
    														<input type="hidden" name="inputkodejasadata" id="inputkodejasadata" value="<?=$Pemesanan['id'];?>">
    														<select class="selectpicker" name="inputjasa" id="inputjasa" data-style="btn-light">
    															<option value="">Pilih</option>
    															<?php 
    															$Jasa = mysqli_query($conn,'select * from jasa ');
    															while($Data = mysqli_fetch_array($Jasa)){
    																?>
    																<option value="<?=$Data['id'];?>"<?=$CekJasaNya['kode_jasa'] == $Data['id'] ? 'selected' : '';?>><?=$Data['nama_jasa'];?></option>
    															<?php }?>
    														</select>
    													</div>

    												</div>


    											</div> 
    										</div> 
    									</div>
    									<div class="col-8">
    										<div id="Jasa"></div>
    										<div id="Jasa1">
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
    															<?php 
    															$DataJasaKeterangan = mysqli_query($conn,"select * from ketentuan_jasa where kode_jasa='".$CekJasaNya['kode_jasa']."'");
    															while ($Data = mysqli_fetch_array($DataJasaKeterangan)) {
    																$GroupKeterangan = mysqli_fetch_array(mysqli_query($conn,"select * from tarif where id_ketentuan_jasa='".$Data['id']."' group by group_keterangan"));
    																$KeteranganTarifNya = mysqli_fetch_array(mysqli_query($conn,"select * from keterangan_tarif where id_tarif_keterangan='".$GroupKeterangan['group_keterangan']."'"));
    																?>
    																<tr>
    																	<td>
    																		<input class="radio" name="inputkodejasa" id="inputkodejasa" type="radio" name="radio" id="radio" value="<?=$Data['id'];?>"<?=$Pemesanan['id_jasa'] == $Data['id'] ? 'checked' : '';?>>
    																		<label for="radio">
    																			<?=$Data['nama_ketentuan'];?>
    																		</label>
    																	</td>
    																	<td><?=$KeteranganTarifNya['jarak'].' Km ';?></td>
    																	<td><?=$KeteranganTarifNya['berat'].' Kg ';?></td>
    																	<td><?=$KeteranganTarifNya['kecepatan_kirim'].' Hari ';?></td>
    																	<td>Rp. <?=number_format($KeteranganTarifNya['total_tarif_nilai'],3);?><td>
    																	</tr>
    																	<?php
    																}
    																?>
    															</tbody>
    														</table>
    													</div>
    												</div>
    											</div>

    										</div>
    									</div>
    									<div class="row">
    										<div class="col-12">
    											<div class="card">
    												<div class="card-body">
    													<h4 class="header-title"> Barang Pelanggan</h4>
    													<div class="form-row">
    														<div class="form-group col-md-4">
    															<label for="inputEmail4" class="col-form-label">Nama Barang </label>
    															<input type="text" class="form-control" value="<?=$Pemesanan['nama_barang_pelanggan'];?>"  id="inputbarang" name="inputbarang" placeholder="Sebutkan nama barangnya" required/>
    														</div>
    														<div class="form-group col-md-4">
    															<label for="inputPassword4" class="col-form-label">Berat nya</label>
    															<input type="text" class="form-control"  id="inputberat" value="<?=$Pemesanan['berat'];?>" name="inputberat" placeholder="Berat Barang" required/>
    														</div>
    														<div class="form-group col-md-4">
    															<label for="inputEmail4" class="col-form-label">Jarak Pengiriman</label>
    															<select class="selectpicker" name="inputjarak" id="inputjarak" data-style="btn-light">
    															<option value="">Pilih</option>
                            										<option value="1"<?=$Pemesanan['jarak'] == 1 ? 'selected' : '';?>>Merdeka</option>
                            										<option value="2"<?=$Pemesanan['jarak'] == 2 ? 'selected' : '';?>>Bukit Besar</option>
                            										<option value="4"<?=$Pemesanan['jarak'] == 4 ? 'selected' : '';?>>Kertapi</option>
                            										<option value="5"<?=$Pemesanan['jarak'] == 5 ? 'selected' : '';?>>Muhammadiyah</option>
                            										<option value="7"<?=$Pemesanan['jarak'] == 7 ? 'selected' : '';?>>Sako</option>
    														</select>
    														</div>

    													</div>
    												</div>
    											</div>
    										</div>
    									</div>
    										<div class="row">
    										<div class="col-12">
    											<div class="card">
    												<div class="card-body">
    												
    													<div class="form-row">
    														<div class="form-group col-md-4">
    															<label for="inputEmail4" class="col-form-label">Total Biaya</label>
    								                    	<input type="text" class="form-control"  id="Jasas" name="Jasas"   readonly/>
    														</div>
    														</div>
    														</div>
    												
    														</div>
    														
    									<hr>
    									<div class="form-group mb-0 justify-content-end row">
    										<button type="submit" id="PostData" class="mr-2 btn btn-primary waves-effect waves-light">Save</button>
    										<a href="?Halaman=_Bea_jasa">
    											<button type="button" id="PostData" class="btn btn-info waves-effect waves-light">Back</button>
    										</a>
    									</div>
    								</div>
    							</div>

    						</div>

    					</div>

    				</form>

    			</div> 
    		</div> 
    		<script>
    			$(document).ready(function(){
    				    
    			$('#inputjasa').change(function(){
    				var inputjasa 	= $(this).val();
    				$.ajax({
    					url: '_Bea_jasa/_proses.php?DataJasa',
    					type: 'POST',
    					data: 'inputjasa='+inputjasa,
    					cache:'false',
    					success:function(msg){
    						$("#Jasa").html(msg);
    					}
    				});
    			});
    			
    			
    			$('#inputjarak').change(function(){
    			   
    				var inputkodejasa 	=  $("input[name='inputkodejasa']:checked"). val();
    				console.log(inputkodejasa);
    				var inputberat 	= $('#inputberat').val();
    				var inputjarak 	= $(this).val();
    				$.ajax({
    					url: '_Bea_jasa/_proses.php?PerhitunganJarak',
    					type: 'POST',
    				    data: 
                            {
                             inputberat:inputberat,
                             inputkodejasa: inputkodejasa,
                             inputjarak: inputjarak
                            },
    					cache:'false',
    					success:function(msg){
    						$("#Jasas").val(msg);
    					}
    				});
    			});
    			

    				$("#Form").on('submit',(function(e) {
    					e.preventDefault();
    					var Form = $(this);
    					$.ajax({
    						url: '_Bea_jasa/_proses.php?Update',
    						type: "POST",
    						data:  Form.serialize(),
    						dataType: "JSON",
    						cache :"false",
    						success: function (respone) {
    							if (respone.status == 'success') {
    								swal.fire({
    									title: respone.status,
    									text: respone.message,
    									icon: respone.status
    								}).then(function(){ 
    									window.location = "?Halaman=_Bea_jasa";
    								}
    								);
    							} else{
    								swal.fire({
    									title: respone.status,
    									text: respone.message,
    									icon: respone.status
    								}).then(function(){ 
    								// location.reload(true);
    							}
    							);
    							}
    						}
    					});
    				}));


    			});
    		</script>