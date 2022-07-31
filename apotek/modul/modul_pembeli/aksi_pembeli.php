<?php
// open koneksi
include "../../config/koneksi.php";

// direct link untuk menentukan aksi
$page	= $_GET['page'];
$act	= $_GET['act'];

// Aksi menambah data
if($page == 'pembeli' AND $act == 'tambah'){
    try{
        // variabel untuk menampung nilai-nilai dari form tambah
        $id                = $_POST['txt_id'];
        $nama               = $_POST['txt_nama'];
        $alamat             = $_POST['txt_alamat'];
        $jenis_kelamin      = $_POST['rb_jenis_kelamin'];
        $no_hp              = $_POST['txt_no_hp'];
        $tanggal_lahir      = $_POST['txt_tanggal_lahir'];

        // query untuk cek apakah primary dapat digunakan
        $cek    = pg_query($koneksi,"SELECT * FROM tb_customer WHERE id_cust='$id'");

        // validasi primary 
        if(pg_num_rows($cek) == 0){
            // query tambah data
            $sql    =   "INSERT INTO tb_customer
                            (id_cust, nama_cust, alamat, jenis_kelamin, no_hp, tanggal_lahir)
                        VALUES(
                                '$id',
                                '$nama',
                                '$alamat',
                                '$jenis_kelamin',
                                '$no_hp',
                                '$tanggal_lahir'
                            )";
            // execute query
            $query  = pg_query($koneksi,$sql);

            // query untuk cek apakah data berhasil disimpan
            $cek    = pg_query($koneksi,"SELECT * FROM tb_customer WHERE id_cust='$id'");
            
            // validasi apakah data berhasil disimpan
            if(pg_num_rows($cek) != 0){
                echo "
                    <script type='text/javascript'>
                        alert('Data berhasil disimpan');
                        window.location.href='../../media.php?page=pembeli';
                    </script>
                ";
            }else{
                echo "
                    <script type='text/javascript'>
                        alert('Data gagal disimpan');
                        window.location.href='../../media.php?page=pembeli';
                    </script>
                ";
            }
        }else{
            echo "
                <script type='text/javascript'>
                    alert('Data gagal disimpan');
                    window.location.href='../../media.php?page=pembeli';
                </script>
            ";
        }
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
}

// Aksi merubah data
if($page == 'pembeli' AND $act == 'ubah'){
    try{
        // variabel untuk menampung nilai-nilai dari form ubah
        $id                = $_POST['txt_id'];
        $nama               = $_POST['txt_nama'];
        $alamat             = $_POST['txt_alamat'];
        $jenis_kelamin      = $_POST['rb_jenis_kelamin'];
        $no_hp              = $_POST['txt_no_hp'];
        $tanggal_lahir      = $_POST['txt_tanggal_lahir'];

        // query ubah data
        $sql    = "UPDATE tb_customer set
                    nama_cust       = '$nama',
                    alamat          = '$alamat',
                    jenis_kelamin   = '$jenis_kelamin',
                    no_hp           = '$no_hp',
                    tanggal_lahir   = '$tanggal_lahir'
                        where id_cust = '$id';
        ";

        // execute query
        $query  = pg_query($koneksi,$sql);
        
        // cek apakah berhasil diubah
        if($query){
            echo "
                <script type='text/javascript'>
                    alert('Data berhasil disimpan');
                    window.location.href='../../media.php?page=pembeli';
                </script>
            ";
        }else{
            echo "
                <script type='text/javascript'>
                    alert('Data gagal disimpan');
                    window.location.href='../../media.php?page=pembeli';
                </script>
            ";
        }
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
}

// Aksi menghapus data
if($page == 'pembeli' AND $act == 'hapus'){
    try{
        // variabel untuk menampung nilai-nilai dari form hapus
        $id = $_GET['id'];

        // Query untuk menghapus data
        $sql = "DELETE FROM tb_customer
                WHERE id_cust='$id'
        ";

        // execute query
        $query  = pg_query($koneksi,$sql);

        // cek apakah berhasil diubah
        if($query){
            echo "
                <script type='text/javascript'>
                    alert('Data berhasil dihapus');
                    window.location.href='../../media.php?page=pembeli';
                </script>
            ";
        }else{
            echo "
                <script type='text/javascript'>
                    alert('Data gagal dihapus');
                    window.location.href='../../media.php?page=pembeli';
                </script>
            ";
        }
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
}

?>