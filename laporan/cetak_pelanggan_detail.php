<?php
@session_start();
include "../+koneksi.php";
include "fpdf.php";

$pdf = new FPDF('P','mm','A4');
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
$pdf->Cell(180,0.6,'','0','1','C',true);
$pdf->Ln(5);
	
	$id_pel = $_GET['id_pel'];
	$sql_data = mysqli_query($db, "SELECT * FROM pelanggan JOIN user ON pelanggan.nik = user.nik JOIN data_daya_tarif ON pelanggan.id_daya_tarif = data_daya_tarif.id_daya_tarif JOIN data_peruntukan_persil ON pelanggan.id_peruntukan_persil = data_peruntukan_persil.id_peruntukan_persil  WHERE pelanggan.id_pel = '$id_pel' ");
	$data_pel = mysqli_fetch_array($sql_data);
	$tgl = $data_pel['date'];
	$pdf->SetFont('Arial','BU',11);
	$pdf->Cell(0,5,'BERITA ACARA SURVEI LOKASI TARIF BISNIS','0','1','C',false);
	$pdf->Ln(7);
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(0,5,'            Pada Tanggal '.$tgl.', Kami yang bertanda tangan dibawah ini selaku Petugas Lapangan Pekerjaan SR','0','1','L',false);
	$pdf->Cell(0,5,'PLN (PERSERO) Distribusi Jakarta Raya UP3 Cengkareng, telah melakukan survey lokasi dengan data sebagai berikut :','0','1','L',false);
	$pdf->Ln(2);
	$pdf->Cell(0,5,'Nama                        : '.$data_pel['nama'],'0','1','L',false);
	$pdf->Cell(0,5,'Alamat                      : '.$data_pel['alamat'],'0','1','L',false);
	$pdf->Cell(0,5,'Tarif/Daya                 : '.$data_pel['daya_tarif'],'0','1','L',false);
	$pdf->Cell(0,5,'Id Pel.                       : '.$data_pel['id_pel'],'0','1','L',false);
	$pdf->Cell(0,5,'Peruntukan Persil     : '.$data_pel['peruntukan_persil'],'0','1','L',false);
	$pdf->Cell(0,5,'Keterangan               : '.$data_pel['keterangan'],'0','1','L',false);
	$pdf->Ln(3);
	$pdf->SetFont('Arial','BU',9);
	$pdf->Cell(0,5,'Peralatan elektronik yang digunakan :','0','1','L',false);
	$pdf->Ln(2);
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(5,6,'#',1,0,'C');
	$pdf->Cell(30,6,'Nama Peralatan',1,0,'C');
	$pdf->Cell(15,6,'Daya',1,0,'C');
	$pdf->Cell(20,6,'Jumlah',1,0,'C');
	$pdf->Cell(20,6,'Total',1,0,'C');
	$pdf->Cell(30,6,'Digunakan Untuk',1,0,'C');
	$pdf->Cell(30,6,'Pemakaian Alat',1,0,'C');
	$pdf->Cell(30,6,'Pemakaian Perhari',1,0,'C');
	$pdf->Ln(2);
	$no = 1;
	$sql = mysqli_query($db, "SELECT * FROM alat_pelanggan WHERE id_pel = '$id_pel' ORDER BY keperluan_untuk ") or die ($db->error);
	while($data = mysqli_fetch_array($sql)) {
		$pdf->Ln(4);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(5,4,$no++.".",1,0,'C');
		$pdf->Cell(30,4,$data['nama_peralatan'],1,0,'C');
		$pdf->Cell(15,4,$data['daya'],1,0,'C');
		$pdf->Cell(20,4,$data['jumlah'],1,0,'C');
		$pdf->Cell(20,4,$data['total_daya'],1,0,'C');
		$pdf->Cell(30,4,$data['keperluan_untuk'],1,0,'C');
		$pdf->Cell(30,4,$data['pemakaian_alat'],1,0,'C');
		$pdf->Cell(30,4,$data['pemakaian_perkwh'],1,0,'C');
	}
$pdf->Ln(50);
$pdf->SetLeftMargin(160);
$pdf->SetFont('Arial','',10);
$pdf->Cell(0,0,"    Petugas Survey",0,0,'L');
$pdf->Ln(30);
$pdf->Cell(0,0,"(".$data_pel['nama_lengkap'].")        ",0,0,'R');
$pdf->Output();
?>