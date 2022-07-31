<?php
// open koneksi
include "../../config/koneksi.php";

// direct link untuk menentukan aksi
$page	= $_GET['page'];
$act	= $_GET['act'];

// Aksi menambah data
if($page == 'obat' AND $act == 'tambah'){
    try{
        // variabel untuk menampung nilai-nilai dari form tambah
        $id                 = $_POST['txt_id'];
        $nama               = $_POST['txt_nama'];
        $jenis_obat         = $_POST['txt_jenis_obat'];
        $harga_obat         = $_POST['txt_harga_obat'];
        $kegunaan_obat      = $_POST['txt_kegunaan_obat'];

        // query untuk cek apakah primary dapat digunakan
        $cek    = pg_query($koneksi,"SELECT * FROM tb_obat WHERE id_obat='$id'");

        // validasi primary 
        if(pg_num_rows($cek) == 0){
            // query tambah data
            $sql    =   "INSERT INTO tb_obat
                            (id_obat, nama_obat, jenis_obat, harga_obat, kegunaan_obat)
                        VALUES(
                                '$id',
                                '$nama',
                                '$jenis_obat',
                                '$harga_obat',
                                '$kegunaan_obat'
                            )";
            // execute query
            $query  = pg_query($koneksi,$sql);

            // query untuk cek apakah data berhasil disimpan
            $cek    = pg_query($koneksi,"SELECT * FROM tb_obat WHERE id_obat='$id'");
            
            // validasi apakah data berhasil disimpan
            if(pg_num_rows($cek) != 0){
                echo "
                    <script type='text/javascript'>
                        alert('Data berhasil disimpan');
                        window.location.href='../../media.php?page=obat';
                    </script>
                ";
            }else{
                echo "
                    <script type='text/javascript'>
                        alert('Data gagal disimpan');
                        window.location.href='../../media.php?page=obat';
                    </script>
                ";
            }
        }else{
            echo "
                <script type='text/javascript'>
                    alert('Data gagal disimpan');
                    window.location.href='../../media.php?page=obat';
                </script>
            ";
        }
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
}

// Aksi merubah data
if($page == 'obat' AND $act == 'ubah'){
    try{
        // variabel untuk menampung nilai-nilai dari form ubah
        $id                 = $_POST['txt_id'];
        $nama               = $_POST['txt_nama'];
        $jenis_obat         = $_POST['txt_jenis_obat'];
        $harga_obat         = $_POST['txt_harga_obat'];
        $kegunaan_obat      = $_POST['txt_kegunaan_obat'];

        // query ubah data
        $sql    = "UPDATE tb_obat set
                    nama_obat       = '$nama',
                    jenis_obat      = '$jenis_obat',
                    harga_obat      = '$harga_obat',
                    kegunaan_obat   = '$kegunaan_obat'
                        where id_obat = '$id';
        ";

        // execute query
        $query  = pg_query($koneksi,$sql);
        
        // cek apakah berhasil diubah
        if($query){
            echo "
                <script type='text/javascript'>
                    alert('Data berhasil disimpan');
                    window.location.href='../../media.php?page=obat';
                </script>
            ";
        }else{
            echo "
                <script type='text/javascript'>
                    alert('Data gagal disimpan');
                    window.location.href='../../media.php?page=obat';
                </script>
            ";
        }
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
}

// Aksi menghapus data
if($page == 'obat' AND $act == 'hapus'){
    try{
        // variabel untuk menampung nilai-nilai dari form hapus
        $id = $_GET['id'];

        // Query untuk menghapus data
        $sql = "DELETE FROM tb_obat
                WHERE id_obat='$id'
        ";

        // execute query
        $query  = pg_query($koneksi,$sql);

        // cek apakah berhasil diubah
        if($query){
            echo "
                <script type='text/javascript'>
                    alert('Data berhasil dihapus');
                    window.location.href='../../media.php?page=obat';
                </script>
            ";
        }else{
            echo "
                <script type='text/javascript'>
                    alert('Data gagal dihapus');
                    window.location.href='../../media.php?page=obat';
                </script>
            ";
        }
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
}

?>