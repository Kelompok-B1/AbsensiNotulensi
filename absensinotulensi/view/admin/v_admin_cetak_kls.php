<?php
require '../../vendor/autoload.php';
require '../../model/connect.php';
require_once("../dompdf/autoload.inc.php");

session_start();
  if($_SESSION['status_login']!="sudah_login"){
    header("location:../../MainFrame/index.php?pesan=belum_login");
}
use Dompdf\Dompdf;
$dompdf = new Dompdf();



$tanggal= mktime(date("m"),date("d"),date("Y"));
$html = '<center><h3>Daftar Kelas Politeknik Negeri Bandung </h3></center><hr/><br/>';
$html .= "<table>


</table>";
$html .= 'Nama Admin :'.$_SESSION['nama'].'<br>' ;
$html.="Tanggal : <b>".date("d-M-Y", $tanggal)."</b> ";
date_default_timezone_set('Asia/Jakarta');
$jam=date("H:i:s");
$html.="| Pukul : <b>". $jam." "."</b>";
$html .= '<table border="1" width="100%">
 <tr>
 <th>No</th>
 <th>Kode Kelas</th>
 <th>Nama Kelas</th>
 <th>Nama Prodi</th>
 </tr>';+

$no = 1;
$kelas1= $collection->kelas->aggregate([
                            ['$lookup'=>(object)array(
                                        'from'=> "prodi",
                                        'localField'=> "kode_prodi",    
                                        'foreignField'=> "kode_prodi",  
                                        'as'=> "KelasProdi"
                            )],
                            ['$replaceRoot'=>(object)array('newRoot'=>(object)array('$mergeObjects'=>array((object)
                            array('$arrayElemAt'=>array('$KelasProdi',0)),'$$ROOT')))],
                        ['$project'=>(object)array('KelasProdi'=>0)]
                            ]); 

foreach ($kelas1 as $kls){
$html .="
<tr>
<td>$no</td>
<td>$kls->kode_kelas</td>
<td>$kls->nama_kelas</td>
<td>$kls->nama_prodi</td>
</tr>";
$no++;
}


$html .= "</html>";
$dompdf->loadHtml($html);
// Setting ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'landscape');
// Rendering dari HTML Ke PDF
$dompdf->render();
// Melakukan output file Pdf
$dompdf->stream($_SESSION['nama'].'_'.date("d-M-Y").'_laporan_kelas.pdf');
?>
