<?php  
$id = @$_GET['id'];
$id_pel = @$_GET['id_pel'];
$sql_per_id = mysqli_query($db, "SELECT * FROM pelanggan WHERE id = '$id'") or die ($db->error);
$data = mysqli_fetch_array($sql_per_id);
?>
<?php if (@$_GET['action'] == 'tambah_pelanggan'): ?>
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
        Tambah Data Pelanggan
      </h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Tambah</a></li>
          <li class="breadcrumb-item active" aria-current="page">Data Pelanggan</li>
        </ol>
      </nav>
    </div>
    <div class="row">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <form class="forms-sample" method="post" action="?page=data_pelanggan_manajemen&action=proses_tambah" enctype="multipart/form-data">
              <div class="form-group">
                <label for="id_pel">ID Pelanggan</label>
                <input type="text" class="form-control" name="id_pel" placeholder="Ex : 12345678" required>
              </div>
              <div class="form-group">
                <label for="nama">Nama Pelanggan</label>
                <input type="text" class="form-control" name="nama" placeholder="Ex : Bagus" required>
              </div>
              <div class="form-group">
                <label for="no_telp">No Telp</label>
                <input type="text" class="form-control" name="no_telp" placeholder="Ex : 0212345678" required>
              </div>
              <div class="form-group">
                <label for="alamat_pel">Alamat</label>
                <textarea class="form-control" name="alamat_pel" rows="4" placeholder="Ex : Jln. Bedahan RT.09 / RW.01" required></textarea>
              </div>
              <div class="form-group">
                <label for="tarif">Tarif / Daya</label>
                <select name="tarif" class="form-control">
                  <option value="#">-- Pilih Tarif / Daya --</option>
                  <?php
                  $sql_daya = mysqli_query($db, "SELECT * FROM data_daya_tarif ") or die ($db->error);
                  while($data_daya = mysqli_fetch_array($sql_daya)) {
                    echo '<option value="'.$data_daya['id_daya_tarif'].'">'.$data_daya['daya_tarif'].'</option>';
                  } ?>
                </select>  
              </div>
              <div class="form-group">
                <label for="foto">Peruntukan Persil</label>
                <?php
                $sql_peruntukan_persil = mysqli_query($db, "SELECT * FROM data_peruntukan_persil ") or die ($db->error);
                while($data_peruntukan_persil = mysqli_fetch_array($sql_peruntukan_persil)) {
                  echo '<div class="form-check">';
                  echo '<label class="form-check-label">';
                  echo '<input type="radio" class="form-check-input" name="peruntukan_persil" id="peruntukan_persil" value="'.$data_peruntukan_persil['id_peruntukan_persil'].'" >';
                  echo $data_peruntukan_persil['peruntukan_persil'];
                  echo '</label>';
                  echo '</div>';
                } 
                ?>
              </div>
              <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea class="form-control" name="keterangan" rows="3" placeholder="Ex : Kosong" required></textarea>
              </div>
              <div class="form-group">
                <label for="foto">Foto Gambar Usaha <small>(Max 4 Foto)</small></label>
                <div class="row mt-2">
                  <div class="col-md-12">
                    <input type="file" name="foto[]" class="form-control" multiple required>
                  </div>
                </div>
                  <!-- <div class="row mt-3">
                    <div class="col-3">
                      <a href="images/dashboard/img_1.jpg" class="image-tile" target="_blank">
                        <img src="images/pelanggan/<?= $data['foto_1']; ?>" class="mb-2 mw-100 w-100 rounded" alt="image">
                      </a>
                    </div>
                    <div class="col-3">
                      <a href="images/dashboard/img_2.jpg" class="image-tile" target="_blank">
                        <img src="images/pelanggan/<?= $data['foto_2']; ?>" class="mb-2 mw-100 w-100 rounded" alt="image">
                      </a>
                    </div>
                    <div class="col-3">
                      <a href="images/dashboard/img_3.jpg" class="image-tile" target="_blank">
                        <img src="images/pelanggan/<?= $data['foto_3']; ?>" class="mb-2 mw-100 w-100 rounded" alt="image">
                      </a>
                    </div>
                    <div class="col-3">
                      <a href="images/dashboard/img_4.jpg" class="image-tile" target="_blank">
                        <img src="images/pelanggan/<?= $data['foto_4']; ?>" class="mb-2 mw-100 w-100 rounded" alt="image">
                      </a>
                    </div>
                  </div> -->
                </div>
                <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                <button type="reset" class="btn btn-gradient-success mr-2">Reset</button>
                <a href="?page=data_pelanggan" class="btn btn-gradient-danger">Cancel</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php elseif (@$_GET['action'] == 'proses_tambah'): ?>
      <?php  
      $nik = $data_terlogin['nik'];
      $id_pel = @mysqli_real_escape_string($db, $_POST['id_pel']);
      $nama = @mysqli_real_escape_string($db, $_POST['nama']);
      $no_telp = @mysqli_real_escape_string($db, $_POST['no_telp']);
      $alamat_pel = @mysqli_real_escape_string($db, $_POST['alamat_pel']);
      $tarif = @mysqli_real_escape_string($db, $_POST['tarif']);
      $peruntukan_persil = @mysqli_real_escape_string($db, $_POST['peruntukan_persil']);
      $keterangan = @mysqli_real_escape_string($db, $_POST['keterangan']);
      // INPUT DATA TESTING
      mysqli_query($db, "INSERT INTO data_testing VALUES ('', '$id_pel', '0', '0', '$tarif', '$peruntukan_persil' ) ") or die ($db->error);

      $jumlah = count($_FILES['foto']['name']);
      if ($jumlah <= 4) {
        $foto = array();
        for ($i=0; $i < $jumlah; $i++) { 
          $temp = explode(".", $_FILES['foto']['name'][$i]);
          $new_file_name = $id_pel . ' - Gambar Usaha' . $i . '.'. end($temp);
          $format = pathinfo($new_file_name, PATHINFO_EXTENSION);
          $tmp_name = $_FILES['foto']['tmp_name'][$i];        
          move_uploaded_file($tmp_name, "images/pelanggan/".$new_file_name);
          $foto[$i] = $new_file_name;                 
        }

        if($jumlah == 1) {
          if( ($format == "jpg") or ($format == "png") or ($format == "jpeg") ){
            mysqli_query($db, "INSERT INTO pelanggan VALUES ('', '$nik', '$id_pel', '$nama', '$no_telp', '$alamat_pel', '$tarif', now(), '$peruntukan_persil', '$keterangan', '$foto[0]', 'default.jpg', 'default.jpg', 'default.jpg', '1' ) ") or die ($db->error);
            echo "<script>window.location='?page=data_pelanggan_detail&id_pel=$id_pel'</script>"; 
          }else{
            echo '<div class="alert alert-danger">Ekstensi File Tidak Diperbolehkan!</div>';
          }
        } elseif($jumlah == 2) {
          if( ($format == "jpg") or ($format == "png") or ($format == "jpeg") ){
            mysqli_query($db, "INSERT INTO pelanggan VALUES ('', '$nik', '$id_pel', '$nama', '$no_telp', '$alamat_pel', '$tarif', now(), '$peruntukan_persil', '$keterangan', '$foto[0]', '$foto[1]', 'default.jpg', 'default.jpg', '1' ) ") or die ($db->error);
            echo "<script>window.location='?page=data_pelanggan_detail&id_pel=$id_pel'</script>"; 
          }else{
            echo '<div class="alert alert-danger">Ekstensi File Tidak Diperbolehkan!</div>';
          }
        } elseif($jumlah == 3) {
          if( ($format == "jpg") or ($format == "png") or ($format == "jpeg") ){
            mysqli_query($db, "INSERT INTO pelanggan VALUES ('', '$nik', '$id_pel', '$nama', '$no_telp', '$alamat_pel', '$tarif', now(), '$peruntukan_persil', '$keterangan', '$foto[0]', '$foto[1]', '$foto[2]', 'default.jpg', '1' ) ") or die ($db->error);
            echo "<script>window.location='?page=data_pelanggan_detail&id_pel=$id_pel'</script>"; 
          }else{
            echo '<div class="alert alert-danger">Ekstensi File Tidak Diperbolehkan!</div>';
          }
        } elseif($jumlah == 4) {
          if( ($format == "jpg") or ($format == "png") or ($format == "jpeg") ){
            mysqli_query($db, "INSERT INTO pelanggan VALUES ('', '$nik', '$id_pel', '$nama', '$no_telp', '$alamat_pel', '$tarif', now(), '$peruntukan_persil', '$keterangan', '$foto[0]', '$foto[1]', '$foto[2]', '$foto[3]', '1' ) ") or die ($db->error);
            echo "<script>window.location='?page=data_pelanggan_detail&id_pel=$id_pel'</script>"; 
          }else{
            echo '<div class="alert alert-danger">Ekstensi File Tidak Diperbolehkan!</div>';
          }
        } else {
          mysqli_query($db, "INSERT INTO pelanggan VALUES ('', '$nik', '$id_pel', '$nama', '$no_telp', '$alamat_pel', '$tarif', now(), '$peruntukan_persil', '$keterangan', 'default.jpg', 'default.jpg', 'default.jpg', 'default.jpg', '1' ) ") or die ($db->error);
          echo "<script>window.location='?page=data_pelanggan_detail&id_pel=$id_pel'</script>";
        }

      }
      else{
        echo '<div class="alert alert-danger">Gambar terlalu banyak Max hanya 4 Gambar untuk di upload!</div>';
      }
      ?>
      <?php elseif (@$_GET['action'] == 'edit_pelanggan'): ?>
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Edit Data Pelanggan
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">Edit</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Pelanggan</li>
              </ol>
            </nav>
          </div>
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample" method="post" action="?page=data_pelanggan_manajemen&action=proses_edit_pelanggan&id=<?= $data['id']; ?>" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="id_pel">ID Pelanggan</label>
                      <input type="text" class="form-control" name="id_pel" value="<?= $data['id_pel']; ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="nama">Nama Pelanggan</label>
                      <input type="text" class="form-control" name="nama" value="<?= $data['nama']; ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="no_telp">No Telp</label>
                      <input type="text" class="form-control" name="no_telp" value="<?= $data['no_telp_pel']; ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="alamat_pel">Alamat</label>
                      <textarea class="form-control" name="alamat_pel" rows="4" required><?= $data['alamat_pel']; ?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="tarif">Tarif / Daya</label>
                      <select name="tarif" class="form-control">
                        <?php
                        $sql2 = tampil_per_id("data_daya_tarif", "id_daya_tarif = '$data[id_daya_tarif]'");
                        $data2 = mysqli_fetch_array($sql2);
                        if(mysqli_num_rows($sql2) > 0) { 
                          echo '<option value="'.$data2['id_daya_tarif'].'">'.$data2['daya_tarif'].'</option>';
                          echo '<option value="">-- Pilih Daya / Tarif --</option>';
                        } else {
                          echo '<option value="">-- Pilih Daya / Tarif --</option>';
                        }
                        $sql_daya = mysqli_query($db, "SELECT * FROM data_daya_tarif ") or die ($db->error);
                        while($data_daya = mysqli_fetch_array($sql_daya)) {
                          echo '<option value="'.$data_daya['id_daya_tarif'].'">'.$data_daya['daya_tarif'].'</option>';
                        } ?>
                      </select>   
                    </div>
                    <div class="form-group">
                      <label for="foto">Peruntukan Persil</label>
                      <?php
                      $sql_peruntukan_persill = mysqli_query($db, "SELECT data_peruntukan_persil.id_peruntukan_persil AS id_peruntukan_persil, data_peruntukan_persil.peruntukan_persil AS peruntukan_persil, pelanggan.id_peruntukan_persil AS id_peruntukan_persill FROM data_peruntukan_persil JOIN pelanggan ON pelanggan.id_peruntukan_persil = data_peruntukan_persil.id_peruntukan_persil ") or die ($db->error);
                      $data_peruntukan_persill = mysqli_fetch_array($sql_peruntukan_persill);

                      $sql_peruntukan_persil = mysqli_query($db, "SELECT * FROM data_peruntukan_persil ") or die ($db->error);
                      while($data_peruntukan_persil = mysqli_fetch_array($sql_peruntukan_persil)) { ?>
                        <div class="form-check">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="peruntukan_persil" id="peruntukan_persil" value="<?= $data_peruntukan_persil['id_peruntukan_persil'] ?>" 
                            <?php if ($data_peruntukan_persill['id_peruntukan_persill'] == $data_peruntukan_persil['id_peruntukan_persil']) {
                              echo "checked";
                            } ?> 
                            >
                            <?= $data_peruntukan_persil['peruntukan_persil']; ?>
                          </label>
                        </div>
                        <?php
                      } 
                      ?>

                    </div>
                    <div class="form-group">
                      <label for="keterangan">Keterangan</label>
                      <textarea class="form-control" name="keterangan" rows="3" required><?= $data['keterangan']; ?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="foto">Foto Gambar Usaha <small>(Max 4 Foto)</small></label>
                      <div class="row mt-2">
                        <div class="col-md-12">
                          <input type="file" name="foto[]" class="form-control" multiple required>
                        </div>
                      </div>
                      <div class="row mt-3">
                        <div class="col-3">
                          <a href="images/dashboard/img_1.jpg" class="image-tile" target="_blank">
                            <img src="images/pelanggan/<?= $data['foto_1']; ?>" class="mb-2 mw-100 w-100 rounded" alt="image">
                          </a>
                        </div>
                        <div class="col-3">
                          <a href="images/dashboard/img_2.jpg" class="image-tile" target="_blank">
                            <img src="images/pelanggan/<?= $data['foto_2']; ?>" class="mb-2 mw-100 w-100 rounded" alt="image">
                          </a>
                        </div>
                        <div class="col-3">
                          <a href="images/dashboard/img_3.jpg" class="image-tile" target="_blank">
                            <img src="images/pelanggan/<?= $data['foto_3']; ?>" class="mb-2 mw-100 w-100 rounded" alt="image">
                          </a>
                        </div>
                        <div class="col-3">
                          <a href="images/dashboard/img_4.jpg" class="image-tile" target="_blank">
                            <img src="images/pelanggan/<?= $data['foto_4']; ?>" class="mb-2 mw-100 w-100 rounded" alt="image">
                          </a>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                    <button type="reset" class="btn btn-gradient-success mr-2">Reset</button>
                    <a href="?page=data_pelanggan_detail&id_pel=<?= $data['id_pel']; ?>" class="btn btn-gradient-danger">Cancel</a>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php elseif (@$_GET['action'] == 'proses_edit_pelanggan'): ?>
          <?php  
          $id_pel = @mysqli_real_escape_string($db, $_POST['id_pel']);
          $nama = @mysqli_real_escape_string($db, $_POST['nama']);
          $no_telp = @mysqli_real_escape_string($db, $_POST['no_telp']);
          $alamat_pel = @mysqli_real_escape_string($db, $_POST['alamat_pel']);
          $tarif = @mysqli_real_escape_string($db, $_POST['tarif']);
          $peruntukan_persil = @mysqli_real_escape_string($db, $_POST['peruntukan_persil']);
          $keterangan = @mysqli_real_escape_string($db, $_POST['keterangan']);

          $jumlah = count($_FILES['foto']['name']);
          if ($jumlah <= 4) {
            $foto = array();
            for ($i=0; $i < $jumlah; $i++) { 
              $temp = explode(".", $_FILES['foto']['name'][$i]);
              $new_file_name = $id_pel . ' - Gambar Usaha' . $i . '.'. end($temp);
              $format = pathinfo($new_file_name, PATHINFO_EXTENSION);
              $tmp_name = $_FILES['foto']['tmp_name'][$i];        
              move_uploaded_file($tmp_name, "images/pelanggan/".$new_file_name);
              $foto[$i] = $new_file_name;                 
            }
            if ($jumlah == 1) {
              if( ($format == "jpg") or ($format == "png") or ($format == "jpeg") ){
                mysqli_query($db, "UPDATE pelanggan SET id_pel = '$id_pel', nama = '$nama', no_telp_pel = '$no_telp', alamat_pel = '$alamat_pel', id_daya_tarif = '$tarif', id_peruntukan_persil = '$peruntukan_persil', keterangan = '$keterangan', foto_1 = '$foto[0]', foto_2 = 'default.jpg', foto_3 = 'default.jpg', foto_4 = 'default.jpg' WHERE id = '$id' ") or die ($db->error);
                echo "<script>window.location='?page=data_pelanggan_detail&id_pel=$id_pel'</script>"; 
              }else{
                echo '<div class="alert alert-danger">Ekstensi File Tidak Diperbolehkan!</div>';
              }    
            } elseif ($jumlah == 2) {
              if( ($format == "jpg") or ($format == "png") or ($format == "jpeg") ){
                mysqli_query($db, "UPDATE pelanggan SET id_pel = '$id_pel', nama = '$nama', no_telp_pel = '$no_telp', alamat_pel = '$alamat_pel', id_daya_tarif = '$tarif', id_peruntukan_persil = '$peruntukan_persil', keterangan = '$keterangan', foto_1 = '$foto[0]', foto_2 = '$foto[1]', foto_3 = 'default.jpg', foto_4 = 'default.jpg' WHERE id = '$id' ") or die ($db->error);
                echo "<script>window.location='?page=data_pelanggan_detail&id_pel=$id_pel'</script>"; 
              }else{
                echo '<div class="alert alert-danger">Ekstensi File Tidak Diperbolehkan!</div>';
              }
            } elseif ($jumlah == 3) {
              if( ($format == "jpg") or ($format == "png") or ($format == "jpeg") ){
                mysqli_query($db, "UPDATE pelanggan SET id_pel = '$id_pel', nama = '$nama', no_telp_pel = '$no_telp', alamat_pel = '$alamat_pel', id_daya_tarif = '$tarif', id_peruntukan_persil = '$peruntukan_persil', keterangan = '$keterangan', foto_1 = '$foto[0]', foto_2 = '$foto[1]', foto_3 = '$foto[2]', foto_4 = 'default.jpg' WHERE id = '$id' ") or die ($db->error);
                echo "<script>window.location='?page=data_pelanggan_detail&id_pel=$id_pel'</script>"; 
              }else{
                echo '<div class="alert alert-danger">Ekstensi File Tidak Diperbolehkan!</div>';
              }
            } else {
              if( ($format == "jpg") or ($format == "png") or ($format == "jpeg") ){
                mysqli_query($db, "UPDATE pelanggan SET id_pel = '$id_pel', nama = '$nama', no_telp_pel = '$no_telp', alamat_pel = '$alamat_pel', id_daya_tarif = '$tarif', id_peruntukan_persil = '$peruntukan_persil', keterangan = '$keterangan', foto_1 = '$foto[0]', foto_2 = '$foto[1]', foto_3 = '$foto[2]', foto_4 = '$foto[3]' WHERE id = '$id' ") or die ($db->error);
                echo "<script>window.location='?page=data_pelanggan_detail&id_pel=$id_pel'</script>"; 
              }else{
                echo '<div class="alert alert-danger">Ekstensi File Tidak Diperbolehkan!</div>';
              }
            }
          }
          else{
            echo '<div class="alert alert-danger">Gambar terlalu banyak Max hanya 4 Gambar untuk di upload!</div>';
          }

          ?>
          <?php elseif (@$_GET['action'] == 'hapus_pelanggan'): ?>
            <?php  
            $queryunlink = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM pelanggan WHERE id_pel = '$id_pel' "));
            $fileName1 = $queryunlink["foto_1"];
            $fileName2 = $queryunlink["foto_2"];
            $fileName3 = $queryunlink["foto_3"];
            $fileName4 = $queryunlink["foto_4"];
            if ($fileName1 != 'default.jpg' && $fileName2 != 'default.jpg' && $fileName3 != 'default.jpg' && $fileName4 != 'default.jpg') {
              unlink('images/pelanggan/'.$fileName1);
              unlink('images/pelanggan/'.$fileName2);
              unlink('images/pelanggan/'.$fileName3);
              unlink('images/pelanggan/'.$fileName4);
            } elseif ($fileName1 != 'default.jpg' && $fileName2 != 'default.jpg' && $fileName3 != 'default.jpg') {
              unlink('images/pelanggan/'.$fileName1);
              unlink('images/pelanggan/'.$fileName2);
              unlink('images/pelanggan/'.$fileName3);
            } elseif ($fileName1 != 'default.jpg' && $fileName2 != 'default.jpg' ) {
              unlink('images/pelanggan/'.$fileName1);
              unlink('images/pelanggan/'.$fileName2);
            } elseif ($fileName1 != 'default.jpg') {
              unlink('images/pelanggan/'.$fileName1);
            } else {

            }

            mysqli_query($db, "DELETE FROM pelanggan WHERE id_pel = '$id_pel'") or die ($db->error);
            mysqli_query($db, "DELETE FROM data_testing WHERE id_pel = '$id_pel'") or die ($db->error);

            $sql = mysqli_query($db, "SELECT * FROM alat_pelanggan WHERE id_pel = '$id_pel' ");
            if (mysqli_num_rows($sql) > 0) {
              $queryunlink1 = mysqli_fetch_array($sql);
              $fileName5 = $queryunlink1["foto"];
              if ($fileName5 != 'default.jpg') {
                unlink('images/alat_pelanggan/'.$fileName5);
              } else {
                
              }
              
              mysqli_query($db, "DELETE FROM alat_pelanggan WHERE id_pel = '$id_pel'") or die ($db->error);
            }
            echo '<script>alert("Data Berhasil Dihapus !"); window.location="?page=data_pelanggan";</script>';
            ?>
            <?php endif; ?>