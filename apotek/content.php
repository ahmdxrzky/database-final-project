<?php
    // load koneksi dan library
    include "config/koneksi.php";
    include "config/library.php";

    // halaman utama
    if($_GET["page"] == "home"){
        $tgl=date("Y-m-d");
		$tanggal=tgl_indo($tgl);
        
		// Menampilkan selamat datang dan tanggal
		echo "<p align=\"center\">Halo, <b>".strtoupper($_SESSION["ses_nama"])."</b>! Anda berhasil masuk ke akun anda di situs web <b> Manajemen Data Apotek</b>.</p>";
		echo "<p align=\"center\">Anda login hari ini pada tanggal $tanggal.</p>"; echo "<br>";

    }
    else if($_GET["page"] == "pembeli"){
        include "modul/modul_pembeli/pembeli.php";
    }
    else if($_GET["page"] == "karyawan"){
        include "modul/modul_karyawan/karyawan.php";
    }
    else if($_GET["page"] == "obat"){
        include "modul/modul_obat/obat.php";
    }
    else if($_GET["page"] == "transaksi"){
        include "modul/modul_transaksi/transaksi.php";
    }
    // menampilkan pesan ketika modul sedang dikerjakan
?>