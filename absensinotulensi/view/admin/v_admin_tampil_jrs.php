<?php 
require '../../vendor/autoload.php';
require '../../model/connect.php';
$no = 1;
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" media="screen" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/contact.js"></script>
    </head>
    <?php require_once('header.php'); ?>
    <div class="container">
        <form class = "post-list">
            <input type = "hidden" value = "" />
        </form>
        <h3 align=center><b>Data Jurusan</b></h3><br>
        <a href="v_admin.php" type = "submit" class = "btn btn-primary post_search_submit">Kembali</a>
        <a href="v_admin_tambah_jrs.php" type="submit" name="submit" class="btn btn-success"  >Tambah Data Baru</a><br/><br/>

        <body>
        <br>
        <div class="container">
            <table id="example" class="table table-striped table-bordered">
                <thead>
                    <th>No</th>
                        <th>Kode Jurusan</th>
                        <th>Nama Jurusan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                <?php 
                
                # $arai = $collection ->inventory->aggregate({$project=>{colors=>{$size=>array('$colors')}}});
                
                $jurusan = $collection ->jurusan->find([]);
                
                foreach ($jurusan as $jrs){
                    echo "<tr>";
                    echo "<td>".$no."</td>";
                    echo "<td>".$jrs->kode_jurusan."</td>";
                    echo "<td>".$jrs->nama_jurusan."</td>";
                    echo "<td><a href='v_admin_edit_jrs.php?id=".$jrs->_id."' >Edit</a> | 
                        <a href='v_admin_delete_jrs.php?id=".$jrs->_id."' >Delete</a></td>";
                    echo "</tr>";
                    
                    $no +=1;
                    
                }
            
                ?>
                </tbody>
                <tbody class = "pagination-container"></tbody>
            </table>
            <div class = "pagination-nav"></div>
        </div>

        <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );

        </script>
    </body>
</html>