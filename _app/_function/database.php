<?php
$dbhost   	= "localhost";
$dbuser 	= "websit17_website";
$dbpass 	= "Akamsi1234567890";
$dbname 	= "websit17_yolanda";

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {
	die('Koneksi Database Gagal : '.$conn->connect_error);
}
?>