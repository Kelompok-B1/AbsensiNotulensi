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
$html = '<center><h3>Daftar Absensi</h3></center><hr/><br/>';
$html .= "<table>


</table>";
$html .= 'Nama Dosen :'.$_SESSION['nama'].'<br>' ;
$html.="Tanggal : <b>".date("d-M-Y", $tanggal)."</b> ";
date_default_timezone_set('Asia/Jakarta');
$jam=date("H:i:s");
$html.="| Pukul : <b>". $jam." "."</b>";
$html .= '<table border="1" width="100%">
 <tr>
    <th>No</th>
    <th>Kode Absensi</th>
    <th>NIM</th>
    <th>Kode MK</th>
    <th>Kode kelas</th>
    <th>Foto</th>  
    <th>Periode</th>
    <th>Status</th>
 </tr>';
$no = 1;
$absensi= $collection->absensi->find(['data_absen.nip'=>$_SESSION['nip']]);

foreach ($absensi as $abs){
$html .="
<tr>
<td>".$no."</td>
<td>".$abs->kode_absensi."</td>
<td>".$abs->data_absen->nim."</td>
<td>".$abs->data_absen->kode_mk."</td>
<td>".$abs->data_absen->nip."</td>
<td><img src='../mahasiswa/images/selfie/".$abs->url_foto."'></td>
<td>".$abs->periode->waktu->jam.":".$abs->periode->waktu->menit.
":".$abs->periode->waktu->detik." ".$abs->periode->tanggal->hari."-"
.$abs->periode->tanggal->bulan."-".$abs->periode->tanggal->tahun."
</td>";

if($abs->status==1){
    $html .= "<td> Hadir </td>";
}else{
    $html .=  "<td> Tidak Hadir </td>";
}

$html .= "</tr>";
$no++;

}


$html .= "</html>";
$dompdf->loadHtml($html);
// Setting ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'landscape');
// Rendering dari HTML Ke PDF
$dompdf->render();
// Melakukan output file Pdf
$dompdf->stream($_SESSION['nama'].'_'.date("d-M-Y").'_laporan_absensi.pdf');
?>
