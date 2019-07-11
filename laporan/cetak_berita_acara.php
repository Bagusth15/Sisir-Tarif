<?php
@session_start();
include "../+koneksi.php";
include "fpdf.php";
$id_pel = $_GET['id_pel'];
$sql_data = mysqli_query($db, "SELECT * FROM pelanggan JOIN user ON pelanggan.nik = user.nik JOIN data_daya_tarif ON pelanggan.id_daya_tarif = data_daya_tarif.id_daya_tarif JOIN data_peruntukan_persil ON pelanggan.id_peruntukan_persil = data_peruntukan_persil.id_peruntukan_persil  WHERE pelanggan.id_pel = '$id_pel' ");
$data_pel = mysqli_fetch_array($sql_data);

$pdf = new FPDF('P','mm','A4');
$pdf->SetMargins(15,20,15);
$pdf->AddPage();

$pdf->Image('../images/Perusahaan_Listrik_Negara.png',15,18,16);
$pdf->SetTitle("Berita Acara ".$data_pel['id_pel']);
$pdf->SetFont('Arial','B',13);
$pdf->Cell(0,5,'              PT.PLN (Persero)','0','1','L',false);
$pdf->Cell(0,5,'              UNIT INDUK DISTRIBUSI JAKARTA RAYA','0','1','L',false);
$pdf->Cell(0,5,'              UP3 CENGKARENG','0','1','L',false);
$pdf->SetFont('Arial','',8);
$pdf->Ln(5);
$pdf->Cell(0,5,'Kantor 1 : Jl. Lingkar Luar Duri Kosambi, Cengkareng - Jakarta Telp. 021-5440329, 5440328 Fax. 021-5440340','0','1','L',false);
$pdf->Cell(0,2,'Kantor 2 : Jl. Raya Peta Selatan No. 39 Kalideres, Jakarta Barat 11840 Telp. 544 7630 (Hunting), Fax. 540 7427','0','1','L',false);
$pdf->Ln(3);
$pdf->Cell(180,0.6,'','0','1','C',true);
$pdf->Ln(5);

$tgl = $data_pel['date'];
$pdf->SetFont('Arial','BU',11);
$pdf->Cell(0,5,'BERITA ACARA','0','1','C',false);
$pdf->Ln(7);
$pdf->SetFont('Arial','',9);

$pdf->Cell(0,5,'No                            : '.$data_pel['id'].'/AGA.01.01/A.CKR/2019','0','1','L',false);
$pdf->Cell(0,5,'Perihal                      : Penyesuaian Tarif Sesuai Penggunaan','0','1','L',false);
$pdf->Cell(0,5,date('d F Y'),'0','1','R',false);
$pdf->Cell(0,5,'Kepada Yth:','0','1','R',false);
$pdf->Cell(0,5,$data_pel['nama'],'0','1','R',false);
$pdf->Cell(0,5,$data_pel['alamat_pel'],'0','1','R',false);
$pdf->Ln(7);

$pdf->Cell(0,5,'Dengan Hormat,','0','1','L',false);
$pdf->Ln(3);
$pdf->MultiCell(0,5,'Sehubungan dengan hasil pengamatan kami di lapangan, bahwa peruntukan pemakaian daya listrik dengan data sebagai berikut :');
$pdf->Ln(3);
$pdf->SetFont('Arial','',9);
$pdf->Cell(40,6,'Nama',1,0,'C');
$pdf->Cell(30,6,'ID Pel',1,0,'C');
$pdf->Cell(85,6,'Alamat',1,0,'C');
$pdf->Cell(25,6,'Tarif/Daya',1,0,'C');
$pdf->Ln(2);
$pdf->Ln(4);
$pdf->Cell(40,4,$data_pel['nama'],1,0,'C');
$pdf->Cell(30,4,$data_pel['id_pel'],1,0,'C');
$pdf->Cell(85,4,$data_pel['alamat_pel'],1,0,'C');
$pdf->Cell(25,4,$data_pel['daya_tarif'],1,0,'C');
$pdf->Ln(7);
$pdf->SetFont('Arial','B',9);
$teksbold = "";
$pdf->SetFont('Arial','',9);
$pdf->MultiCell(0,5,'Saat ini adalah untuk kegiatan '.$data_pel['keterangan'].', maka sesuai dengan Peraturan Menteri Energi dan Sumber Daya Mineral No. 31 Tahun 2014 Tentang Tarif Tenaga Listrik untuk Keperluan Layanan Khusus ( Tarif L ) maka tarif yang dikenakan saat ini Rumah Tangga akan kami sesuaikan menjadi tarif L/TR ( Tarif L Tegangan Rendah ) mulai Rekening Bulan '.date('F Y').'.');
$pdf->Ln(3);
$pdf->MultiCell(0,5,'Perubahan tarif dapat dilakukan setelah kegiatan konstruksi selesai dan pihak pelanggan dapat mengajukan surat permohonan perubahan tarif sesuai dengan kegiatan usahanya.');
$pdf->Ln(3);
$pdf->MultiCell(0,5,'Demikian kami sampaikan atas kerjasamanya kami ucapkan terima kasih.');

$pdf->Ln(50);
$pdf->SetLeftMargin(160);
$pdf->SetFont('Arial','',10);
$pdf->Cell(0,0,"Manager Bagian Pemasaran",0,0,'R');
$pdf->Ln(30);
$pdf->Cell(0,0,"(Margaretty P. Naolin)     ",0,0,'R');
$pdf->Output();
?>