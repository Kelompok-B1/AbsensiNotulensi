<?php 
require '../../vendor/autoload.php';
require '../../model/connect.php';
$no = 1;
?>

<?php require_once('header.php'); ?>
<div class="container">
    <form class = "post-list">
        <input type = "hidden" value = "" />
    </form>
    <h3 align=center><b>Data Mahasiswa</b></h3><br>
    <a href="v_admin.php" type = "submit" class = "btn btn-primary post_search_submit">Kembali</a>
    <a href="v_admin_tambah_mhs.php" type="submit" name="submit" class="btn btn-success">Tambah Data Baru</a><br/><br/>
    <article class="navbar-form navbar-left ml-b">
        <div class="form-group">
            <label>Per Halaman: </label>
            <select class="form-control post_max">
                <option value="40">40</option>
                <option value="80">80</option>
                <option value="160">160</option>
            </select>
            
            &nbsp;<label>Cari Kata Kunci: </label>
            <input type="text" class="form-control post_search_text" placeholder="Masukkan Kata Kunci">
        </div>
        <input type = "submit" value = "Telusuri" class = "btn btn-primary post_search_submit" />
    </article>
   
    <br class = "clear" />
   
    <div class = "wave-box-wrapper">
        <div class = "wave-box"></div>
        <table class = "table table-striped table-post-list no-margin">
            <thead>
                <tr>
                    <th id = "no" class = "active" >No.</th>
                    <th id = "nim" class = "active">NIM</th>
                    <th id = "nama" class = "active">Nama</th>
                    <th id = "jk" class = "active">Jenis Kelamin</th>
                    <th id = "kode_kelas" class = "active">Kode Kelas</th>
                    <th id = "no_telp" class = "active">No.Telepon</th>
                    <th id = "alamat" class = "active">Alamat</th>
                    <th id = "email" class = "active">Email</th>
                    <th id = "action" class = "active">Aksi</th>
                </tr>
            </thead>
            <?php 
            $mahasiswa = $collection ->mahasiswa->find([]);

            foreach ($mahasiswa as $mhs){
                echo "<tr>";
                echo "<td>".$no."</td>";
                echo "<td>".$mhs->nim."</td>";
                echo "<td>".$mhs->nama_mhs."</td>";
                echo "<td>".$mhs->jk."</td>";
                echo "<td>".$mhs->kode_kelas."</td>";
                echo "<td>".$mhs->no_telp."</td>";
                echo "<td>".$mhs->alamat->kampung." ".$mhs->alamat->no_rumah."</td>";
                
                echo "<td>".$mhs->email."</td>";
                echo "<td><a href='v_admin_edit_mhs.php?id=".$mhs->_id."' >Ubah</a> | 
                    <a href='v_admin_delete_mhs.php?id=".$mhs->_id."' >Hapus</a></td>";
                echo "</tr>";
                
                $no +=1;
            }
            ?>
                <tbody class = "pagination-container"></tbody>
        </table>
        <div class = "pagination-nav"></div>
    </div>
</div>