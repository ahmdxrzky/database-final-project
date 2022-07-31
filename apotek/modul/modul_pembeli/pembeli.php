<?php
    // nemapung lokasi path untuk akses kedatabase
    $aksi = "modul/modul_pembeli/aksi_pembeli.php";
    
    //mengatasi variabel yang belum di definisikan (notice undefined index)
    $act = isset($_GET['act']) ? $_GET['act'] : '';

    // percabangan untuk memilih tampilan yang ingin ditampilkan
    switch($act){
        default:
            echo "
                <h3 class='page-header text-primary'> Data Pembeli </h3>
            ";
            echo "
                <h3>
                    <button
                        class='btn btn-sm btn-primary'
                        type='button' style='width:20%'
                        onclick=window.location.href='?page=pembeli&act=tambah'>
                            <span class='glyphicon glyphicon-plus'></span> Tambah Data
                    </button>
                </h3>
            ";

            // membuat tag table untuk menampilkan data
            echo"<table class='table table-bordered table-hover'>";
                echo"                
                    <thead>
                        <tr>
                            <th width='5%'>#</th>
                            <th width='10%'>ID</th>
                            <th width='15%'>Nama</th>
                            <th width='10%'>Alamat</th>
                            <th width='15%'>Jenis Kelamin</th>
                            <th width='15%'>Nomor Ponsel</th>
                            <th width='15%'>Tanggal Lahir</th>
                            <th width='15%'>Aksi</th>
                        </tr>
                    </thead>
                ";
                echo "<tbody>";
                    // query untuk menampilkan data
                    $query  = pg_query($koneksi, "SELECT * FROM tb_customer ORDER BY id_cust");
                    $total  = pg_num_rows($query);
                    $no     = 1;

                    // menampilkan data perbaris ke dalam tag table
                    while($r = pg_fetch_array($query)){
                        echo"
                            <tr>
                                <td>$no</td>
                                <td>$r[id_cust]</td>
                                <td>$r[nama_cust]</td>
                                <td>$r[alamat]</td>
                                <td>$r[jenis_kelamin]</td>
                                <td>$r[no_hp]</td>
                                <td>$r[tanggal_lahir]</td>
                                <td>
                                    <a href='?page=pembeli&act=ubah&id=$r[id_cust]'>
                                        <button type='button' class='btn btn-sm btn-warning'>
                                            <span class='glyphicon glyphicon-edit'></span>
                                        </button>
                                    </a>
                                    <a href='$aksi?page=pembeli&act=hapus&id=$r[id_cust]'>
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
                        <form role='form' action='$aksi?page=pembeli&act=tambah' method='post' name='frm_tambah' id='frm_tambah' enctype='multipart/form-data'>
                            <div class='form-group'>
                                <label>ID Pembeli</label>
                                <input class='form-control' type='text' name='txt_id' id='txt_id' placeholder='Ketikkan ID pembeli. Contoh: IDC-0001' required>
                            </div>

                            <div class='form-group'>
                                <label>Nama</label>
                                <input class='form-control' type='text' name='txt_nama' id='txt_nama' placeholder='Ketikkan nama pembeli' required>
                            </div>

                            <div class='form-group'>
                                <label>Jenis kelamin</label>
                                <div class='radio'>
                                    <label class='radio-inline'>
                                        <input type='radio' name='rb_jenis_kelamin' id='rb_jenis_kelamin' value='Laki-Laki' required>
                                        Laki-Laki
                                    </label>
                                    <label class='radio-inline'>
                                        <input type='radio' name='rb_jenis_kelamin' id='rb_jenis_kelamin' value='Perempuan' required>
                                        Perempuan
                                    </label>
                                </div>
                            </div>

                            <div class='form-group'>
                                <label>Nomor Ponsel</label>
                                <textarea class='form-control' name='txt_no_hp' id_='txt_no_hp' placeholder='Ketikkan nomor ponsel' required></textarea>
                            </div>

                            <div class='form-group'>
                                <label>Tanggal lahir</label>
                                <input class='form-control' type='date' name='txt_tanggal_lahir' id='txt_tanggal_lahir' placeholder='Ketikkan tanggal lahir' required>
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
            $query  = pg_query($koneksi,"SELECT * FROM tb_customer WHERE id_cust='$_GET[id]'");
            $r      = pg_fetch_array($query);

            // Panel ubah data
            echo "<div class='panel panel-default center-block'>";
                echo "<div class='panel-heading'>Form ubah data</div>";
                echo "<div class='panel-body'>";
                    echo "<form role='form' action='$aksi?page=pembeli&act=ubah' method='post' name='frm_ubah' id='frm_ubah' enctype='multipart/form-data'>";
                        
                        // ID pembeli
                        echo "
                            <div class='form-group'>
                                <label>ID Pembeli</label>
                                <input class='form-control' type='text' name='txt_id' id='txt_id' placeholder='Ketikkan ID pembeli. Contoh: IDC-0001' value='$r[id_cust]' readonly>
                            </div>
                        ";
                        
                        // Nama
                        echo "
                            <div class='form-group'>
                                <label>Nama Pembeli</label>
                                <input class='form-control' type='text' name='txt_nama' id='txt_nama' placeholder='Ketikkan nama lengkap' value='$r[nama_cust]' required>
                            </div>
                        ";
                        
                        // Jenis Kelamin
                        echo "<div class='form-group'>";
                            echo "<label>Jenis Kelamin</label>";
                            if($r["jenis_kelamin"] == "Laki-Laki"){
                                echo "
                                    <div class='radio'>
                                        <label class='radio-inline'>
                                            <input type='radio' name='rb_jenis_kelamin' id='rb_jenis_kelamin' value='Laki-Laki' checked>
                                            Laki-Laki
                                        </label>
                                        <label class='radio-inline'>
                                            <input type='radio' name='rb_jenis_kelamin' id='rb_jenis_kelamin' value='Perempuan'>
                                            Perempuan
                                        </label>
                                    </div>
                                ";
                            }else{
                                echo "
                                    <div class='radio'>
                                        <label class='radio-inline'>
                                            <input type='radio' name='rb_jenis_kelamin' id='rb_jenis_kelamin' value='Laki-Laki'>
                                            Laki-Laki
                                        </label>
                                        <label class='radio-inline'>
                                            <input type='radio' name='rb_jenis_kelamin' id='rb_jenis_kelamin' value='Perempuan' checked>
                                            Perempuan
                                        </label>
                                    </div>
                                ";
                            }
                        echo "</div>";
                        
                        // Nomor HP
                        echo"
                            <div class='form-group'>
                                <label>Nomor Ponsel</label>
                                <textarea class='form-control' name='txt_no_hp' id_='txt_no_hp' placeholder='Ketikkan nomor ponsel' required>$r[no_hp]</textarea>
                            </div>
                        ";

                        // Tanggal lahir
                        echo"
                            <div class='form-group'>
                                <label>Tanggal lahir</label>
                                <input class='form-control' type='date' name='txt_tanggal_lahir' id='txt_tanggal_lahir' placeholder='Masukan tanggal lahir' value='$r[tanggal_lahir]' required>
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