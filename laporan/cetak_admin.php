<?php
@session_start();
include "../+koneksi.php";
include "fpdf.php";

$pdf = new FPDF('L','mm','A4');
$pdf->SetMargins(15,20,15);
$pdf->AddPage();

$pdf->Image('../images/Perusahaan_Listrik_Negara.png',15,18,16);
$pdf->SetTitle("Cetak Data");
$pdf->SetFont('Arial','B',13);
$pdf->Cell(0,5,'              PT.PLN (Persero)','0','1','L',false);
$pdf->Cell(0,5,'              UNIT INDUK DISTRIBUSI JAKARTA RAYA','0','1','L',false);
$pdf->Cell(0,5,'              UP3 CENGKARENG','0','1','L',false);
$pdf->SetFont('Arial','',8);
$pdf->Ln(5);
$pdf->Cell(0,5,'Kantor 1 : Jl. Lingkar Luar Duri Kosambi, Cengkareng - Jakarta Telp. 021-5440329, 5440328 Fax. 021-5440340','0','1','L',false);
$pdf->Cell(0,2,'Kantor 2 : Jl. Raya Peta Selatan No. 39 Kalideres, Jakarta Barat 11840 Telp. 544 7630 (Hunting), Fax. 540 7427','0','1','L',false);
$pdf->Ln(3);
$pdf->Cell(265,0.6,'','0','1','C',true);
$pdf->Ln(5);

	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(0,5,'Data Akun Admin Sisir Tarif PLN','0','1','C',false);
	$pdf->Ln(3);
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(5,6,'#',1,0,'C');
	$pdf->Cell(20,6,'NIK',1,0,'C');
	$pdf->Cell(40,6,'Nama Lengkap',1,0,'C');
	$pdf->Cell(30,6,'Email',1,0,'C');
	$pdf->Cell(40,6,'No Telp',1,0,'C');
	$pdf->Cell(65,6,'Alamat',1,0,'C');
	$pdf->Cell(33,6,'Username',1,0,'C');
	$pdf->Cell(32,6,'Password',1,0,'C');
	$pdf->Ln(2);
	$no = 1;
	$sql = mysqli_query($db, "SELECT * FROM user WHERE hak_akses = 'Admin' ") or die ($db->error);
	while($data = mysqli_fetch_array($sql)) {
		$pdf->Ln(4);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(5,4,$no++.".",1,0,'C');
		$pdf->Cell(20,4,$data['nik'],1,0,'C');
		$pdf->Cell(40,4,$data['nama_lengkap'],1,0,'C');
		$pdf->Cell(30,4,$data['email'],1,0,'C');
		$pdf->Cell(40,4,$data['no_telp'],1,0,'C');
		$pdf->Cell(65,4,$data['alamat'],1,0,'C');
		$pdf->Cell(33,4,$data['username'],1,0,'C');
		$pdf->Cell(32,4,$data['pass'],1,0,'C');
	}
$pdf->Ln(50);
$pdf->SetLeftMargin(230);
$pdf->SetFont('Arial','',10);
$pdf->Cell(0,0,"Jakarta, ".tgl_indo(date('Y-m-d')),0,0,'L');
$pdf->Ln(30);
$pdf->Cell(0,0,"(...............................)",0,0,'L');
$pdf->Output();
?>