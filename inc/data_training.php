<?php
$id_dt = @$_GET['id_dt'];

$sql_per_id = mysqli_query($db, "SELECT * FROM data_training WHERE id_dt = '$id_dt'") or die ($db->error);
$data = mysqli_fetch_array($sql_per_id);

$sql_data_training = mysqli_query($db, "SELECT * FROM data_training JOIN data_daya_tarif ON data_training.id_daya_tarif = data_daya_tarif.id_daya_tarif JOIN data_peruntukan_persil ON data_training.id_peruntukan_persil = data_peruntukan_persil.id_peruntukan_persil ORDER BY id_dt ") or die ($db->error);
$no = 1;
?>
<?php if (@$_GET['action'] == ''): ?>
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
        Manajemen Data Training
      </h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Table</li>
          <li class="breadcrumb-item active" aria-current="page">Data Training</li>
        </ol>
      </nav>
    </div>

    <div class="row">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <a href="?page=data_training&action=tambah_data_training" class="btn btn-outline-primary btn-icon-text btn-sm">
              <i class="mdi mdi-note-plus btn-icon-prepend"></i>
              Tambah Data
            </a>
            <!-- <button class="btn btn-outline-primary btn-icon-text btn-sm" data-toggle="modal" data-target="#import">
              <i class="mdi mdi mdi-file-excel btn-icon-prepend"></i>
              Import CSV
            </button> 
            <button class="btn btn-outline-primary btn-icon-text btn-sm">
              <i class="mdi mdi-file-import btn-icon-prepend"></i>
              Download Format Excel
            </button> -->

            <hr>
            <div class="table-responsive ">
              <table class="table" id="myTable">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>KWH <small>(Rumah Tangga)</small></th>
                    <th>KWH <small>(Bisnis)</small></th>
                    <th>Daya / Tarif</th>
                    <th>Peruntukan Persil</th>
                    <th>Hasil</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while($data_data_training = mysqli_fetch_array($sql_data_training)) { ?>
                    <tr>
                      <td align="center"><?= $no++; ?>  </td>
                      <td align="center"><?= $data_data_training['kwh_rt']; ?></td>
                      <td align="center"><?= $data_data_training['kwh_bisnis']; ?></td>
                      <td align="center"><?= $data_data_training['id_daya_tarif']; ?> ( <?= $data_data_training['daya_tarif']; ?> )</td>
                      <td align="center"><?= $data_data_training['id_peruntukan_persil']; ?> ( <?= $data_data_training['peruntukan_persil']; ?> )</td>
                      <td align="center"><?= $data_data_training['hasil']; ?></td>
                      <td align="center">
                        <a href="?page=data_training&action=edit_data_training&id_dt=<?= $data_data_training['id_dt']; ?>" class="badge badge-gradient-success" style="text-decoration: none;">Edit</a>
                        <a href="?page=data_training&action=hapus_data_training&id_dt=<?php echo $data_data_training['id_dt']; ?>" class="badge badge-gradient-danger tombol-hapus" style="text-decoration: none;">Hapus</a>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php elseif (@$_GET['action'] == 'tambah_data_training'): ?>
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title">
          Tambah Data Training
        </h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">Tambah</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Training</li>
          </ol>
        </nav>
      </div>
      <div class="row">
        <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <form class="forms-sample" method="post" action="?page=data_training&action=proses_tambah" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="kwh_rt">KWH Perhari <small>(Rumah Tangga)</small></label>
                  <input type="text" class="form-control" name="kwh_rt" placeholder="Ex : 0,10" required>
                </div>
                <div class="form-group">
                  <label for="kwh_bisnis">KWH Perhari <small>(Bisnis)</small></label>
                  <input type="text" class="form-control" name="kwh_bisnis" placeholder="Ex : 2,10" required>
                </div>
                <div class="form-group">
                  <label for="id_daya_tarif">Tarif / Daya</label>
                  <select name="id_daya_tarif" class="form-control">
                    <option value="#">-- Pilih Tarif / Daya --</option>
                    <?php
                    $sql_daya = mysqli_query($db, "SELECT * FROM data_daya_tarif ") or die ($db->error);
                    while($data_daya = mysqli_fetch_array($sql_daya)) {
                      echo '<option value="'.$data_daya['id_daya_tarif'].'">( '.$data_daya['id_daya_tarif'].' ) ' .$data_daya['daya_tarif']. '</option>';
                    } ?>
                  </select>  
                </div>
                <div class="form-group">
                  <label for="peruntukan_persil">Peruntukan Persil</label>
                  <select name="peruntukan_persil" class="form-control">
                    <option value="#">-- Pilih Peruntukan Persil --</option>
                    <?php
                    $sql_peruntukan_persil = mysqli_query($db, "SELECT * FROM data_peruntukan_persil ") or die ($db->error);
                    while($data_peruntukan_persil = mysqli_fetch_array($sql_peruntukan_persil)) {
                      echo '<option value="'.$data_peruntukan_persil['id_peruntukan_persil'].'">( '.$data_peruntukan_persil['id_peruntukan_persil'].' ) '.$data_peruntukan_persil['peruntukan_persil'].'</option>';
                    } ?>
                  </select>  
                </div>
                <div class="form-group">
                  <label for="hasil">Hasil</label>
                  <select class="form-control" name="hasil">
                    <option value="">-- Pilih Hasil --</option>
                    <option value="Sesuai">Sesuai</option>
                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                  </select>
                </div>
                
                <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                <button type="reset" class="btn btn-gradient-success mr-2">Reset</button>
                <a href="?page=data_training" class="btn btn-gradient-danger">Cancel</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php elseif (@$_GET['action'] == 'proses_tambah'): ?>
      <?php  
      $kwh_rt = @mysqli_real_escape_string($db, $_POST['kwh_rt']);
      $kwh_bisnis = @mysqli_real_escape_string($db, $_POST['kwh_bisnis']);
      $id_daya_tarif = @mysqli_real_escape_string($db, $_POST['id_daya_tarif']);
      $peruntukan_persil = @mysqli_real_escape_string($db, $_POST['peruntukan_persil']);
      $hasil = @mysqli_real_escape_string($db, $_POST['hasil']);
      // $dt = mysqli_query($db, "SELECT id_dt FROM data_training ORDER BY id_dt DESC LIMIT 1");
      // $iddt = mysqli_fetch_object($dt);
      // $id_dt = $iddt + 1;
      // var_dump($dt);
      mysqli_query($db, "INSERT INTO data_training VALUES('', '$kwh_rt', '$kwh_bisnis',
        '$id_daya_tarif', '$peruntukan_persil', '$hasil')")
      or die ($db->error);
      echo "<script>alert('Data berhasil ditambahkan !'); window.location='?page=data_training';</script>";
      ?>
      <?php elseif (@$_GET['action'] == 'edit_data_training'): ?>
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Edit Data Training
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">Edit</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Training</li>
              </ol>
            </nav>
          </div>
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample" method="post" action="?page=data_training&action=proses_edit&id_dt=<?= $id_dt; ?>" enctype="multipart/form-data">

                    <div class="form-group">
                      <label for="kwh_rt">KWH Perhari <small>(Rumah Tangga)</small></label>
                      <input type="text" class="form-control" name="kwh_rt" value="<?= $data['kwh_rt']; ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="kwh_bisnis">KWH Perhari <small>(Bisnis)</small></label>
                      <input type="text" class="form-control" name="kwh_bisnis" value="<?= $data['kwh_bisnis']; ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="id_daya_tarif">Daya / Tarif</label>
                      <select class="form-control" name="id_daya_tarif">
                        <?php
                        $sql2 = tampil_per_id("data_training", "id_daya_tarif = '$data[id_daya_tarif]'");
                        $data2 = mysqli_fetch_array($sql2);
                        if(mysqli_num_rows($sql2) > 0) { 
                          echo '<option value="'.$data2['id_daya_tarif'].'">( '.$data2['id_daya_tarif'].' )</option>';
                          echo '<option value="">-- Pilih Daya / Tarif --</option>';
                        } else {
                          echo '<option value="">-- Pilih Daya / Tarif --</option>';
                        }
                        $sql_daya_tarif = mysqli_query($db, "SELECT * FROM data_daya_tarif") or die ($db->error);
                        while($data_daya_tarif = mysqli_fetch_array($sql_daya_tarif)) {
                          echo '<option value="'.$data_daya_tarif['id_daya_tarif'].'">( '.$data_daya_tarif['id_daya_tarif']. ' ) ' .$data_daya_tarif['daya_tarif'].'</option>';
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="peruntukan_persil">Peruntukan Persil</label>
                      <select class="form-control" name="peruntukan_persil">
                        <?php
                        $sql2 = tampil_per_id("data_training", "id_peruntukan_persil = '$data[id_peruntukan_persil]'");
                        $data2 = mysqli_fetch_array($sql2);
                        if(mysqli_num_rows($sql2) > 0) { 
                          echo '<option value="'.$data2['id_peruntukan_persil'].'">( '.$data2['id_peruntukan_persil'].' )</option>';
                          echo '<option value="">-- Pilih Daya / Tarif --</option>';
                        } else {
                          echo '<option value="">-- Pilih Daya / Tarif --</option>';
                        }
                        $sql_peruntukan_persil = mysqli_query($db, "SELECT * FROM data_peruntukan_persil") or die ($db->error);
                        while($data_peruntukan_persil = mysqli_fetch_array($sql_peruntukan_persil)) {
                          echo '<option value="'.$data_peruntukan_persil['id_peruntukan_persil'].'">( '.$data_peruntukan_persil['id_peruntukan_persil']. ' ) ' .$data_peruntukan_persil['peruntukan_persil'].'</option>';
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="hasil">Hasil</label>
                      <select class="form-control" name="hasil">
                        <?php
                        $sql3 = tampil_per_id("data_training", "hasil = '$data[hasil]'");
                        $data3 = mysqli_fetch_array($sql3);
                        if(mysqli_num_rows($sql3) > 0) { 
                          echo '<option value="'.$data3['hasil'].'">'.$data3['hasil'].'</option>';
                          echo '<option value="">-- Pilih Hasil --</option>';
                        } else {
                          echo '<option value="">-- Pilih Hasil --</option>';
                        }
                        echo '<option value="Sesuai">Sesuai</option>';
                        echo '<option value="Tidak Sesuai">Tidak Sesuai</option>';
                        ?>
                      </select>
                    </div>
                    <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                    <button type="reset" class="btn btn-gradient-success mr-2">Reset</button>
                    <a href="?page=data_training" class="btn btn-gradient-danger">Cancel</a>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php elseif (@$_GET['action'] == 'proses_edit'): ?>
          <?php
          $kwh_rt = @mysqli_real_escape_string($db, $_POST['kwh_rt']);
          $kwh_bisnis = @mysqli_real_escape_string($db, $_POST['kwh_bisnis']);
          $id_daya_tarif = @mysqli_real_escape_string($db, $_POST['id_daya_tarif']);
          $peruntukan_persil = @mysqli_real_escape_string($db, $_POST['peruntukan_persil']);
          $hasil = @mysqli_real_escape_string($db, $_POST['hasil']);
          mysqli_query($db, "UPDATE data_training SET kwh_rt = '$kwh_rt', kwh_bisnis = '$kwh_bisnis', id_daya_tarif = '$id_daya_tarif', id_peruntukan_persil = '$peruntukan_persil', hasil = '$hasil' WHERE id_dt = '$id_dt' ")
          or die ($db->error);
          echo "<script>alert('Data berhasil diedit !'); window.location='?page=data_training';</script>";  
          ?>
          <?php elseif (@$_GET['action'] == 'hapus_data_training'): ?>
            <?php  
            mysqli_query($db, "DELETE FROM data_training WHERE id_dt = '$id_dt' ") or die ($db->error);

            echo '<script>alert("Data berhasil dihapus !"); window.location="?page=data_training";</script>';
            ?>
          <?php endif; ?>

          <!-- Modal -->
          <!-- <div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Import CSV</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="proses_upload_csv.php" method="post" enctype="multipart/form-data">
                  <div class="modal-body">
                    <input type="file" class="form-control" name="file" id="file" accept=".csv">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="submit" name="import" class="btn btn-primary">Import</button>
                  </div>
                </form>
              </div>
            </div>
          </div> -->
          