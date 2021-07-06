<?php 
require '../../vendor/autoload.php';
require '../../model/connect.php';
$no = 1;

error_reporting(0);


    /* Custom document class that stores a UTCDateTime and time zone and also
     * implements the UTCDateTime interface for portability. */
   



?>
<?php
$tanggal= mktime(date("m"),date("d"),date("Y"));

echo "Tanggal :".date("d-M-Y", $tanggal) ;
date_default_timezone_set('Asia/Jakarta');
$jam=date("H:i:s");
echo " Jam :".$jam ."\n";

echo date("M");

?>  
<html>
    <head></head>
    <body>
    <a href="v_admin_tambah_mkl.php">Add New Data</a><br/><br/>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Kode Mata Kuliah</th>
            <th>Nama Mata Kuliah</th>
            <th>NIP</th>
            <th>Aksi</th>
        </tr>
    
    <?php 
        
       # $arai = $collection ->inventory->aggregate({$project=>{colors=>{$size=>array('$colors')}}});
        
        $matakuliah = $collection ->matakuliah->find([]);

        foreach ($matakuliah as $mkl){
            echo "<tr>";
            echo "<td>".$no."</td>";
            echo "<td>".$mkl->kode_mk."</td>";
            echo "<td>".$mkl->nama_mk."</td>";
            echo "<td>"; 
            for ($nip = 0; $nip < 10; $nip++) {
                if ($mkl->nip[$nip]==null) {
                break;
                }
                echo $mkl->nip[$nip]." ";
              }
           echo "</td>";

            echo "<td><a href='v_admin_edit_mkl.php?id=".$mkl->_id."' >Edit</a> | 
                <a href='v_admin_delete_mkl.php?id=".$mkl->_id."' >Delete</a></td>";
            echo "</tr>";
            
            $no +=1;
            
        }

     
    ?>
    <?php
      
    ?>
    </table>
    <a href="v_admin.php">Back</a><br/><br/>
    </body>
</html>