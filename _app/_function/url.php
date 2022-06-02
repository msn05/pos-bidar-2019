<?php
function Assets($url = null) {
	$base_url = "http://yolanda2020.websitepalcomtech.com/_vendors/dist/assets";
	if ($url != null) {
		return $base_url."/".$url;
	} else {
		return $base_url ;
	}
}

function Image($url = null) {
	$base_url = "http://yolanda2020.websitepalcomtech.com/_app/image";
	if ($url != null) {
		return $base_url."/".$url;
	} else {
		return $base_url ;
	}
}
function Image1($url = null) {
	$base_url = "http://yolanda2020.websitepalcomtech.com/_app/image/foto";
	if ($url != null) {
		return $base_url."/".$url;
	} else {
		return $base_url ;
	}
}

function Title() {
	$Null = 'SISTEM INFORMASI PERHITUNGAN TARIF PT POS INDONESIA CABANG PALEMBANG';
	return $Null ;
}

function Fav() {
	$Null = 'http://yolanda2020.websitepalcomtech.com/_app/image/logo/favicon.ico';
	return $Null;
	
}