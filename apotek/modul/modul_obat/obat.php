<?php
    // nemapung lokasi path untuk akses kedatabase
    $aksi = "modul/modul_obat/aksi_obat.php";
    
    //mengatasi variabel yang belum di definisikan (notice undefined index)
    $act = isset($_GET['act']) ? $_GET['act'] : '';

    // percabangan untuk memilih tampilan yang ingin ditampilkan
    switch($act){
        default:
            echo "
                <h3 class='page-header text-primary'> Daftar Obat </h3>
            ";
            echo "
                <h3>
                    <button
                        class='btn btn-sm btn-primary'
                        type='button' style='width:20%'
                        onclick=window.location.href='?page=obat&act=tambah'>
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
                            <th width='20%'><center>Nama</center></th>
                            <th width='15%'><center>Jenis</center></th>
                            <th width='10%'><center>Harga</center></th>
                            <th width='30%'><center>Kegunaan</center></th>
                            <th width='10%'><center>Aksi</th>
                        </tr>
                    </thead>
                ";
                echo "<tbody>";
                    // query untuk menampilkan data
                    $query  = pg_query($koneksi, "SELECT * FROM tb_obat ORDER BY id_obat");
                    $total  = pg_num_rows($query);
                    $no     = 1;

                    // menampilkan data perbaris ke dalam tag table
                    while($r = pg_fetch_array($query)){
                        echo"
                            <tr>
                                <td>$no</td>
                                <td>$r[id_obat]</td>
                                <td>$r[nama_obat]</td>
                                <td>$r[jenis_obat]</td>
                                <td>$r[harga_obat]</td>
                                <td>$r[kegunaan_obat]</td>
                                <td>
                                    <a href='?page=obat&act=ubah&id=$r[id_obat]'>
                                        <button type='button' class='btn btn-sm btn-warning'>
                                            <span class='glyphicon glyphicon-edit'></span>
                                        </button>
                                    </a>
                                    <a href='$aksi?page=obat&act=hapus&id=$r[id_obat]'>
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
                        <form role='form' action='$aksi?page=obat&act=tambah' method='post' name='frm_tambah' id='frm_tambah' enctype='multipart/form-data'>
                            <div class='form-group'>
                                <label>ID Obat</label>
                                <input class='form-control' type='text' name='txt_id' id='txt_id' placeholder='Ketikkan ID obat. Contoh: IDO-0001' required>
                            </div>

                            <div class='form-group'>
                                <label>Nama Obat</label>
                                <input class='form-control' type='text' name='txt_nama' id='txt_nama' placeholder='Ketikkan nama obat' required>
                            </div>

                            <div class='form-group'>
                                <label>Jenis Obat</label>
                                <input class='form-control' type='text' name='txt_jenis_obat' id='txt_jenis_obat' placeholder='Ketikkan jenis obat' required>
                            </div>

                            <div class='form-group'>
                                <label>Harga Obat</label>
                                <input class='form-control' type='number' name='txt_harga_obat' id='txt_harga_obat' placeholder='Ketikkan harga obat' required>
                            </div>

                            <div class='form-group'>
                                <label>Kegunaan Obat</label>
                                <textarea class='form-control' name='txt_kegunaan_obat' id_='txt_kegunaan_obat' placeholder='Ketikkan kegunaan obat' rows='5' required></textarea>
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
            $query  = pg_query($koneksi,"SELECT * FROM tb_obat WHERE id_obat='$_GET[id]'");
            $r      = pg_fetch_array($query);

            // Panel ubah data
            echo "<div class='panel panel-default center-block'>";
                echo "<div class='panel-heading'>Form ubah data</div>";
                echo "<div class='panel-body'>";
                    echo "<form role='form' action='$aksi?page=obat&act=ubah' method='post' name='frm_ubah' id='frm_ubah' enctype='multipart/form-data'>";
                        
                        // ID obat
                        echo "
                            <div class='form-group'>
                                <label>ID Obat</label>
                                <input class='form-control' type='text' name='txt_id' id='txt_id' placeholder='Ketikkan ID obat. Contoh: IDO-0001' value='$r[id_obat]' readonly>
                            </div>
                        ";
                        
                        // Nama
                        echo "
                            <div class='form-group'>
                                <label>Nama Obat</label>
                                <input class='form-control' type='text' name='txt_nama' id='txt_nama' placeholder='Ketikkan nama obat' value='$r[nama_obat]' required>
                            </div>
                        ";
                        
                        // Jenis
                        echo "
                            <div class='form-group'>
                                <label>Jenis Obat</label>
                                <input class='form-control' type='text' name='txt_jenis_obat' id='txt_jenis_obat' placeholder='Ketikkan jenis obat' value='$r[jenis_obat]' required>
                            </div>
                        ";

                        // Harga
                        echo "
                            <div class='form-group'>
                                <label>Harga Obat</label>
                                <input class='form-control' type='number' name='txt_harga_obat' id='txt_harga_obat' placeholder='Ketikkan harga obat' value='$r[harga_obat]' required>
                            </div>
                        ";

                        // Kegunaan
                        echo "
                            <div class='form-group'>
                                <label>Kegunaan Obat</label>
                                <textarea class='form-control' name='txt_kegunaan_obat' id_='txt_kegunaan_obat' placeholder='Ketikkan kegunaan obat' rows='5' required>$r[kegunaan_obat]</textarea>
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