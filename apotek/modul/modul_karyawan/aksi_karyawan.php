<?php
// open koneksi
include "../../config/koneksi.php";

// direct link untuk menentukan aksi
$page	= $_GET['page'];
$act	= $_GET['act'];

// Aksi menambah data
if($page == 'karyawan' AND $act == 'tambah'){
    try{
        // variabel untuk menampung nilai-nilai dari form tambah
        $id                 = $_POST['txt_id'];
        $nama               = $_POST['txt_nama'];
        $divisi             = $_POST['cb_divisi'];
        $alamat             = $_POST['txt_alamat'];
        $no_hp              = $_POST['txt_no_hp'];
      
        // query untuk cek apakah primary dapat digunakan
        $cek    = pg_query($koneksi,"SELECT * FROM tb_karyawan WHERE id_karyawan='$id'");

        // validasi primary 
        if(pg_num_rows($cek) == 0){
            // query tambah data
            $sql    =   "INSERT INTO tb_karyawan
                            (id_karyawan, nama_karyawan, divisi, alamat, no_hp)
                        VALUES(
                                '$id',
                                '$nama',
                                '$divisi',
                                '$alamat',
                                '$no_hp'
                            )";
            // execute query
            $query  = pg_query($koneksi,$sql);

            // query untuk cek apakah data berhasil disimpan
            $cek    = pg_query($koneksi,"SELECT * FROM tb_karyawan WHERE id_karyawan='$id'");
            
            // validasi apakah data berhasil disimpan
            if(pg_num_rows($cek) != 0){
                echo "
                    <script type='text/javascript'>
                        alert('Data berhasil disimpan');
                        window.location.href='../../media.php?page=karyawan';
                    </script>
                ";
            }else{
                echo "
                    <script type='text/javascript'>
                        alert('Data gagal disimpan');
                        window.location.href='../../media.php?page=karyawan';
                    </script>
                ";
            }
        }else{
            echo "
                <script type='text/javascript'>
                    alert('Data gagal disimpan');
                    window.location.href='../../media.php?page=karyawan';
                </script>
            ";
        }
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
}

// Aksi merubah data
if($page == 'karyawan' AND $act == 'ubah'){
    try{
        // variabel untuk menampung nilai-nilai dari form ubah
        $id                 = $_POST['txt_id'];
        $nama               = $_POST['txt_nama'];
        $divisi             = $_POST['cb_divisi'];
        $alamat             = $_POST['txt_alamat'];
        $no_hp              = $_POST['txt_no_hp'];

        // query ubah data
        $sql    = "UPDATE tb_karyawan set
                    nama_karyawan   = '$nama',
                    divisi          = '$divisi',
                    alamat          = '$alamat',
                    no_hp           = '$no_hp'
                        where id_karyawan = '$id';
        ";

        // execute query
        $query  = pg_query($koneksi,$sql);
        
        // cek apakah berhasil diubah
        if($query){
            echo "
                <script type='text/javascript'>
                    alert('Data berhasil disimpan');
                    window.location.href='../../media.php?page=karyawan';
                </script>
            ";
        }else{
            echo "
                <script type='text/javascript'>
                    alert('Data gagal disimpan');
                    window.location.href='../../media.php?page=karyawan';
                </script>
            ";
        }
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
}

// Aksi menghapus data
if($page == 'karyawan' AND $act == 'hapus'){
    try{
        // variabel untuk menampung nilai-nilai dari form hapus
        $id = $_GET['id'];

        // Query untuk menghapus data
        $sql = "DELETE FROM tb_karyawan 
                WHERE id_karyawan='$id'
        ";

        // execute query
        $query  = pg_query($koneksi,$sql);

        // cek apakah berhasil diubah
        if($query){
            echo "
                <script type='text/javascript'>
                    alert('Data berhasil dihapus');
                    window.location.href='../../media.php?page=karyawan';
                </script>
            ";
        }else{
            echo "
                <script type='text/javascript'>
                    alert('Data gagal dihapus');
                    window.location.href='../../media.php?page=karyawan';
                </script>
            ";
        }
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
}

?>