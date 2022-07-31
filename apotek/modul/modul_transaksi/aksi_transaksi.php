<?php
// open koneksi
include "../../config/koneksi.php";

// direct link untuk menentukan aksi
$page	= $_GET['page'];
$act	= $_GET['act'];

// Aksi menambah data
if($page == 'transaksi' AND $act == 'tambah'){
	try{
		// variabel untuk menampung nilai-nilai dari form tambah
		$idc        		= $_POST['txt_idc'];
		$ido	    		= $_POST['txt_ido'];
		$idk				= $_POST['txt_idk'];
		$tanggal_transaksi	= $_POST['txt_tanggal_transaksi'];
		$total_harga		= $_POST['txt_total_harga'];
		
		// query untuk cek apakah primary dapat digunakan
		$cek    	= pg_query($koneksi,"SELECT * FROM tb_transaksi_penjualan WHERE id_cust='$idc' AND id_obat='$ido' AND id_karyawan='$idk'");

		// validasi primary 
		if(pg_num_rows($cek) == 0){
			// query tambah data
			$sql    =   "INSERT INTO tb_transaksi_penjualan
							(id_cust, id_obat, id_karyawan, tanggal_transaksi, total_harga)
						VALUES(
								'$idc',
								'$ido',
								'$idk',
								'$tanggal_transaksi',
								'$total_harga'
							)";
			// execute query
			$query  = pg_query($koneksi,$sql);
			
			// validasi apakah data berhasil disimpan
			if(pg_num_rows($cek) == 0){
				echo "
					<script type='text/javascript'>
						alert('Data berhasil disimpan');
						window.location.href='../../media.php?page=transaksi';
					</script>
				";
			}else{
				echo "
					<script type='text/javascript'>
						alert('Data gagal disimpan');
						window.location.href='../../media.php?page=transaksi';
					</script>
				";
			}
		}else{
			echo "
				<script type='text/javascript'>
					alert('Data gagal disimpan');
					window.location.href='../../media.php?page=transaksi';
				</script>
			";
		}
	}
	catch(Exception $e){
		echo $e->getMessage();
	}
}

// Aksi merubah data
if($page == 'transaksi' AND $act == 'ubah'){
	try{
		// variabel untuk menampung nilai-nilai dari form ubah
		$idc        		= $_POST['txt_idc'];
		$ido	    		= $_POST['txt_ido'];
		$idk				= $_POST['txt_idk'];
		$tanggal_transaksi	= $_POST['txt_tanggal_transaksi'];
		$total_harga		= $_POST['txt_total_harga'];

		// query ubah data
		$sql    = "UPDATE tb_transaksi_penjualan SET
					tanggal_transaksi	= '$tanggal_transaksi',
					total_harga			= '$total_harga'
						WHERE id_cust='$idc' AND id_obat = '$ido' AND id_karyawan = '$idk'";

		// execute query
		$query  = pg_query($koneksi,$sql);
		
		// cek apakah berhasil diubah
		if($query){
			echo "
				<script type='text/javascript'>
					alert('Data berhasil disimpan');
					window.location.href='../../media.php?page=transaksi';
				</script>
			";
		}else{
			echo "
				<script type='text/javascript'>
					alert('Data gagal disimpan');
					window.location.href='../../media.php?page=transaksi';
				</script>
			";
		}
	}
	catch(Exception $e){
		echo $e->getMessage();
	}
}

?>