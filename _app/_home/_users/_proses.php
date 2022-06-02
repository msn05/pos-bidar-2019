<?php
require_once(__DIR__.'/../../_function/url.php');
require_once(__DIR__.'/../../_function/database.php');

if (isset($_GET['Kirim'])) {

	$inputnama 		 = $_POST['inputnama'];
	$inputkodelogin  = $_POST['inputkodelogin'];
	$inputPassword 	 = $_POST['inputPassword'];
	$datetanggal  	 = $_POST['datetanggal'];
	$texttempat   	 = $_POST['texttempat'];
	$optionLevel 	 = $_POST['optionLevel'];
	$textnomor 	 	 = $_POST['textnomor'];
	$rand = rand(1001,9999);

	$CekIn = mysqli_query($conn,"select no_telphone from keterangan_login where no_telphone='".$textnomor."'");
	if (mysqli_num_rows($CekIn) > 0) {
		$respone = [
			'status' => 'error',
			'message'=> 'Nomor Sudah Ada',
		];
	}else{
		$name     				= $_FILES['foto']['name'];
		$lokasi  	 			= $_FILES['foto']['tmp_name'];
		$Batas    				= $_FILES['foto']['size'];
		$ekstensi_diperbolehkan = array('jpg','jpeg','png');
		$Pecah 					= explode('.', $name);
		$ekstensi 				= strtolower(end($Pecah));
		$FotoNya 				= $inputnama.'.png';
		$TempatBaru 			= '../../image/foto/'.$FotoNya;	
		if ($name != NULL) {
			if ($optionLevel != 0 && preg_match('/^[0-9]/', $textnomor) && $inputPassword != '') {
				$password = password_hash($inputPassword, PASSWORD_DEFAULT);
				if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
					if ($Batas <= 2000000) {
						if (move_uploaded_file($lokasi,$TempatBaru)){
							list($height,$width) = getimagesize($TempatBaru);
							$maxDim = 800; 
							if ( $width > $maxDim || $height > $maxDim ) {
								$ratio = $width/$height;
								if( $ratio > 1) {
									$newwidth  = $maxDim;
									$newheight = $maxDim/$ratio;
								} else {
									$newwidth = $maxDim*$ratio;
									$newheight = $maxDim;
								}
								$tmp 		= imagecreatetruecolor($newwidth, $newheight);
								$src		= imagecreatefromjpeg($TempatBaru);
								imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

								imagejpeg($tmp, $TempatBaru, 75);
							}
							$InsertKetLogin = mysqli_query($conn,"INSERT INTO `keterangan_login`(`id`, `nama_pengguna`, `level_pengguna`, `foto_pengguna`, `no_telphone`, `tanggal_lahir`, `tempat_lahir`) VALUES ('$rand','$inputnama','$optionLevel','$FotoNya','$textnomor','$datetanggal','$texttempat')");
							$InsertLogin = mysqli_query($conn,"INSERT INTO `users`(`id`, `kode_login`, `password`, `id_keterangan_data`, `aktif`) VALUES ('','$inputkodelogin','$password','$rand','1')");
							$respone = [
								'status' => 'success',
								'message'=> 'Berhasil',
							];
						}
					}else{
						$respone = [
							'status' => 'error',
							'message'=> 'Foto Terlalu Besar..!',
						];
					}
				}else{
					$respone = [
						'status' => 'error',
						'message'=> 'Format Foto JPEG | JPG | png',
					];
				}
			}else{
				$respone = [
					'status' => 'error',
					'message'=> 'Level Pengguna | Password | Format Nomor Telphone Salah',
				];
			}
		}else{
			$respone = [
				'status' => 'error',
				'message'=> 'Foto Wajib Diisi',
			];
		}
	}

}elseif (isset($_GET['Update'])) {

	$inputnama 		 = $_POST['inputnama'];
	$inputkodelogin  = $_POST['inputkodelogin'];
	$inputPassword 	 = $_POST['inputPassword'];
	$inputPassword2 	 = $_POST['inputPassword2'];
	$datetanggal  	 = $_POST['datetanggal'];
	$texttempat   	 = $_POST['texttempat'];
	$optionLevel 	 = $_POST['optionLevel'];
	$textnomor 	 	 = $_POST['textnomor'];
	$rand = rand(1001,9999);
	$password = password_hash($inputPassword, PASSWORD_DEFAULT);
    
	$CekIns = mysqli_fetch_array(mysqli_query($conn,"select * from users  where kode_login='".$inputkodelogin."'"));
	
	$idDataId = $CekIns['id'];
	$idCekS = $CekIns['id_keterangan_data'];

	$KeteranganDataLogin = mysqli_fetch_array(mysqli_query($conn,"select * from  keterangan_login where id='".$idCekS."'"));
	
			$name     				= $_FILES['foto']['name'];
			$lokasi  	 			= $_FILES['foto']['tmp_name'];
			$Batas    				= $_FILES['foto']['size'];
			$ekstensi_diperbolehkan = array('jpeg','jpg','png');
			$Pecah 					= explode('.', $name);
			$ekstensi 				= strtolower(end($Pecah));
			$FotoNya 				= $inputkodelogin.'.jpg';
			$TempatBaru 			= '../../image/foto/'.$FotoNya;	
			
			if ($name != NULL) {
		
	        if($textnomor != $KeteranganDataLogin['no_telphone']) {

		    $CekInNomor = mysqli_query($conn,"select no_telphone from keterangan_login where no_telphone='".$KeteranganDataLogin['no_telphone']."'");
		        if (mysqli_num_rows($CekInNomor) > 0) {
        			$respone = [
        				'status' => 'error',
        				'message'=> 'Nomor Sudah Ada',
        			];
	    	    }else{
			    
				if ($inputPassword != '') {
					$password = password_hash($inputPassword, PASSWORD_DEFAULT);
					if ($inputPassword == $inputPassword2) {

						if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
							if ($Batas <= 2000000) {
							     unlink('../../image/foto/'.$KeteranganDataLogin['foto_pengguna']);
								if (move_uploaded_file($lokasi,$TempatBaru)){
								   
									list($height,$width) = getimagesize($TempatBaru);
									$maxDim = 800; 
									if ( $width > $maxDim || $height > $maxDim ) {
										$ratio = $width/$height;
										if( $ratio > 1) {
											$newwidth  = $maxDim;
											$newheight = $maxDim/$ratio;
										} else {
											$newwidth = $maxDim*$ratio;
											$newheight = $maxDim;
										}
										$tmp 		= imagecreatetruecolor($newwidth, $newheight);
										$src		= imagecreatefromjpeg($TempatBaru);
										imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

										imagejpeg($tmp, $TempatBaru, 75);
									}
									$InsertKetLogin = mysqli_query($conn,"
									UPDATE keterangan_login SET nama_pengguna='$inputnama',level_pengguna='$optionLevel',foto_pengguna='$FotoNya',no_telphone='$textnomor',tanggal_lahir='$datetanggal,tempat_lahir='$texttempat' WHERE id='".$idCekS."'");
								
									$InsertLogin = mysqli_query($conn,"
									UPDATE `users` SET password='$password' WHERE id='".$idDataId."'");
							
									
									$respone = [
										'status' => 'success',
										'message'=> 'Berhasil',
									];
								}
							}else{
								$respone = [
									'status' => 'error',
									'message'=> 'Foto Terlalu Besar..!',
								];
							}
						}else{
							$respone = [
								'status' => 'error',
								'message'=> 'Format Foto JPEG | JPG',
							];
						}
					}else{
						$respone = [
							'status' => 'error',
							'message'=> 'Password Tidak Sama',
						];
					}
				}else{
				if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
							if ($Batas <= 2000000) {
							  
								if (move_uploaded_file($lokasi,$TempatBaru)){
								      unlink('../../image/foto/'.$KeteranganDataLogin['foto_pengguna']);
									list($height,$width) = getimagesize($TempatBaru);
									$maxDim = 800; 
									if ( $width > $maxDim || $height > $maxDim ) {
										$ratio = $width/$height;
										if( $ratio > 1) {
											$newwidth  = $maxDim;
											$newheight = $maxDim/$ratio;
										} else {
											$newwidth = $maxDim*$ratio;
											$newheight = $maxDim;
										}
										$tmp 		= imagecreatetruecolor($newwidth, $newheight);
										$src		= imagecreatefromjpeg($TempatBaru);
										imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

										imagejpeg($tmp, $TempatBaru, 75);
									}
							
									
									$InsertKetLogissn = mysqli_query($conn,"
									UPDATE keterangan_login SET nama_pengguna='$inputnama',level_pengguna='$optionLevel',foto_pengguna='$FotoNya',no_telphone='$textnomor',tanggal_lahir='$datetanggal,tempat_lahir='$texttempat' WHERE id='".$idCekS."'");
									

									$respone = [
										'status' => 'success',
										'message'=> 'Berhasil',
									];
								}
							}else{
								$respone = [
									'status' => 'error',
									'message'=> 'Foto Terlalu Besar..!',
								];
							}
						}else{
							$respone = [
								'status' => 'error',
								'message'=> 'Format Foto JPEG | JPG',
							];
						}
				
				    
				}
	    	    }
			}else{
					if ($inputPassword != '') {
					$password = password_hash($inputPassword, PASSWORD_DEFAULT);
					if ($inputPassword == $inputPassword2) {

						if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
							if ($Batas <= 2000000) {
							   
								if (move_uploaded_file($lokasi,$TempatBaru)){
								   
									list($height,$width) = getimagesize($TempatBaru);
									$maxDim = 800; 
									if ( $width > $maxDim || $height > $maxDim ) {
										$ratio = $width/$height;
										if( $ratio > 1) {
											$newwidth  = $maxDim;
											$newheight = $maxDim/$ratio;
										} else {
											$newwidth = $maxDim*$ratio;
											$newheight = $maxDim;
										}
										$tmp 		= imagecreatetruecolor($newwidth, $newheight);
										$src		= imagecreatefromjpeg($TempatBaru);
										imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

										imagejpeg($tmp, $TempatBaru, 75);
									}
									$InsertKetLogin = mysqli_query($conn,"
									UPDATE keterangan_login SET nama_pengguna='$inputnama',level_pengguna='$optionLevel',foto_pengguna='$FotoNya',no_telphone='$textnomor',tanggal_lahir='$datetanggal,tempat_lahir='$texttempat' WHERE id='".$idCekS."'");
									
									$InsertLogin = mysqli_query($conn,"
									UPDATE `users` SET password='$password' WHERE id='".$idDataId."'");
							
									
									$respone = [
										'status' => 'success',
										'message'=> 'Berhasil',
									];
								}
							}else{
								$respone = [
									'status' => 'error',
									'message'=> 'Foto Terlalu Besar..!',
								];
							}
						}else{
							$respone = [
								'status' => 'error',
								'message'=> 'Format Foto JPEG | JPG',
							];
						}
					}else{
						$respone = [
							'status' => 'error',
							'message'=> 'Password Tidak Sama',
						];
					}
				}else{
				if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
							if ($Batas <= 2000000) {
							        unlink('../../image/foto/'.$KeteranganDataLogin['foto_pengguna']);
								if (move_uploaded_file($lokasi,$TempatBaru)){
								   
									list($height,$width) = getimagesize($TempatBaru);
									$maxDim = 800; 
									if ( $width > $maxDim || $height > $maxDim ) {
										$ratio = $width/$height;
										if( $ratio > 1) {
											$newwidth  = $maxDim;
											$newheight = $maxDim/$ratio;
										} else {
											$newwidth = $maxDim*$ratio;
											$newheight = $maxDim;
										}
										$tmp 		= imagecreatetruecolor($newwidth, $newheight);
										$src		= imagecreatefromjpeg($TempatBaru);
										imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

										imagejpeg($tmp, $TempatBaru, 75);
									}
									$InsertKetLogins = mysqli_query($conn,"
									UPDATE keterangan_login SET nama_pengguna='$inputnama',level_pengguna='$optionLevel',foto_pengguna='$FotoNya',no_telphone='$textnomor',tanggal_lahir='$datetanggal',tempat_lahir='$texttempat' WHERE id='".$idCekS."'");
							

									$respone = [
										'status' => 'success',
										'message'=> 'Berhasil',
									];
								}
							}else{
								$respone = [
									'status' => 'error',
									'message'=> 'Foto Terlalu Besar..!',
								];
							}
						}else{
							$respone = [
								'status' => 'error',
								'message'=> 'Format Foto JPEG | JPG',
							];
						}
				
				    
				}
	    	    }
	
	        }else{
	            if($textnomor != $KeteranganDataLogin['no_telphone']) {

    		    $CekInNomor = mysqli_query($conn,"select no_telphone from keterangan_login where no_telphone='".$KeteranganDataLogin['no_telphone']."'");
    		        if (mysqli_num_rows($CekInNomor) > 0) {
            			$respone = [
            				'status' => 'error',
            				'message'=> 'Nomor Sudah Ada',
            			];
    	    	    }else{
    			    
    				if ($inputPassword != '') {
    					$password = password_hash($inputPassword, PASSWORD_DEFAULT);
    					if ($inputPassword == $inputPassword2) {
    
    						if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
    							if ($Batas <= 2000000) {
    							     unlink('../../image/foto/'.$KeteranganDataLogin['foto_pengguna']);
    								if (move_uploaded_file($lokasi,$TempatBaru)){
    								   
    									list($height,$width) = getimagesize($TempatBaru);
    									$maxDim = 800; 
    									if ( $width > $maxDim || $height > $maxDim ) {
    										$ratio = $width/$height;
    										if( $ratio > 1) {
    											$newwidth  = $maxDim;
    											$newheight = $maxDim/$ratio;
    										} else {
    											$newwidth = $maxDim*$ratio;
    											$newheight = $maxDim;
    										}
    										$tmp 		= imagecreatetruecolor($newwidth, $newheight);
    										$src		= imagecreatefromjpeg($TempatBaru);
    										imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    
    										imagejpeg($tmp, $TempatBaru, 75);
    									}
    									$InsertKetLogin = mysqli_query($conn,"
    									UPDATE keterangan_login SET nama_pengguna='$inputnama',level_pengguna='$optionLevel',foto_pengguna='$FotoNya',no_telphone='$textnomor',tanggal_lahir='$datetanggal,tempat_lahir='$texttempat' WHERE id='".$idCekS."'");
    									
    									$InsertLogin = mysqli_query($conn,"
    									UPDATE `users` SET password='$password' WHERE id='".$idDataId."'");
    							
    									
    									$respone = [
    										'status' => 'success',
    										'message'=> 'Berhasil',
    									];
    								}
    							}else{
    								$respone = [
    									'status' => 'error',
    									'message'=> 'Foto Terlalu Besar..!',
    								];
    							}
    						}else{
    							$respone = [
    								'status' => 'error',
    								'message'=> 'Format Foto JPEG | JPG',
    							];
    						}
    					}else{
    						$respone = [
    							'status' => 'error',
    							'message'=> 'Password Tidak Sama',
    						];
    					}
    				}else{
    				if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
    							if ($Batas <= 2000000) {
    							     unlink('../../image/foto/'.$KeteranganDataLogin['foto_pengguna']);
    								if (move_uploaded_file($lokasi,$TempatBaru)){
    								   
    									list($height,$width) = getimagesize($TempatBaru);
    									$maxDim = 800; 
    									if ( $width > $maxDim || $height > $maxDim ) {
    										$ratio = $width/$height;
    										if( $ratio > 1) {
    											$newwidth  = $maxDim;
    											$newheight = $maxDim/$ratio;
    										} else {
    											$newwidth = $maxDim*$ratio;
    											$newheight = $maxDim;
    										}
    										$tmp 		= imagecreatetruecolor($newwidth, $newheight);
    										$src		= imagecreatefromjpeg($TempatBaru);
    										imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    
    										imagejpeg($tmp, $TempatBaru, 75);
    									}
    									$InsertKetLogin = mysqli_query($conn,"
    									UPDATE keterangan_login SET nama_pengguna='$inputnama',level_pengguna='$optionLevel',foto_pengguna='$FotoNya',no_telphone='$textnomor',tanggal_lahir='$datetanggal,tempat_lahir='$texttempat' WHERE id='".$idCekS."'");
    									
    
    									$respone = [
    										'status' => 'success',
    										'message'=> 'Berhasil',
    									];
    								}
    							}else{
    								$respone = [
    									'status' => 'error',
    									'message'=> 'Foto Terlalu Besar..!',
    								];
    							}
    						}else{
    							$respone = [
    								'status' => 'error',
    								'message'=> 'Format Foto JPEG | JPG',
    							];
    						}
    				
    				    
    				}
    	    	    }
    			}else{
    					if ($inputPassword != '') {
    					$password = password_hash($inputPassword, PASSWORD_DEFAULT);
    					if ($inputPassword == $inputPassword2) {
    
    									$InsertKetLogin = mysqli_query($conn,"
    									UPDATE keterangan_login SET nama_pengguna='$inputnama',level_pengguna='$optionLevel',no_telphone='$textnomor',tanggal_lahir='$datetanggal,tempat_lahir='$texttempat' WHERE id='".$idCekS."'");
    									
    									$InsertLogin = mysqli_query($conn,"
    									UPDATE `users` SET password='$password' WHERE id='".$idDataId."'");
    							
    									
    									$respone = [
    										'status' => 'success',
    										'message'=> 'Berhasil',
    									];
    						
    						
    					}else{
    						$respone = [
    							'status' => 'error',
    							'message'=> 'Password Tidak Sama',
    						];
    					}
    				}else{
    			
    						$InsertKetLoginds = mysqli_query($conn,"
    									UPDATE keterangan_login SET nama_pengguna='$inputnama',level_pengguna='$optionLevel',no_telphone='$textnomor',tanggal_lahir='$datetanggal',tempat_lahir='$texttempat' WHERE id='".$idCekS."'");
    								// var_dump($InsertKetLoginds);die();
        
    									$respone = [
    										'status' => 'success',
    										'message'=> 'Berhasil',
    									];
    						
    						
    				
    				    
    				}
    	    	    
    			    
    			}
	        }
	


}elseif(isset($_GET['Delete'])){
	$id = 	$_POST['id'];
	$deletename = $_POST['deletename'];
	if($id != ''){
		$DeleteId = mysqli_query($conn,"UPDATE `users` SET aktif='$deletename' WHERE id_keterangan_data='".$id."'");
		if ($DeleteId == true) {
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

echo json_encode($respone);
