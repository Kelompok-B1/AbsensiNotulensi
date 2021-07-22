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
$html = '<center><h3>Daftar Mahasiswa  Politeknik Negeri Bandung </h3></center><hr/><br/>';
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
 <th>NIM</th>
 <th>Nama Mahasiswa</th>
 <th>Jenis Kelamin</th>
 <th>Kode Kelas </th>
 <th>No Telepon </th>
 <th>Alamat </th>
 <th>Email</th>
 </tr>';
$no = 1;
$mahasiswa = $collection ->mahasiswa->find([]);

foreach ($mahasiswa as $mhs){
$html .="
<tr>
<td>".$no."</td>
<td>".$mhs->nim."</td>
<td>".$mhs->nama_mhs."</td>
<td>".$mhs->jk."</td>
<td>".$mhs->kode_kelas."</td>
<td>".$mhs->no_telp."</td>
<td>".$mhs->alamat->kampung." ".$mhs->alamat->no_rumah."</td>
<td>".$mhs->email."</td>
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
$dompdf->stream($_SESSION['nama'].'_'.date("d-M-Y").'_laporan_mahasiswa.pdf');
?>
