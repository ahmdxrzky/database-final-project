<?php
    // nemapung lokasi path untuk akses kedatabase
    $aksi = "modul/modul_transaksi/aksi_transaksi.php";
    
    //mengatasi variabel yang belum di definisikan (notice undefined index)
    $act = isset($_GET['act']) ? $_GET['act'] : '';

    // percabangan untuk memilih tampilan yang ingin ditampilkan
    switch($act){
        default:
            echo "
                <h3 class='page-header text-primary'> Riwayat Transaksi </h3>
            ";
            echo "
                <h3>
                    <button
                        class='btn btn-sm btn-primary'
                        type='button' style='width:20%'
                        onclick=window.location.href='?page=transaksi&act=tambah'>
                            <span class='glyphicon glyphicon-plus'></span> Tambah Data
                    </button>
                </h3>

                
            ";

            // membuat tag table untuk menampilkan data
            echo"<table class='table table-bordered table-hover'>";
                echo"                
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID Pembeli</th>
                            <th>Nama Pembeli</th>
                            <th>ID Obat</th>
                            <th>Nama Obat</th>
                            <th>ID Karyawan</th>
                            <th>Nama Karyawan</th>
                            <th>Tanggal Transaksi</th>
                            <th>Total Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                ";
                echo "<tbody>";
                    // query untuk menampilkan data
                    $query  = pg_query($koneksi, "SELECT D.id_cust, B.nama_cust, D.id_obat, A.nama_obat, D.id_karyawan, C.nama_karyawan, D.tanggal_transaksi, D.total_harga
                                                    FROM tb_obat A, tb_customer B, tb_karyawan C, tb_transaksi_penjualan D
                                                    WHERE A.id_obat = D.id_obat AND B.id_cust = D.id_cust AND C.id_karyawan = D.id_karyawan;
                ");
                    $total  = pg_num_rows($query);
                    $no     = 1;

                    // menampilkan data perbaris ke dalam tag table
                    while($r = pg_fetch_array($query)){
                        echo"
                            <tr>
                                <td>$no</td>
                                <td>$r[id_cust]</td>
                                <td>$r[nama_cust]</td>
                                <td>$r[id_obat]</td>
                                <td>$r[nama_obat]</td>
                                <td>$r[id_karyawan]</td>
                                <td>$r[nama_karyawan]</td>
                                <td>$r[tanggal_transaksi]</td>
                                <td>$r[total_harga]</td>
                                <td>
                                    <a href='?page=transaksi&act=ubah&idc=$r[id_cust]&ido=$r[id_obat]&idk=$r[id_karyawan]'>
                                        <button type='button' class='btn btn-sm btn-warning'>
                                            <span class='glyphicon glyphicon-edit'></span>
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
                        <form role='form' action='$aksi?page=transaksi&act=tambah' method='post' name='frm_tambah' id='frm_tambah' enctype='multipart/form-data'>
                            <div class='form-group'>
                                <label>ID Pembeli</label>
                                <input class='form-control' type='text' name='txt_idc' id='txt_idc' placeholder='Ketikkan ID Pembeli. Contoh: IDC-0001' required>
                            </div>

                            <div class='form-group'>
                                <label>ID Obat</label>
                                <input class='form-control' type='text' name='txt_ido' id='txt_ido' placeholder='Ketikkan ID Obat. Contoh: IDO-0001' required>
                            </div>

                            <div class='form-group'>
                                <label>ID Karyawan</label>
                                <input class='form-control' type='text' name='txt_idk' id='txt_idk' placeholder='Ketikkan ID Karyawan. Contoh: G74180045' required>
                            </div>

                            <div class='form-group'>
                                <label>Tanggal transaksi</label>
                                <input class='form-control' type='date' name='txt_tanggal_transaksi' id='txt_tanggal_transaksi' placeholder='Ketikkan tanggal transaksi' required>
                            </div>

                            <div class='form-group'>
                                <label>Total harga</label>
                                <input class='form-control' type='number' name='txt_total_harga' id='txt_total_harga' placeholder='Ketikkan total harga' required>
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
            $query  = pg_query($koneksi, "SELECT D.id_cust, B.nama_cust, D.id_obat, A.nama_obat, D.id_karyawan, C.nama_karyawan, D.tanggal_transaksi, D.total_harga
                                            FROM tb_obat A, tb_customer B, tb_karyawan C, tb_transaksi_penjualan D
                                            WHERE D.id_obat = '$_GET[ido]' AND D.id_cust = '$_GET[idc]' AND D.id_karyawan = '$_GET[idk]'");
            $r      = pg_fetch_array($query);

            // Panel ubah data
            echo "<div class='panel panel-default center-block'>";
                echo "<div class='panel-heading'>Form ubah data</div>";
                echo "<div class='panel-body'>";
                    echo "<form role='form' action='$aksi?page=transaksi&act=ubah' method='post' name='frm_ubah' id='frm_ubah' enctype='multipart/form-data'>";
                        
                        // ID Pembeli
                        echo "
                            <div class='form-group'>
                                <label>ID Pembeli</label>
                                <input class='form-control' type='text' name='txt_idc' id='txt_idc' placeholder='Ketikkan ID Pembeli. Contoh: IDC-0001' value='$r[id_cust]' readonly>
                            </div>
                        ";

                        // ID Obat
                        echo "
                            <div class='form-group'>
                                <label>ID Obat</label>
                                <input class='form-control' type='text' name='txt_ido' id='txt_ido' placeholder='Ketikkan ID Obat. Contoh: IDO-0001' value='$r[id_obat]' readonly>
                            </div>
                        ";
                        
                        // ID Karyawan
                        echo "
                            <div class='form-group'>
                                <label>ID Karyawan</label>
                                <input class='form-control' type='text' name='txt_idk' id='txt_idk' placeholder='Ketikkan ID Karyawan. Contoh: G74180045' value='$r[id_karyawan]' readonly>
                            </div>
                        ";
                        
                        // Tanggal Transaksi
                        echo "
                            <div class='form-group'>
                                <label>Tanggal transaksi</label>
                                <input class='form-control' type='date' name='txt_tanggal_transaksi' id='txt_tanggal_transaksi' placeholder='Masukkan tanggal transaksi berlangsung' value='$r[tanggal_transaksi]' required>
                            </div>
                        ";

                        // Total Harga
                        echo "
                            <div class='form-group'>
                                <label>Total harga</label>
                                <input class='form-control' type='number' name='txt_total_harga' id='txt_total_harga' placeholder='Ketikkan total harga' value='$r[total_harga]' required>
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