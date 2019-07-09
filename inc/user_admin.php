<?php
$nik = @$_GET['nik'];

$sql_per_id = mysqli_query($db, "SELECT * FROM user WHERE nik = '$nik'") or die ($db->error);
$data = mysqli_fetch_array($sql_per_id);

$sql_admin = mysqli_query($db, "SELECT * FROM user WHERE hak_akses = 'Admin' ") or die ($db->error);
$no = 1;
?>
<?php if (@$_GET['action'] == ''): ?>
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
        Manajemen User Admin
      </h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Admin</li>
          <li class="breadcrumb-item active" aria-current="page">Manajemen User</li>
        </ol>
      </nav>
    </div>

    <div class="row">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <a href="?page=user_admin&action=tambah_admin" class="btn btn-outline-primary btn-icon-text btn-sm">
              <i class="mdi mdi-account-plus btn-icon-prepend"></i>
              Tambah Data
            </a>
            <a href="./laporan/cetak_admin.php" target="_blank" class="btn btn-outline-primary btn-icon-text btn-sm">
              <i class="mdi mdi-printer btn-icon-prepend"></i>
              Cetak Data
            </a> 
            <hr>
            <div class="table-responsive ">
              <table class="table" id="myTable">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>No Telp</th>
                    <th>Status</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while($data_admin = mysqli_fetch_array($sql_admin)) { ?>
                    <tr>
                      <td><?= $no++; ?>  </td>
                      <td>
                        <img src="images/foto/<?= $data_admin['gambar']; ?>" class="mr-2" alt="image">
                        <?= $data_admin['nama_lengkap']; ?>
                      </td>
                      <td><?= $data_admin['email']; ?></td>
                      <td><?= $data_admin['no_telp']; ?></td>
                      <td><?= $data_admin['status']; ?></td>
                      <td>
                        <a href="?page=user_admin&action=detail&nik=<?= $data_admin['nik']; ?>" class="badge badge-gradient-primary" style="text-decoration: none;">Detail</a>
                        <a href="?page=user_admin&action=edit_admin&nik=<?= $data_admin['nik']; ?>" class="badge badge-gradient-success" style="text-decoration: none;">Edit</a>
                        <a href="?page=user_admin&action=hapus_admin&nik=<?php echo $data_admin['nik']; ?>" class="badge badge-gradient-danger tombol-hapus" style="text-decoration: none;">Hapus</a>
                        <!-- <a onclick="return confirm('Yakin akan menghapus data?');" href="?page=user_admin&action=hapus_admin&nik=<?php echo $data_admin['nik']; ?>" class="badge badge-gradient-danger" style="text-decoration: none;">Hapus</a> -->
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
<?php elseif (@$_GET['action'] == 'detail'): ?>
  <div class="content-wrapper">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="border-bottom text-center pb-4">
                  <img src="images/foto/<?= $data['gambar']; ?>" alt="profile" class="img-lg rounded-circle mb-3" />
                  <p><?= $data['nama_lengkap']; ?></p>
                </div>
                <div class="py-4">
                  <p class="clearfix">
                    <span class="float-left"> Status </span>
                    <span class="float-right text-muted"> <?= $data['status']; ?> </span>
                  </p>
                  <p class="clearfix">
                    <span class="float-left"> NIK </span>
                    <span class="float-right text-muted"> <?= $data['nik']; ?> </span>
                  </p>
                  <p class="clearfix">
                    <span class="float-left"> Nama Lengkap </span>
                    <span class="float-right text-muted"> <?= $data['nama_lengkap']; ?></span>
                  </p>
                  <p class="clearfix">
                    <span class="float-left"> Email </span>
                    <span class="float-right text-muted"> <?= $data['email']; ?> </span>
                  </p>
                  <p class="clearfix">
                    <span class="float-left"> No. HP </span>
                    <span class="float-right text-muted"> <?= $data['no_telp']; ?> </span>
                  </p>
                  <p class="clearfix">
                    <span class="float-left"> Jenis Kelamin </span>
                    <span class="float-right text-muted"> <?= $data['jenis_kelamin']; ?> </span>
                  </p>
                  <p class="clearfix">
                    <span class="float-left"> Alamat </span>
                    <span class="float-right text-muted"> <?= $data['alamat']; ?> </span>
                  </p>
                  <p class="clearfix">
                    <span class="float-left"> Username </span>
                    <span class="float-right text-muted"><?= $data['username']; ?></span>
                  </p>
                  <p class="clearfix">
                    <span class="float-left"> Password </span>
                    <span class="float-right text-muted"><?= $data['password']; ?></span>
                  </p>
                  <p class="clearfix">
                    <span class="float-left"> Tgl Buat Akun </span>
                    <span class="float-right text-muted"><?= $data['tgl_buat']; ?></span>
                  </p>
                </div>
                <a href="?page=user_admin&action=edit_admin&nik=<?= $data['nik']; ?>" class="btn btn-gradient-success btn-block">Edit</a>
                <a href="?page=user_admin" class="btn btn-gradient-primary btn-block">Kembali</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php elseif (@$_GET['action'] == 'tambah_admin'): ?>
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title">
          Tambah User Admin
        </h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">Tambah</a></li>
            <li class="breadcrumb-item active" aria-current="page">Manajemen User</li>
          </ol>
        </nav>
      </div>
      <div class="row">
        <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <form class="forms-sample" method="post" action="?page=user_admin&action=proses_tambah" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="nik">NIK</label>
                  <input type="text" class="form-control" name="nik" placeholder="NIK" required>
                </div>
                <div class="form-group">
                  <label for="nama_lengkap">Nama Lengkap</label>
                  <input type="text" class="form-control" name="nama_lengkap" placeholder="Nama Lengkap" required>
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                  <label for="exampleSelectGender">Jenis Kelamin</label>
                  <select class="form-control" name="jenis_kelamin">
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="Wanita">Wanita</option>
                    <option value="Pria">Pria</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="no_telp">No. Telp</label>
                  <input type="number" class="form-control" name="no_telp" placeholder="No Telp" required>
                </div>
                <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <textarea class="form-control" name="alamat" rows="4" placeholder="Alamat" required></textarea>
                </div>
                <div class="form-group">
                  <label for="foto">Foto</label>
                  <!-- <input type="file" class="form-control"> -->
                  <div class="row">
                    <div class="col-md-2 text-center">
                      <img src="images/foto/default.jpg" class="img-lg mb-1 rounded-circle border" />
                    </div>
                    <div class="col-md-10">
                      <input type="file" name="files" class="form-control" required>
                    </div>
                  </div>
                </div>
                <!-- <hr> -->
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" name="username" placeholder="Username" required>
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                <button type="reset" class="btn btn-gradient-success mr-2">Reset</button>
                <a href="?page=user_admin" class="btn btn-gradient-danger">Cancel</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php elseif (@$_GET['action'] == 'proses_tambah'): ?>
      <?php  
      $nik = @mysqli_real_escape_string($db, $_POST['nik']);
      $nama_lengkap = @mysqli_real_escape_string($db, $_POST['nama_lengkap']);
      $email = @mysqli_real_escape_string($db, $_POST['email']);
      $no_telp = @mysqli_real_escape_string($db, $_POST['no_telp']);
      $jenis_kelamin = @mysqli_real_escape_string($db, $_POST['jenis_kelamin']);
      $alamat = @mysqli_real_escape_string($db, $_POST['alamat']);
      $username = @mysqli_real_escape_string($db, $_POST['username']);
      $password = @mysqli_real_escape_string($db, $_POST['password']);

      $ekstensi_diperbolehkan = array('png','jpg');
      $nama = @$_FILES['files']['name'];
      $x = explode('.', $nama);
      $ekstensi = strtolower(end($x));
      $ukuran = @$_FILES['files']['size'];
      $file_tmp = @$_FILES['files']['tmp_name']; 

      $sql_cek_user = mysqli_query($db, "SELECT * FROM user WHERE nik = '$nik'") or die ($db->error);
      if(mysqli_num_rows($sql_cek_user) > 0) {
        echo '<div class="alert alert-danger text-center">NIK Anda Sudah Terdaftar</div>';
      } if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
        if($ukuran < 1044070){      
          move_uploaded_file($file_tmp, 'images/foto/'.$nama);
          mysqli_query($db, "INSERT INTO user VALUES(
            '$nik', '$nama_lengkap', 
            '$email',
            '$no_telp',
            '$jenis_kelamin',
            '$alamat',
            '$nama',
            '$username',
            md5('$password'), 
            '$password',
            'Admin', 
            'Aktif',
            now() )
            ") or die ($db->error);
          // echo '<script>Swal.fire("Good job!", "Data berhasil ditambah!", "success");</script>';          
          echo '<script>window.location="?page=user_admin"</script>';
        }else{
          echo '<div class="alert alert-danger">Ukuran File Terlalu Besar!</div>';
        }
      }else{
        echo '<div class="alert alert-danger">Ekstensi File Tidak Diperbolehkan!</div>';
      }
      ?>
<?php elseif (@$_GET['action'] == 'edit_admin'): ?>
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Edit User Admin
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">Edit</a></li>
                <li class="breadcrumb-item active" aria-current="page">Manajemen User</li>
              </ol>
            </nav>
          </div>
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample" method="post" action="?page=user_admin&action=proses_edit" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="nik">NIK</label>
                      <input type="text" class="form-control" name="nik" value="<?= $data['nik']; ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="nama_lengkap">Nama Lengkap</label>
                      <input type="text" class="form-control" name="nama_lengkap" value="<?= $data['nama_lengkap']; ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" name="email" value="<?= $data['email']; ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleSelectGender">Jenis Kelamin</label>
                      <select class="form-control" name="jenis_kelamin">
                        <?php
                        $sql2 = tampil_per_id("user", "nik = '$data[nik]'");
                        $data2 = mysqli_fetch_array($sql2);
                        if(mysqli_num_rows($sql2) > 0) { 
                          echo '<option value="'.$data2['jenis_kelamin'].'">'.$data2['jenis_kelamin'].'</option>';
                          echo '<option value="">-- Pilih Jenis Kelamin --</option>';
                        } else {
                          echo '<option value="">-- Pilih Jenis Kelamin --</option>';
                        }
                        echo '<option value="Pria">Pria</option>';
                        echo '<option value="Wanita">Wanita</option>';
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="no_telp">No. Telp</label>
                      <input type="number" class="form-control" name="no_telp" value="<?= $data['no_telp']; ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="alamat">Alamat</label>
                      <textarea class="form-control" name="alamat" rows="4" required><?= $data['alamat']; ?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="foto">Foto</label>
                      <!-- <input type="file" class="form-control"> -->
                      <div class="row">
                        <div class="col-md-2 text-center">
                          <img src="images/foto/<?= $data['gambar']; ?>" class="img-lg mb-1 rounded-circle border" />
                        </div>
                        <div class="col-md-10">
                          <input type="file" name="files" class="form-control">
                        </div>
                      </div>
                    </div>
                    <!-- <hr> -->
                    <div class="form-group">
                      <label for="username">Username</label>
                      <input type="text" class="form-control" name="username" value="<?= $data['username']; ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" class="form-control" name="password" value="<?= $data['pass']; ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleSelectGender">Hak Akses</label>
                      <select class="form-control" name="hak_akses">
                        <?php
                        $sql2 = tampil_per_id("user", "nik = '$data[nik]'");
                        $data2 = mysqli_fetch_array($sql2);
                        if(mysqli_num_rows($sql2) > 0) { 
                          echo '<option value="'.$data2['hak_akses'].'">'.$data2['hak_akses'].'</option>';
                          echo '<option value="">-- Pilih Hak Akses --</option>';
                        } else {
                          echo '<option value="">-- Pilih Hak Akses --</option>';
                        }
                        echo '<option value="Admin">Admin</option>';
                        echo '<option value="Karyawan">Karyawan</option>';
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleSelectGender">Status</label>
                      <select class="form-control" name="status">
                        <?php
                        $sql2 = tampil_per_id("user", "nik = '$data[nik]'");
                        $data2 = mysqli_fetch_array($sql2);
                        if(mysqli_num_rows($sql2) > 0) { 
                          echo '<option value="'.$data2['status'].'">'.$data2['status'].'</option>';
                          echo '<option value="">-- Pilih Status --</option>';
                        } else {
                          echo '<option value="">-- Pilih Status --</option>';
                        }
                        echo '<option value="Aktif">Aktif</option>';
                        echo '<option value="Tidak Aktif">Tidak Aktif</option>';
                        ?>
                      </select>
                    </div>
                    <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                    <button type="reset" class="btn btn-gradient-success mr-2">Reset</button>
                    <a href="?page=user_admin" class="btn btn-gradient-danger">Cancel</a>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
<?php elseif (@$_GET['action'] == 'proses_edit'): ?>
          <?php  
          $nik = @mysqli_real_escape_string($db, $_POST['nik']);
          $nama_lengkap = @mysqli_real_escape_string($db, $_POST['nama_lengkap']);
          $email = @mysqli_real_escape_string($db, $_POST['email']);
          $jenis_kelamin = @mysqli_real_escape_string($db, $_POST['jenis_kelamin']);
          $no_telp = @mysqli_real_escape_string($db, $_POST['no_telp']);
          $alamat = @mysqli_real_escape_string($db, $_POST['alamat']);
          $username = @mysqli_real_escape_string($db, $_POST['username']);
          $password = @mysqli_real_escape_string($db, $_POST['password']);
          $hak_akses = @mysqli_real_escape_string($db, $_POST['hak_akses']);
          $status = @mysqli_real_escape_string($db, $_POST['status']);


          $ekstensi_diperbolehkan = array('png','jpg');
          $nama = @$_FILES['files']['name'];
          $x = explode('.', $nama);
          $ekstensi = strtolower(end($x));
          $ukuran = @$_FILES['files']['size'];
          $file_tmp = @$_FILES['files']['tmp_name'];  

          if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
            if($ukuran < 1044070){      
              move_uploaded_file($file_tmp, 'images/foto/'.$nama);
              mysqli_query($db, "UPDATE user SET nik = '$nik', nama_lengkap = '$nama_lengkap', email = '$email', jenis_kelamin = '$jenis_kelamin', no_telp = '$no_telp', alamat = '$alamat', gambar = '$nama', username = '$username', password = md5('$password'), pass = '$password', hak_akses = '$hak_akses', status = '$status' WHERE nik = '$nik' ") or die ($db->error);
              echo "<script>window.location='?page=user_admin';</script>";
            }else{
              echo '<div class="alert alert-danger">Ukuran File Terlalu Besar!</div>';
            }
          }else{
            echo '<div class="alert alert-danger">Ekstensi File Tidak Diperbolehkan!</div>';
          }
          ?>
<?php elseif (@$_GET['action'] == 'hapus_admin'): ?>
  <?php  
  mysqli_query($db, "DELETE FROM user WHERE nik = '$nik'") or die ($db->error);
  
  echo '<script>window.location="?page=user_admin";</script>';
  ?>
<?php endif; ?>