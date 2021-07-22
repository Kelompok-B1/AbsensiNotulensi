<?php
require '../../vendor/autoload.php';
require '../../model/connect.php';
require_once("../dompdf/autoload.inc.php");
error_reporting(0);
session_start();
  if($_SESSION['status_login']!="sudah_login"){
    header("location:../../MainFrame/index.php?pesan=belum_login");
}
use Dompdf\Dompdf;
$dompdf = new Dompdf();



$tanggal= mktime(date("m"),date("d"),date("Y"));
$html = '<center><h3>Daftar Dosen Politeknik Negeri Bandung </h3></center><hr/><br/>';
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
                    <th>NIP</th>
                    <th>Nama Dosen</th>
                    <th>JK</th>
                    <th>No Telp</th>
                    <th>Alamat</th>
                    <th>Email</th>
                    <th>Kode Kelas</th>
                    <th>Kode Mata Kuliah</th>
 </tr>';
$no = 1;
$dosen1= $collection->pegawai->aggregate([
    ['$lookup'=>(object)array(
                'from'=> "kelas",
                'localField'=> "kode_kelas",    
                'foreignField'=> "kode_kelas",  
                'as'=> "PegawaiKelas"
    )],

    ['$lookup'=>(object)array(
                'from'=> "matakuliah",
                'localField'=> "kode_mk",    
                'foreignField'=> "kode_mk",  
                'as'=> "PegawaiMatkul"
    )],
    
   ['$match'=>(object)array('jabatan'=>'D')],
    ]); 

foreach ($dosen1 as $dsn){
$html .="
<tr>
<td>".$no."</td>
<td>".$dsn->nip."</td>
<td>".$dsn->nama_pgw."</td>
<td>".$dsn->jk."</td>
<td>".$dsn->no_telp."</td>
<td>".$dsn->alamat->kampung." ".$dsn->alamat->no_rumah."</td>
<td>".$dsn->email."</td>";
$html .= "<td>";
for($kdk = 0; $kdk < 10; $kdk++) {
    if ($dsn->kode_kelas[$kdk]==null) {
    break;
    }
    $html .= $dsn->PegawaiKelas[$kdk]->kode_kelas."<br>";
  }

$html .= "</td>";

$html .= "<td>";

for ($x = 0; $x < 10; $x++) {
    if ($dsn->kode_mk[$x]==null) {
   break;
    }
    $html .= $dsn->PegawaiMatkul[$x]->kode_mk."<br>";
  }

$no++;

}



$html .= "</td>";
$html .= "</tr>";
$html .= "</html>";
$dompdf->loadHtml($html);
// Setting ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'landscape');
// Rendering dari HTML Ke PDF
$dompdf->render();
// Melakukan output file Pdf
$dompdf->stream($_SESSION['nama'].'_'.date("d-M-Y").'_laporan_dosen.pdf');
?>
