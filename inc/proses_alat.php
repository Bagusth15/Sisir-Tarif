<?php  
$id_pel = @$_GET['id_pel'];
include '../+koneksi.php';
if(isset($_POST['add'])) {
  $total = $_POST['total'];
  for ($i=1; $i<=$total; $i++){
    $id_pel = @mysqli_real_escape_string($db, $_POST['id_pel']);
    $nama_peralatan = @mysqli_real_escape_string($db, $_POST['nama_peralatan-'.$i]);
    $keperluan_untuk = @mysqli_real_escape_string($db, $_POST['keperluan_untuk-'.$i]);
    $daya = @mysqli_real_escape_string($db, $_POST['daya-'.$i]);
    $jumlah = @mysqli_real_escape_string($db, $_POST['jumlah-'.$i]);
    $totaldaya = ($daya * $jumlah);
    $pemakaian_alat = @mysqli_real_escape_string($db, $_POST['pemakaian_alat-'.$i]);
    $pemakaian_perkwh = ($totaldaya * $pemakaian_alat) / 1000;
                    // $foto = 'default.jpg';

    $temp = explode(".", $_FILES['foto-'.$i]['name']);
    $new_file_name = $id_pel . ' - Peralatan -' .$nama_peralatan. '-' . $pemakaian_alat . '.'. end($temp);
    $format = pathinfo($new_file_name, PATHINFO_EXTENSION);
    $tmp_name = $_FILES['foto-'.$i]['tmp_name'];        

    if ($tmp_name != '') {
      move_uploaded_file($tmp_name, "../images/alat_pelanggan/".$new_file_name);
      $sql = mysqli_query($db, "INSERT INTO alat_pelanggan VALUES('','$id_pel','$nama_peralatan','$keperluan_untuk','$daya','$jumlah','$totaldaya','$pemakaian_alat','$pemakaian_perkwh','$new_file_name' )")
      or die ($db->error);
    } else {
      $sql = mysqli_query($db, "INSERT INTO alat_pelanggan VALUES('','$id_pel','$nama_peralatan','$keperluan_untuk','$daya','$jumlah','$totaldaya','$pemakaian_alat','$pemakaian_perkwh','default.jpg' )")
      or die ($db->error);
    }    

    $sql_kwh_rt = mysqli_query($db, "SELECT SUM(pemakaian_perkwh) AS kwh_rt FROM alat_pelanggan WHERE id_pel = '$id_pel' AND keperluan_untuk = 'Rumah Tangga' ");
    if (mysqli_num_rows($sql_kwh_rt) > 0) {
      $data_kwh_rt = mysqli_fetch_array($sql_kwh_rt);
      $jumlah_kwh_rt = $data_kwh_rt['kwh_rt'];
      mysqli_query($db, "UPDATE data_testing SET kwh_rt = '$jumlah_kwh_rt' WHERE id_pel = '$id_pel' ")
      or die ($db->error);
    }

    $sql_kwh_bisnis = mysqli_query($db, "SELECT SUM(pemakaian_perkwh) AS kwh_bisnis FROM alat_pelanggan WHERE id_pel = '$id_pel' AND keperluan_untuk = 'Bisnis' ");
    if (mysqli_num_rows($sql_kwh_bisnis) > 0) {
      $data_kwh_bisnis = mysqli_fetch_array($sql_kwh_bisnis);
      $jumlah_kwh_bisnis = $data_kwh_bisnis['kwh_bisnis'];
      mysqli_query($db, "UPDATE data_testing SET kwh_bisnis = '$jumlah_kwh_bisnis' WHERE id_pel = '$id_pel' ")
      or die ($db->error);
    }
    

  }
  if ($sql > 0) {
    echo "<script>alert(' ".$total." data berhasil ditambahkan '); window.location='../?page=data_pelanggan_detail&id_pel=$id_pel';</script>";
  } else {
    echo "<script>alert(' ".$total." data gagal ditambahkan '); window.location='../?page=manajemen_alat&action=alat_generate&id_pel=$id_pel;</script>";
  }
} elseif (isset($_POST['edit'])) {
  $totall = count($_POST['id_alat']);
  $id_pel = @mysqli_real_escape_string($db, $_POST['id_pel']);
  for ($i=0; $i<$totall; $i++){
    $id_alat = @mysqli_real_escape_string($db, $_POST['id_alat'][$i]);
    $nama_peralatan = @mysqli_real_escape_string($db, $_POST['nama_peralatan'][$i]);
    $keperluan_untuk = @mysqli_real_escape_string($db, $_POST['keperluan_untuk'][$i]);
    $daya = @mysqli_real_escape_string($db, $_POST['daya'][$i]);
    $jumlah = @mysqli_real_escape_string($db, $_POST['jumlah'][$i]);
    $totaldaya = ($_POST['daya'][$i] * $_POST['jumlah'][$i]);
    $pemakaian_alat = @mysqli_real_escape_string($db, $_POST['pemakaian_alat'][$i]);
    $pemakaian_perkwh = ($_POST['daya'][$i] * $_POST['jumlah'][$i] * $_POST['pemakaian_alat'][$i]) / 1000;
    // $foto = 'default.jpg';

    $temp = explode(".", $_FILES['foto']['name'][$i]);
    $new_file_name = $id_pel . ' - Peralatan -' .$nama_peralatan. '-' . $id_alat . '.'. end($temp);
    $format = pathinfo($new_file_name, PATHINFO_EXTENSION);
    $tmp_name = $_FILES['foto']['tmp_name'][$i]; 

    if ($tmp_name != '') {
      move_uploaded_file($tmp_name, "../images/alat_pelanggan/".$new_file_name);
      mysqli_query($db, "UPDATE alat_pelanggan SET nama_peralatan = '$nama_peralatan', keperluan_untuk = '$keperluan_untuk', daya = '$daya', jumlah = '$jumlah', total_daya = '$totaldaya', pemakaian_alat = '$pemakaian_alat', pemakaian_perkwh = '$pemakaian_perkwh', foto = '$new_file_name' WHERE id_alat = '$id_alat' ")
      or die ($db->error);
    } else {
      mysqli_query($db, "UPDATE alat_pelanggan SET nama_peralatan = '$nama_peralatan', keperluan_untuk = '$keperluan_untuk', daya = '$daya', jumlah = '$jumlah', total_daya = '$totaldaya', pemakaian_alat = '$pemakaian_alat', pemakaian_perkwh = '$pemakaian_perkwh' WHERE id_alat = '$id_alat' ")
      or die ($db->error);
    }
    

    $sql_kwh_rt = mysqli_query($db, "SELECT SUM(pemakaian_perkwh) AS kwh_rt FROM alat_pelanggan WHERE id_pel = '$id_pel' AND keperluan_untuk = 'Rumah Tangga' ");
    if (mysqli_num_rows($sql_kwh_rt) > 0) {
      $data_kwh_rt = mysqli_fetch_array($sql_kwh_rt);
      $jumlah_kwh_rt = $data_kwh_rt['kwh_rt'];
      mysqli_query($db, "UPDATE data_testing SET kwh_rt = '$jumlah_kwh_rt' WHERE id_pel = '$id_pel' ")
      or die ($db->error);
    }

    $sql_kwh_bisnis = mysqli_query($db, "SELECT SUM(pemakaian_perkwh) AS kwh_bisnis FROM alat_pelanggan WHERE id_pel = '$id_pel' AND keperluan_untuk = 'Bisnis' ");
    if (mysqli_num_rows($sql_kwh_bisnis) > 0) {
      $data_kwh_bisnis = mysqli_fetch_array($sql_kwh_bisnis);
      $jumlah_kwh_bisnis = $data_kwh_bisnis['kwh_bisnis'];
      mysqli_query($db, "UPDATE data_testing SET kwh_bisnis = '$jumlah_kwh_bisnis' WHERE id_pel = '$id_pel' ")
      or die ($db->error);
    }
  }
  
  echo "<script>alert(' ".$totall." data berhasil diedit '); window.location='../?page=data_pelanggan_detail&id_pel=".$id_pel." ';</script>";

}
?>