<?php
@session_start();
include '+koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Register | Sisirtarif</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row w-100">
          <div class="col-lg-6 mx-auto">
            <div class="auth-form-light text-left p-5">
              <div class="brand-logo text-center">
                <img src="images/logo.svg">
              </div>
              <?php
              if(@$_POST['daftar']) {
                $nik = @mysqli_real_escape_string($db, $_POST['nik']);
                $nama_lengkap = @mysqli_real_escape_string($db, $_POST['nama_lengkap']);
                $email = @mysqli_real_escape_string($db, $_POST['email']);
                $no_telp = @mysqli_real_escape_string($db, $_POST['no_telp']);
                $jenis_kelamin = @mysqli_real_escape_string($db, $_POST['jenis_kelamin']);
                $alamat = @mysqli_real_escape_string($db, $_POST['alamat']);
                $username = @mysqli_real_escape_string($db, $_POST['username']);
                $password = @mysqli_real_escape_string($db, $_POST['password']);
                $password2 = @mysqli_real_escape_string($db, $_POST['password2']);

                $sql_cek_user = mysqli_query($db, "SELECT * FROM user WHERE nik = '$nik'") or die ($db->error);
                if(mysqli_num_rows($sql_cek_user) > 0) {
                  echo '<div class="alert alert-danger text-center">NIK Anda Sudah Terdaftar Jika Lupa Password Hubungi Admin</div>';
                } elseif ($password != $password2) {
                  echo '<div class="alert alert-danger text-center">Password Tidak Sesuai!</div>';
                } else {
                  mysqli_query($db, "INSERT INTO user VALUES(
                    '$nik', '$nama_lengkap', 
                    '$email',
                    '$no_telp',
                    '$jenis_kelamin',
                    '$alamat',
                    'default.png',
                    '$username',
                    md5('$password'), 
                    '$password',
                    'Karyawan', 
                    'Tidak Aktif',
                    now() )
                    ") or die ($db->error);          
                  echo '<script>alert("Pendaftaran berhasil, silahkan login"); window.location="login.php"</script>';
                } 
              }
              ?>
              <form class="pt-3" method="post">
                <div class="form-group">
                  <input type="number" class="form-control form-control-sm" id="nik" name="nik" placeholder="Nomor NIK" required>
                </div>

                <div class="form-group">
                  <input type="text" class="form-control form-control-sm" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap" required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-sm" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-sm" id="no_telp" name="no_telp" placeholder="No Telp" required>
                </div>
                <div class="form-group">
                  <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="Pria">Pria</option>
                    <option value="Wanita">Wanita</option>
                  </select>
                </div>
                <div class="form-group">
                  <textarea name="alamat" id="alamat" rows="4" class="form-control" placeholder="Alamat" required></textarea>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-sm" id="username" name="username" placeholder="Username" required>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-sm" id="password" name="password" placeholder="Password" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-sm" id="password2" name="password2" placeholder="Confirm Password" required>
                  </div>
                </div>
                <div class="mt-3">
                  <input type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" value="Daftar" name="daftar">
                </div>
                <div class="text-center mt-3 font-weight-light">
                  Sudah Punya Akun ? <a href="login.php" class="text-primary">Login</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>


  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <script src="vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/misc.js"></script>
  <!-- endinject -->
</body>

</html>
