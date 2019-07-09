<?php
$db = mysqli_connect("localhost", "root", "", "db_sisirtarif");

//cek session apakah ADMIN atau DOSEN//
function cek_session($isi_superadmin, $isi_admin, $isi_karyawan) {
    if(@$_SESSION['superadmin']) {
        echo $isi_superadmin;
    } else if(@$_SESSION['admin']) {
        echo $isi_admin;
    } else if(@$_SESSION['karyawan']) {
        echo $isi_karyawan;
    }
}

//membuat fungsi tampil tiap ID//
function tampil_per_ID($table, $where = null) {
	global $db;
	$command = "SELECT * FROM $table";
	if($where != null) {
		$command .= " WHERE $where";
	}
	$query = mysqli_query($db, $command) or die ($db->error);
	return $query;
	mysqli_close($db);
}

//setting tanggal//
function tgl_indo($tgl) {
	$tanggal = substr($tgl,8,2);
	$bulan = getBulan(substr($tgl,5,2));
	$tahun = substr($tgl,0,4);
	return $tanggal.' '.$bulan.' '.$tahun;		 
}
//setting bulan//
function getBulan($bln){
	switch ($bln){
		case 1: 
		return "Januari";
		break;
		case 2:
		return "Februari";
		break;
		case 3:
		return "Maret";
		break;
		case 4:
		return "April";
		break;
		case 5:
		return "Mei";
		break;
		case 6:
		return "Juni";
		break;
		case 7:
		return "Juli";
		break;
		case 8:
		return "Agustus";
		break;
		case 9:
		return "September";
		break;
		case 10:
		return "Oktober";
		break;
		case 11:
		return "November";
		break;
		case 12:
		return "Desember";
		break;
	}
}

?>