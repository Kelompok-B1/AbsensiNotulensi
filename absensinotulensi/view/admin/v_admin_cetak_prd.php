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
$html = '<center><h3>Daftar Program Studi Politeknik Negeri Bandung </h3></center><hr/><br/>';
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
 <th>Kode Prodi</th>
 <th>Nama Prodi</th>
 <th>Nama Jurusan</th>
 </tr>';
$no = 1;
$prodi1= $collection->prodi->aggregate([
    ['$lookup'=>(object)array(
                'from'=> "jurusan",
                'localField'=> "kode_jurusan",    
                'foreignField'=> "kode_jurusan",  
                'as'=> "ProdiJurusan"
    )],
    ['$replaceRoot'=>(object)array('newRoot'=>(object)array('$mergeObjects'=>array((object)
    array('$arrayElemAt'=>array('$ProdiJurusan',0)),'$$ROOT')))],
    ['$project'=>(object)array('{ProdiJurusan}'=>0)]
    ]);

foreach ($prodi1 as $prd){
$html .="
<tr>
    <td>".$no."</td>
    <td>".$prd->kode_prodi."</td>
    <td>".$prd->nama_prodi."</td>
    <td>".$prd->nama_jurusan."</td>
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
$dompdf->stream($_SESSION['nama'].'_'.date("d-M-Y").'_laporan_prodi.pdf');
?>
