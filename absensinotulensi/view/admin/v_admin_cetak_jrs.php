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
$html = '<center><h3>Daftar Jurusan Politeknik Negeri Bandung </h3></center><hr/><br/>';
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
 <th>Kode Jurusan</th>
 <th>Nama Jurusan </th>
 </tr>';
$no = 1;
$jurusan = $collection ->jurusan->find([]);

foreach ($jurusan as $jrs){
$html .="
<tr>
    <td>".$no."</td>
    <td>".$jrs->kode_jurusan."</td>
    <td>".$jrs->nama_jurusan."</td>
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
$dompdf->stream($_SESSION['nama'].'_'.date("d-M-Y").'_laporan_jurusan.pdf');
?>
