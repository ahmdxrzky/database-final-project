<?php
	// menetapkan parameter
	$host = "localhost";
	$port = "5432";
	$dbname = "db_apotek";
	$user = "postgres";
	$password = "123456"; 
	
	// membuat string koneksi
	$dbconn = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} ";
	
	// membuka koneksi
	$koneksi = pg_connect($dbconn);
	
	// cek koneksi
	if($koneksi){
		//echo "Berhasil";
	}

?>

