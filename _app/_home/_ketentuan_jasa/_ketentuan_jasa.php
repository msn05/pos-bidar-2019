<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="page-title-box">
						<div class="page-title-right">
							<ol class="breadcrumb m-0">
								<li class="breadcrumb-item"><a href="javascript: void(0);">SIPT POS </a></li>
								<li class="breadcrumb-item"><a href="javascript:void(0);">Jasa</a></li>
								<li class="breadcrumb-item active">Ketentuan Perhitungan Jasa</li>
							</ol>
						</div>
						<h4 class="page-title">Ketentuan Perhitungan </h4>
					</div>
				</div>
			</div> 
			<div class="row">
				<div class="col-6">
					<div class="card-box">
						<h4 class="header-title">Data Ketentuan Perhitungan Perusahaan</h4>
						<p class="text-muted font-13 mb-2">
							Halaman ini berisi data tentang ketentuan jasa perusahaan dalam sistem
						</p>
						<a href="Cetak.php?Keterangan=KetentuanPerhitungan" title="cetak"  >
							<button type="button" title="Cetak" class="mb-2 btn btn-success waves-effect waves-light"><i class="mdi mdi-cloud-print-outline"></i></button>
						</a>
						<table id="basic-datatable" class="table dt-responsive nowrap w-100">
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
							</tbody>

						</table>
					</div>
				</div>
			</div>    
		</div> 
	</div> 

	<script>
		$(document).ready(function(){
			$("#basic-datatable").DataTable({language:{paginate:{previous:"<i class='mdi mdi-chevron-left'>",next:"<i class='mdi mdi-chevron-right'>"}}
		});
	</script>
