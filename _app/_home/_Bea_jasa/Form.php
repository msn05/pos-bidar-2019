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
    								<li class="breadcrumb-item active">Bea Jasa Jasa</li>
    							</ol>
    						</div>
    						<h4 class="page-title">Bea Jasa</h4>
    					</div>
    				</div>
    			</div> 
    			<form id="Form" method="POST">

    				<div class="row">
    					
    					<div class="col-12">
    						<div class="card">
    							<div class="card-body">
    								<h4 class="header-title"> Form Bea Jas</h4>
    								<hr>
    							
    								<div class="row">
    									<div class="col-12">
    										<div class="card">
    											<div class="card-body">
    												<h4 class="header-title"> Pengirim</h4>
    												<div class="form-row">
    													<div class="form-group col-md-3">
    														<label for="inputEmail4" class="col-form-label">Nama Pengirim</label>
    														<input type="text" class="form-control"  id="inputnama" name="inputnama" placeholder="Nama Pengirim" required/>
    													</div>
    													<div class="form-group col-md-6">
    														<label for="inputPassword4" class="col-form-label">Alamat</label>
    														<textarea class="form-control" name="alamat" id="alamat" placeholder="alamat pengirim"></textarea>
    													</div>
    													<div class="form-group col-md-3">
    														<label for="inputEmail4" class="col-form-label">Nomor Telphone</label>
    														<input type="number" class="form-control" id="inputhp1" name="inputhp1" placeholder="Nomor HP" required/>
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
    												<h4 class="header-title"> Penerima</h4>
    												<div class="form-row">
    													<div class="form-group col-md-3">
    														<label for="inputEmail4" class="col-form-label">Nama Penerima</label>
    														<input type="text" class="form-control"  id="inputnama2" name="inputnama2" placeholder="Nama Penerima" required/>
    													</div>
    													<div class="form-group col-md-6">
    														<label for="inputPassword4" class="col-form-label">Alamat</label>
    														<textarea class="form-control" name="alamat2" id="alamat2" placeholder="alamat Penerima"></textarea>
    													</div>
    													<div class="form-group col-md-3">
    														<label for="inputEmail4" class="col-form-label">Nomor Telphone</label>
    														<input type="number" class="form-control" id="inputhp2" name="inputhp2" placeholder="Nomor HP" required/>
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
    												<h4 class="header-title"> Barang Pelanggan</h4>
    												<div class="form-row">
    													<div class="form-group col-md-8">
    														<label for="inputEmail4" class="col-form-label">Nama Barang </label>
    														<input type="text" class="form-control"  id="inputbarang" name="inputbarang" placeholder="Sebutkan nama barangnya" required/>
    													</div>
    													<div class="form-group col-md-4">
    														<label for="inputPassword4" class="col-form-label">Berat nya</label>
    														<input type="text" class="form-control"  id="inputberat" name="inputberat" placeholder="Berat Barang" required/>
    													</div>
    													

    												</div>
    											</div>
    										</div>
    									</div>
    								</div>
    									<div class="row">
    									<div class="col-4">
    										<div class="card">
    											<div class="card-body">
    												<h4 class="header-title"> Jasa</h4>
    												<div class="form-row">
    													<div class="form-group col-md-12">
    														<label for="inputAddress" class="col-form-label">Pilih Kategori Jasa</label>
    														<select class="selectpicker" name="inputjasa" id="inputjasa" data-style="btn-light">
    															<option value="">Pilih</option>
    															<?php 
    															$Jasa = mysqli_query($conn,'select * from jasa ');
    															while($Data = mysqli_fetch_array($Jasa)){
    																?>
    																<option value="<?=$Data['id'];?>"><?=$Data['nama_jasa'];?></option>
    															<?php }?>
    														</select>
    													</div>

    												</div>


    											</div> <!-- end card-body -->
    										</div> <!-- end card-->
    									</div> <!-- end col -->
    									<div class="col-8">
    										<div id="Jasa"></div>

    									</div>
    								</div>
    									<div class="row">
    									<div class="col-12">
    										<div class="card">
    											<div class="card-body">
    											
    												<div class="form-row">
    										<div class="form-group col-md-4">
    														<label for="inputEmail4" class="col-form-label">Jarak Kecamatan</label>
    									
    															<select class="selectpicker" name="inputjarak" id="inputjarak" data-style="btn-light">
    															<option value="">Pilih</option>
                            										<option value="2">Ilir Timur 1</option>
													<option value="2">Ilir Barat 1</option>
                            										<option value="3">Bukit Kecil</option>
                            										<option value="4">Kertapati</option>
                            										<option value="5">Sebrang Ulu 1</option>
                            										<option value="6">Sebrang Ulu 2</option>
													<option value="7">Alang-alang Lebar</option>
													<option value="8">Gandus</option>
													<option value="4">Jakabaring</option>
    														</select>
    													</div>
	                                                    <div class="form-group col-md-8">
    														<label for="inputEmail4" class="col-form-label">Total Biaya</label>
    														
    								                    	<input type="text" class="form-control"  id="Jasas" name="Jasas"  readonly/>
    								                    
    												   </div>
    													
    														</div>
    														</div>
    														</div>
    														</div>
    														</div>
    														
    								<hr>
    								<div class="form-group mb-0 justify-content-end row">
    									<button type="#" id="PostData" class="mr-2 btn btn-primary waves-effect waves-light">Save</button>
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
    					url: '_Bea_jasa/_proses.php?Simpan',
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