<?php
    // nemapung lokasi path untuk akses kedatabase
    $aksi = "modul/modul_karyawan/aksi_karyawan.php";
    
    //mengatasi variabel yang belum di definisikan (notice undefined index)
    $act = isset($_GET['act']) ? $_GET['act'] : '';

    // percabangan untuk memilih tampilan yang ingin ditampilkan
    switch($act){
        default:
            echo "
                <h3 class='page-header text-primary'> Data Karyawan </h3>
            ";
            echo "
                <h3>
                    <button
                        class='btn btn-sm btn-primary'
                        type='button' style='width:20%'
                        onclick=window.location.href='?page=karyawan&act=tambah'>
                            <span class='glyphicon glyphicon-plus'></span> Tambah Data
                    </button>
                </h3>
            ";

            // membuat tag table untuk menampilkan data
            echo"<table class='table table-bordered table-hover'>";
                echo"                
                    <thead>
                        <tr>
                            <th width='5%'><center>#</center></th>
                            <th width='10%'><center>ID</center></th>
                            <th width='25%'><center>Nama</center></th>
                            <th width='15%'><center>Divisi</center></th>
                            <th width='10%'><center>Alamat</center></th>
                            <th width='15%'><center>Nomor Ponsel</center></th>
                            <th width='10%'><center>Aksi</center></th>
                        </tr>
                    </thead>
                ";
                echo "<tbody>";
                    // query untuk menampilkan data
                    $query  = pg_query($koneksi, "SELECT * FROM tb_karyawan ORDER BY id_karyawan");
                    $total  = pg_num_rows($query);
                    $no     = 1;

                    // menampilkan data perbaris ke dalam tag table
                    while($r = pg_fetch_array($query)){
                        echo"
                            <tr>
                                <td>$no</td>
                                <td>$r[id_karyawan]</td>
                                <td>$r[nama_karyawan]</td>
                                <td>$r[divisi]</td>
                                <td>$r[alamat]</td>
                                <td>$r[no_hp]</td>
                                <td>
                                    <a href='?page=karyawan&act=ubah&id=$r[id_karyawan]'>
                                        <button type='button' class='btn btn-sm btn-warning'>
                                            <span class='glyphicon glyphicon-edit'></span>
                                        </button>
                                    </a>
                                    <a href='$aksi?page=karyawan&act=hapus&id=$r[id_karyawan]'>
                                        <button type='button' class='btn btn-sm btn-danger'>
                                            <span class='glyphicon glyphicon-trash'></span>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        ";
                        $no++;
                    }
                echo "</tbody>";
            echo"</table>";
        break;

        case "tambah":
            echo "<div class='panel panel-default center-block'>";
                echo "<div class='panel-heading'>Form tambah data</div>";
                echo "<div class='panel-body'>";
                    echo "
                        <form role='form' action='$aksi?page=karyawan&act=tambah' method='post' name='frm_tambah' id='frm_tambah' enctype='multipart/form-data'>
                            <div class='form-group'>
                                <label>ID Karyawan</label>
                                <input class='form-control' type='text' name='txt_id' id='txt_id' placeholder='Ketikkan ID karyawan. Contoh: G74180045' required>
                            </div>

                            <div class='form-group'>
                                <label>Nama Karyawan</label>
                                <input class='form-control' type='text' name='txt_nama' id='txt_nama' placeholder='Ketikkan nama karyawan' required>
                            </div>

                            <div class='form-group'>
                            <label>Divisi</label>
                            <select class='form-control' name='cb_divisi' id='cb_divisi' required>
                                <option value=''>- Divisi -</option>
                                <option value='Front Office'>Front Office</option>
                                <option value='Web Developer'>Web Developer</option>
                            </select>
                            </div>

                            <div class='form-group'>
                                <label>Nomor Ponsel</label>
                                <input class='form-control' type='text' name='txt_no_hp' id_='txt_no_hp' placeholder='Ketikkan nomor ponsel' required>
                            </div>
                            
                            <div class='form-group'>
                                <label>Alamat</label>
                                <textarea class='form-control' name='txt_alamat' id_='txt_alamat' placeholder='Ketikkan daerah tempat tinggal' rows='5' required></textarea>
                            </div>

                            <div class='form-group'>
                                <button class='btn btn-sm btn-primary' type='submit' style='width:20%'><span class='glyphicon glyphicon-save'></span> Simpan</button>
                            </div>
                        </form>
                    ";
                echo "</div>"; // tutup tag body panel
            echo "</div>"; // tutup tag panel
        break;

        case "ubah":
            // Query SQL
            $query  = pg_query($koneksi,"SELECT * FROM tb_karyawan WHERE id_karyawan='$_GET[id]'");
            $r      = pg_fetch_array($query);

            // Panel ubah data
            echo "<div class='panel panel-default center-block'>";
                echo "<div class='panel-heading'>Form ubah data</div>";
                echo "<div class='panel-body'>";
                    echo "<form role='form' action='$aksi?page=karyawan&act=ubah' method='post' name='frm_ubah' id='frm_ubah' enctype='multipart/form-data'>";
                        
                        // ID karyawan
                        echo "
                            <div class='form-group'>
                                <label>ID Karyawan</label>
                                <input class='form-control' type='text' name='txt_id' id='txt_id' placeholder='Ketikkan ID karyawan. Contoh: G74180045' value='$r[id_karyawan]' readonly>
                            </div>
                        ";
                        
                        // Nama
                        echo "
                            <div class='form-group'>
                                <label>Nama Karyawan</label>
                                <input class='form-control' type='text' name='txt_nama' id='txt_nama' placeholder='Ketikkan nama lengkap' value='$r[nama_karyawan]' required>
                            </div>
                        ";
                        
                        // divisi
                        if($r["divisi"] == "Front Office"){ 
                            $semester1 = "selected";
                        }else if($r["divisi"] == "Web Developer"){
                            $semester2 = "selected"; 
                        }

                        // Divisi
                        echo"<div class='form-group'>";
                            echo "<label>Divisi</label>";
                            echo "<select class='form-control' name='cb_divisi' id='cb_divisi'>";
                                echo "<option value=''>- Divisi -</option>";
                                echo "<option $semester1 value='Front Office'>Front Office</option>";
                                echo "<option $semester2 value='Web Developer'>Web Developer</option>";
                            echo "</select>";
                        echo "</div>";
                        
                        // Nomor HP
                        echo"
                            <div class='form-group'>
                                <label>Nomor Ponsel</label>
                                <input class='form-control' type='text' name='txt_no_hp' id_='txt_no_hp' placeholder='Ketikkan nomor ponsel' value='$r[no_hp]' required>
                            </div>
                        ";
                        
                        // Alamat
                        echo"
                            <div class='form-group'>
                                <label>Alamat</label>
                                <textarea class='form-control' name='txt_alamat' id_='txt_alamat' placeholder='Ketikkan daerah tempat tinggal' rows='5' required>$r[alamat]</textarea>
                            </div>
                        ";

                        // Submit
                        echo"
                            <div class='form-group'>
                                <button class='btn btn-sm btn-primary' type='submit' style='width:20%'><span class='glyphicon glyphicon-save'></span> Simpan</button>
                            </div>
                        ";

                    echo "</form>"; // tutup tag form
                echo "</div>"; // tutup tag body panel
            echo "</div>"; // tutup tag panel
        break;
    }
?> 