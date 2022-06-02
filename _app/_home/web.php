<?php 
error_reporting(0);
session_start(); 
$LevelNya = $_SESSION['level_pengguna'];
if (@$_SESSION['LogIn'] == false) {
	header("location:../index.php");
}else{
	require_once(__DIR__.'/../_function/url.php');
	require_once(__DIR__.'/../_function/database.php');

	include(__DIR__.'/_temp/_header.php');
	include(__DIR__.'/_temp/_menu.php');

	@$content   = $_GET['Halaman'];
	@$aksi      = $_GET['Aksi'];
	$validpage  = array("_jasa","_level","_tarif","_users","_ketentuan_jasa","_keterangan_tarif","_Bea_jasa","_pengirim","_penerima","_pembayaran","_pengiriman","_laporan","_akun");
	$validadmin = array("_jasa","_level","_tarif","_users","_ketentuan_jasa","_keterangan_tarif","_Bea_jasa","_pengirim","_penerima","_pembayaran","_pengiriman","_laporan","_akun");


	if (in_array($content, $validpage)){
		if ($LevelNya == 1) {
			if($aksi ==""){
				include(__DIR__."/".$content."/".$content.".php");
			}elseif ($aksi=="form" && in_array($content, $validadmin)) {
				include(__DIR__."/".$content."/Form.php");
			} elseif ($aksi=="tambah" && in_array($content, $validadmin)) {
				include(__DIR__."/".$content."/tambah.php");
			} elseif ($aksi=="_info" && in_array($content, $validadmin)) {
				include(__DIR__."/".$content."/_info.php");
			}
		}elseif($LevelNya == 2){
			if($aksi ==""){
				include(__DIR__."/".$content."/".$content.".php");
			}elseif ($aksi=="form" && in_array($content, $validadmin)) {
				include(__DIR__."/".$content."/Form.php");
			} elseif ($aksi=="tambah" && in_array($content, $validadmin)) {
				include(__DIR__."/".$content."/tambah.php");
			} elseif ($aksi=="_info" && in_array($content, $validadmin)) {
				include(__DIR__."/".$content."/_info.php");
			}
		}elseif($LevelNya == 3){
			if($aksi ==""){
				include(__DIR__."/".$content."/".$content.".php");
			}elseif ($aksi=="form" && in_array($content, $validadmin)) {
				include(__DIR__."/".$content."/Form.php");
			} elseif ($aksi=="tambah" && in_array($content, $validadmin)) {
				include(__DIR__."/".$content."/tambah.php");
			} elseif ($aksi=="_info" && in_array($content, $validadmin)) {
				include(__DIR__."/".$content."/_info.php");
			}
		}else{
			if($aksi ==""){
				include(__DIR__."/".$content."/".$content.".php");
			}elseif ($aksi=="form" && in_array($content, $validadmin)) {
				include(__DIR__."/".$content."/Form.php");
			} elseif ($aksi=="_info" && in_array($content, $validadmin)) {
				include(__DIR__."/".$content."/_info.php");
			}
		}
	}else{
		include(__DIR__."/_dashboard.php");
	}
	require_once(__DIR__.'/_temp/_footer.php');
}


?>

