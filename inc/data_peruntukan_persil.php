<?php
$id_pp = @$_GET['id_pp'];

$sql_per_id = mysqli_query($db, "SELECT * FROM data_peruntukan_persil WHERE id_pp = '$id_pp'") or die ($db->error);
$data = mysqli_fetch_array($sql_per_id);

$sql_peruntukan_persil = mysqli_query($db, "SELECT * FROM data_peruntukan_persil ") or die ($db->error);
$no = 1;
?>
<?php if (@$_GET['action'] == ''): ?>
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
        Manajemen Peruntukan Persil
      </h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Table</li>
          <li class="breadcrumb-item active" aria-current="page">Peruntukan Persil</li>
        </ol>
      </nav>
    </div>

    <div class="row">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <a href="?page=data_peruntukan_persil&action=tambah_peruntukan_persil" class="btn btn-outline-primary btn-icon-text btn-sm">
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
                    <th>Peruntukan Persil</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while($data_peruntukan_persil = mysqli_fetch_array($sql_peruntukan_persil)) { ?>
                    <tr>
                      <td><?= $data_peruntukan_persil['id_peruntukan_persil']; ?></td>
                      <td><?= $data_peruntukan_persil['peruntukan_persil']; ?></td>
                      <td align="center">
                        <a href="?page=data_peruntukan_persil&action=edit_peruntukan_persil&id_pp=<?= $data_peruntukan_persil['id_pp']; ?>" class="badge badge-gradient-success" style="text-decoration: none;">Edit</a>
                        <a href="?page=data_peruntukan_persil&action=hapus_peruntukan_persil&id_pp=<?php echo $data_peruntukan_persil['id_pp']; ?>" class="badge badge-gradient-danger tombol-hapus" style="text-decoration: none;">Hapus</a>
                        <!-- <a onclick="return confirm('Yakin akan menghapus data?');" href="?page=user_admin&action=hapus_admin&id_pp=<?php echo $data_admin['id_pp']; ?>" class="badge badge-gradient-danger" style="text-decoration: none;">Hapus</a> -->
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
<?php elseif (@$_GET['action'] == 'tambah_peruntukan_persil'): ?>
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title">
          Tambah Peruntukan Persil
        </h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">Tambah</a></li>
            <li class="breadcrumb-item active" aria-current="page">Peruntukan Persil</li>
          </ol>
        </nav>
      </div>
      <div class="row">
        <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <form class="forms-sample" method="post" action="?page=data_peruntukan_persil&action=proses_tambah" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="id_peruntukan_persil">Kelas</label>
                  <input type="text" class="form-control" name="id_peruntukan_persil" placeholder="Ex : 1" required>
                </div>
                <div class="form-group">
                  <label for="peruntukan_persil">Peruntukan Persil</label>
                  <input type="text" class="form-control" name="peruntukan_persil" placeholder="Ex : Murni Bisnis" required>
                </div>
                <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                <button type="reset" class="btn btn-gradient-success mr-2">Reset</button>
                <a href="?page=data_peruntukan_persil" class="btn btn-gradient-danger">Cancel</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php elseif (@$_GET['action'] == 'proses_tambah'): ?>
      <?php  
      $id_peruntukan_persil = @mysqli_real_escape_string($db, $_POST['id_peruntukan_persil']);
      $peruntukan_persil = @mysqli_real_escape_string($db, $_POST['peruntukan_persil']);
      $sql_cek_id = mysqli_query($db, "SELECT * FROM data_peruntukan_persil WHERE id_peruntukan_persil = '$id_peruntukan_persil'") or die ($db->error);
      if (mysqli_num_rows($sql_cek_id) > 0) {
      echo "<script>alert('ID Sudah Tersedia Coba Gunakaan ID Lain')</script>";
      echo "<script>window.location='?page=data_peruntukan_persil&action=tambah_peruntukan_persil';</script>";
      } else {
      mysqli_query($db, "INSERT INTO data_peruntukan_persil VALUES('', '$id_peruntukan_persil', '$peruntukan_persil')")
                    or die ($db->error);
      echo "<script>window.location='?page=data_peruntukan_persil';</script>";
      }
      ?>
<?php elseif (@$_GET['action'] == 'edit_peruntukan_persil'): ?>
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Edit Peruntukan Persil
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">Edit</a></li>
                <li class="breadcrumb-item active" aria-current="page">Peruntukan Persil</li>
              </ol>
            </nav>
          </div>
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample" method="post" action="?page=data_peruntukan_persil&action=proses_edit&id_pp=<?= $id_pp; ?>" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="id_peruntukan_persil">Kelas</label>
                      <input type="text" class="form-control" name="id_peruntukan_persil" value="<?= $data['id_peruntukan_persil']; ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label for="peruntukan_persil">Peruntukan Persil</label>
                      <input type="text" class="form-control" name="peruntukan_persil" value="<?= $data['peruntukan_persil']; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                    <button type="reset" class="btn btn-gradient-success mr-2">Reset</button>
                    <a href="?page=data_peruntukan_persil" class="btn btn-gradient-danger">Cancel</a>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
<?php elseif (@$_GET['action'] == 'proses_edit'): ?>
          <?php 
          $id_peruntukan_persil = @mysqli_real_escape_string($db, $_POST['id_peruntukan_persil']);
          $peruntukan_persil = @mysqli_real_escape_string($db, $_POST['peruntukan_persil']);
          mysqli_query($db, "UPDATE data_peruntukan_persil SET peruntukan_persil = '$peruntukan_persil' WHERE id_pp = '$id_pp' ") or die ($db->error);
          echo "<script>window.location='?page=data_peruntukan_persil';</script>";

          ?>
<?php elseif (@$_GET['action'] == 'hapus_peruntukan_persil'): ?>
  <?php  
  mysqli_query($db, "DELETE FROM data_peruntukan_persil WHERE id_pp = '$id_pp'") or die ($db->error);
  
  echo '<script>window.location="?page=data_peruntukan_persil";</script>';
  ?>
<?php endif; ?>