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
    </head>
    <body>
    <a href="v_admin_tambah_jrs.php">Add New Data</a><br/><br/>
    
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
    </table>
</div>
    <a href="v_admin.php">Back</a><br/><br/>

    <script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );

    </script>
    </body>
</html>