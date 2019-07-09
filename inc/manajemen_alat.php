<?php  
// $id = @$_GET['id'];
$id_pel = @$_GET['id_pel'];

?>
<?php if (@$_GET['action'] == 'alat_generate'): ?>
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
        Tambah Alat Pelanggan <small>(<?= $id_pel; ?>)</small>
      </h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <a href="?page=data_pelanggan_detail&id_pel=<?= $id_pel; ?>" class="btn btn-gradient-danger btn-sm">Kembali</a>
        </ol>
      </nav>
    </div>
    <div class="row">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <form class="forms-sample" method="post" enctype="multipart/form-data" action="?page=manajemen_alat&action=tambah_alat&id_pel=<?= $id_pel; ?>">
              <div class="form-group mb-2">
                <label for="count_add">Banyak Record yang akan ditambahkan</label>
                <input type="text" class="form-control" name="count_add" id="count_add" maxlength="2" pattern="[0-9]+" placeholder="Ex : 1" required>
              </div>
              <input type="submit" name="generate" class="btn btn-gradient-info btn-sm mr-2 float-right" value="Generate">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php elseif (@$_GET['action'] == 'tambah_alat'): ?>
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title">
          Tambah Alat Pelanggan <small>(<?= $id_pel; ?>)</small>
        </h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <a href="?page=data_pelanggan_detail&id_pel=<?= $id_pel; ?>" class="btn btn-gradient-danger btn-sm mr-2">Batal</a>
            <a href="?page=manajemen_alat&action=alat_generate&id_pel=<?= $id_pel; ?>" class="btn btn-gradient-primary btn-sm">Tambah Data Lagi</a>
          </ol>
        </nav>
      </div>
      <div class="row">
        <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <form class="forms-sample" action="inc/proses_alat.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="total" value="<?=@$_POST['count_add']?>">
                <input type="hidden" name="id_pel" value="<?=$id_pel?>">
                <table class="table">
                  <tr>
                    <th>#</th>
                    <th>Nama Peralatan</th>
                    <th>Keperluan Untuk</th>
                    <th>Daya <small>(Watt)</small></th>
                    <th>Jumlah <small>(Barang)</small></th>
                    <th>Pemakaian Alat <small>(Jam)</small></th>
                    <th>Foto</th>
                  </tr>
                  <?php  
                  for ($i=1; $i <= @$_POST['count_add'] ; $i++){ ?>
                    <tr>
                      <td><?= $i; ?></td>
                      <td>
                        <input type="text" class="form-control" name="nama_peralatan-<?=$i?>" placeholder="Ex : Kulkas" required>
                      </td>
                      <td>
                        <select class="form-control" name="keperluan_untuk-<?=$i?>">
                          <option value="">-- Pilih Keperluan --</option>
                          <option value="Rumah Tangga">Rumah Tangga</option>
                          <option value="Bisnis">Bisnis</option>
                        </select>
                      </td>
                      <td>
                        <input type="text" class="form-control" name="daya-<?=$i?>" placeholder="Ex : 20" required>
                      </td>
                      <td>
                        <input type="text" class="form-control" name="jumlah-<?=$i?>" placeholder="Ex : 5" required>
                      </td>
                      <td>
                        <input type="text" class="form-control" name="pemakaian_alat-<?=$i?>" placeholder="Ex : 5" required>
                      </td>
                      <td>
                        <input type="file" class="form-control" name="foto-<?=$i?>">
                      </td>
                    </tr>
                    <?php 
                  }
                  ?>
                </table>
                <input type="submit" name="add" class="btn btn-gradient-info btn-sm mr-2 float-right" value="Simpan Semua">
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
    <?php elseif (@$_GET['action'] == 'alat_edit'): ?>
    <?php  
    $chk = @$_POST['checked'];
    if (!isset($chk)) {
      echo "<script>alert('Tidak Ada Data Yang Dipilih'); window.location='?page=data_pelanggan_detail&id_pel=$id_pel'</script>";
    } else {
    ?>
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title">
          Edit Alat Pelanggan <small>(<?= $id_pel; ?>)</small>
        </h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <a href="?page=data_pelanggan_detail&id_pel=<?= $id_pel; ?>" class="btn btn-gradient-primary btn-sm">Kembali</a>
          </ol>
        </nav>
      </div>
      <div class="row">
        <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <form class="forms-sample" action="inc/proses_alat.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_alat" value="<?=$id_alat?>">
                <table class="table">
                  <tr>
                    <th>#</th>
                    <th>Nama Peralatan</th>
                    <th>Keperluan Untuk</th>
                    <th>Daya <small>(Watt)</small></th>
                    <th>Jumlah <small>(Barang)</small></th>
                    <th>Pemakaian Alat <small>(Jam)</small></th>
                    <th>Foto</th>
                  </tr>
                  <?php  
                  $no = 1;
                  foreach ($chk as $id_alat) {
                    $sql_alat = mysqli_query($db, "SELECT * FROM alat_pelanggan WHERE id_alat = '$id_alat'") or die (mysqli_error());
                    while ($data = mysqli_fetch_array($sql_alat)) {
                  ?>
                    <tr>
                      <td><?= $no++; ?></td>
                      <td>
                        <input type="hidden" name="id_pel" value="<?= $data['id_pel']; ?>">
                        <input type="hidden" name="id_alat[]" value="<?= $data['id_alat']; ?>">
                        <input type="text" class="form-control" name="nama_peralatan[]" value="<?= $data['nama_peralatan']; ?>" required>
                      </td>
                      <td>
                        <select class="form-control" name="keperluan_untuk[]">
                          <?php
                          $sql2 = tampil_per_id("alat_pelanggan", "keperluan_untuk = '$data[keperluan_untuk]'");
                          $data2 = mysqli_fetch_array($sql2);
                          if(mysqli_num_rows($sql2) > 0) { 
                            echo '<option value="'.$data2['keperluan_untuk'].'">'.$data2['keperluan_untuk'].'</option>';
                            echo '<option value="">-- Pilih Keperluan --</option>';
                          } else {
                            echo '<option value="">-- Pilih Keperluan --</option>';
                          }
                          echo '<option value="Rumah Tangga">Rumah Tangga</option>';
                          echo '<option value="Bisnis">Bisnis</option>';
                          ?>
                        </select>
                      </td>
                      <td>
                        <input type="text" class="form-control" name="daya[]" value="<?= $data['daya']; ?>" required>
                      </td>
                      <td>
                        <input type="text" class="form-control" name="jumlah[]" value="<?= $data['jumlah']; ?>" required>
                      </td>
                      <td>
                        <input type="text" class="form-control" name="pemakaian_alat[]" value="<?= $data['pemakaian_alat']; ?>" required>
                      </td>
                      <td>
                        <input type="file" class="form-control" name="foto[]">
                      </td>
                    </tr>
                    <?php 
                    }
                  }
                  ?>
                </table>
                <input type="submit" name="edit" class="btn btn-gradient-info btn-sm mr-2 float-right" value="Simpan Semua">
              </form>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
  <?php elseif (@$_GET['action'] == 'alat_hapus'): ?>
  <?php  
    $chk = @$_POST['checked'];
    $total = count($chk);
    if (!isset($chk)) {
      echo "<script>alert('Tidak Ada Data Yang Dipilih'); window.location='?page=data_pelanggan_detail&id_pel=$id_pel'</script>";
    } else {
      foreach ($chk as $id) {
        $queryunlink = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM alat_pelanggan WHERE id_alat = '$id' "));
        $fileName = $queryunlink["foto"];
        if ($fileName != 'default.jpg') {
          unlink('images/alat_pelanggan/'.$fileName);
        } else {

        }

        $sql = mysqli_query($db, "DELETE FROM alat_pelanggan WHERE id_alat = '$id' ") or die($db->error);
        // KWH RT
        mysqli_query($db, "DELETE FROM data_testing WHERE id_pel = '$id_pel' ") or die ($db->error);
      }
      if ($sql > 0) {
        echo "<script>alert(' ".$total." data berhasil dihapus '); window.location='?page=data_pelanggan_detail&id_pel=$id_pel';</script>";
      } else {
        echo "<script>alert(' Gagal hapus data coba lagi ! '); window.location='?page=data_pelanggan_detail&id_pel=$id_pel';</script>";
      }
    } ?>
<?php endif; ?>