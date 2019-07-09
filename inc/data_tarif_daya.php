<?php
$id_ddt = @$_GET['id_ddt'];

$sql_per_id = mysqli_query($db, "SELECT * FROM data_daya_tarif WHERE id_ddt = '$id_ddt'") or die ($db->error);
$data = mysqli_fetch_array($sql_per_id);

$sql_daya_tarif = mysqli_query($db, "SELECT * FROM data_daya_tarif ") or die ($db->error);
$no = 1;
?>
<?php if (@$_GET['action'] == ''): ?>
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
        Manajemen Daya / Tarif
      </h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Table</li>
          <li class="breadcrumb-item active" aria-current="page">Daya Tarif</li>
        </ol>
      </nav>
    </div>

    <div class="row">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <a href="?page=data_tarif_daya&action=tambah_tarif_daya" class="btn btn-outline-primary btn-icon-text btn-sm">
              <i class="mdi mdi mdi-book-plus btn-icon-prepend"></i>
              Tambah Data
            </a>
            <!-- <button class="btn btn-outline-primary btn-icon-text btn-sm">
              <i class="mdi mdi-printer btn-icon-prepend"></i>
              Cetak Data
            </button>  -->
            <hr>
            <div class="table-responsive ">
              <table class="table" id="myTable">
                <thead>
                  <tr>
                    <th>Kelas</th>
                    <th>Daya / Tarif</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while($data_daya_tarif = mysqli_fetch_array($sql_daya_tarif)) { ?>
                    <tr>
                      <td><?= $data_daya_tarif['id_daya_tarif']; ?></td>
                      <td><?= $data_daya_tarif['daya_tarif']; ?></td>
                      <td align="center">
                        <a href="?page=data_tarif_daya&action=edit_tarif_daya&id_ddt=<?= $data_daya_tarif['id_ddt']; ?>" class="badge badge-gradient-success" style="text-decoration: none;">Edit</a>
                        <a href="?page=data_tarif_daya&action=hapus_tarif_daya&id_ddt=<?php echo $data_daya_tarif['id_ddt']; ?>" class="badge badge-gradient-danger tombol-hapus" style="text-decoration: none;">Hapus</a>
                        <!-- <a onclick="return confirm('Yakin akan menghapus data?');" href="?page=user_admin&action=hapus_admin&id_ddt=<?php echo $data_admin['id_ddt']; ?>" class="badge badge-gradient-danger" style="text-decoration: none;">Hapus</a> -->
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
<?php elseif (@$_GET['action'] == 'tambah_tarif_daya'): ?>
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title">
          Tambah Daya / Tarif
        </h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">Tambah</a></li>
            <li class="breadcrumb-item active" aria-current="page">Daya Tarif</li>
          </ol>
        </nav>
      </div>
      <div class="row">
        <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <form class="forms-sample" method="post" action="?page=data_tarif_daya&action=proses_tambah" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="id_daya_tarif">Kelas</label>
                  <input type="text" class="form-control" name="id_daya_tarif" placeholder="Ex : 1" required>
                </div>
                <div class="form-group">
                  <label for="daya_tarif">Daya / Tarif</label>
                  <input type="text" class="form-control" name="daya_tarif" placeholder="Ex : B-1/450 VA " required>
                </div>
                <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                <button type="reset" class="btn btn-gradient-success mr-2">Reset</button>
                <a href="?page=data_tarif_daya" class="btn btn-gradient-danger">Cancel</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php elseif (@$_GET['action'] == 'proses_tambah'): ?>
      <?php  
      $id_daya_tarif = @mysqli_real_escape_string($db, $_POST['id_daya_tarif']);
      $daya_tarif = @mysqli_real_escape_string($db, $_POST['daya_tarif']);
      $sql_cek_id = mysqli_query($db, "SELECT * FROM data_daya_tarif WHERE id_daya_tarif = '$id_daya_tarif'") or die ($db->error);
      if (mysqli_num_rows($sql_cek_id) > 0) {
      echo "<script>alert('ID Sudah Tersedia Coba Gunakaan ID Lain')</script>";
      echo "<script>window.location='?page=data_tarif_daya&action=tambah_tarif_daya';</script>";
      } else {
      mysqli_query($db, "INSERT INTO data_daya_tarif VALUES('', '$id_daya_tarif', '$daya_tarif')")
                    or die ($db->error);
      echo "<script>window.location='?page=data_tarif_daya';</script>";
      }
      ?>
<?php elseif (@$_GET['action'] == 'edit_tarif_daya'): ?>
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Edit Daya Tarif
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">Edit</a></li>
                <li class="breadcrumb-item active" aria-current="page">Daya Tarif</li>
              </ol>
            </nav>
          </div>
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample" method="post" action="?page=data_tarif_daya&action=proses_edit&id_ddt=<?= $id_ddt; ?>" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="id_daya_tarif">Kelas</label>
                      <input type="text" class="form-control" name="id_daya_tarif" value="<?= $data['id_daya_tarif']; ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label for="daya_tarif">Daya / Tarif</label>
                      <input type="text" class="form-control" name="daya_tarif" value="<?= $data['daya_tarif']; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                    <button type="reset" class="btn btn-gradient-success mr-2">Reset</button>
                    <a href="?page=data_tarif_daya" class="btn btn-gradient-danger">Cancel</a>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
<?php elseif (@$_GET['action'] == 'proses_edit'): ?>
          <?php 
          $id_daya_tarif = @mysqli_real_escape_string($db, $_POST['id_daya_tarif']);
          $daya_tarif = @mysqli_real_escape_string($db, $_POST['daya_tarif']);
          mysqli_query($db, "UPDATE data_daya_tarif SET daya_tarif = '$daya_tarif' WHERE id_ddt = '$id_ddt' ") or die ($db->error);
          echo "<script>window.location='?page=data_tarif_daya';</script>";

          ?>
<?php elseif (@$_GET['action'] == 'hapus_tarif_daya'): ?>
  <?php  
  mysqli_query($db, "DELETE FROM data_daya_tarif WHERE id_ddt = '$id_ddt'") or die ($db->error);
  
  echo '<script>window.location="?page=data_tarif_daya";</script>';
  ?>
<?php endif; ?>