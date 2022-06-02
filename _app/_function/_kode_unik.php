<?php

function _pemesanan(){
	include(__DIR__.'/database.php');
	$query = "SELECT max(kode_pemesanan) as maxKode FROM pemesanan where id";
	// $query 	= "SELECT max(id) as kodeUnik FROM pemesanan";
	$hasil = mysqli_query($conn,$query);
	$data 	= mysqli_fetch_array($hasil);
	$kodeUnikData = $data['maxKode'];
	// var_dump($data);
	$noUrut = (int) substr($kodeUnikData, 7, 10);
	$noUrut++;
	$char = "POS-PJ-";
	$kodeBarang = $char . sprintf("%03s", $noUrut);
	return $kodeBarang;
}
