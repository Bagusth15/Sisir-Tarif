<?php
include '../+koneksi.php';
@session_start();

if(@$_GET['sesi'] == 'superadmin') {
	$nik = @$_SESSION['superadmin'];
	mysqli_query($db, "INSERT INTO user_online VALUES('$nik', now(), 'OFFLINE')")
                    or die ($db->error);
	@$_SESSION['superadmin'] = null;
	echo "<script>window.location='../';</script>";
} else if(@$_GET['sesi'] == 'admin') {
	$nik = @$_SESSION['admin'];
	mysqli_query($db, "INSERT INTO user_online VALUES('$nik', now(), 'OFFLINE')")
                    or die ($db->error);
	@$_SESSION['admin'] = null;
	echo "<script>window.location='../';</script>";
} else if(@$_GET['sesi'] == 'karyawan') {
	$nik = @$_SESSION['karyawan'];
	mysqli_query($db, "INSERT INTO user_online VALUES('$nik', now(), 'OFFLINE')")
                    or die ($db->error);
	@$_SESSION['karyawan'] = null;
	echo "<script>window.location='../';</script>";
}


?>