<?php
// include '+koneksi.php';
@session_start();

if(@$_SESSION['superadmin'] || @$_SESSION['admin'] || @$_SESSION['karyawan']) {
  echo "<script>window.location='./';</script>";
} else {
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login | Sisirtarif</title>
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
          <div class="col-lg-5 mx-auto">
            <div class="auth-form-light text-left p-5">
              <div class="brand-logo text-center">
                <img src="images/logo.svg">
              </div>
              <?php
              if(@$_POST['login']) {
                $user = @mysqli_real_escape_string($db, $_POST['user']);
                $password = @mysqli_real_escape_string($db, $_POST['password']);
                $sql = mysqli_query($db, "SELECT * FROM user WHERE nik = '$user' OR username = '$user' AND password = md5('$password')") or die ($db->error);
                $data = mysqli_fetch_array($sql);
                if(mysqli_num_rows($sql) > 0) {
                  if($data['status'] == 'Aktif') {
                    if ( $data['hak_akses'] == 'SuperAdmin' ) {
                      @$_SESSION['superadmin'] = $data['nik'];
                      $nik = $data['nik'];
                      mysqli_query($db, "INSERT INTO user_online VALUES('$nik', now(), 'ONLINE')")
                    or die ($db->error);
                      echo "<script>window.location='./';</script>";
                    }
                    elseif ( $data['hak_akses'] == 'Admin' ) {
                      @$_SESSION['superadmin'] = $data['nik'];
                      $nik = $data['nik'];
                      mysqli_query($db, "INSERT INTO user_online VALUES('$nik', now(), 'ONLINE')")
                    or die ($db->error);
                      echo "<script>window.location='./';</script>";
                    } else {
                      @$_SESSION['karyawan'] = $data['nik'];
                      $nik = $data['nik'];
                      mysqli_query($db, "INSERT INTO user_online VALUES('$nik', now(), 'ONLINE')")
                    or die ($db->error);
                      echo "<script>window.location='./';</script>";
                    }
                  } else {
                    echo '<div class="alert alert-danger text-center">Login gagal, akun Anda sedang tidak aktif hubungi admin</div>';
                  }
                } else {
                  echo '<div class="alert alert-danger text-center">Login gagal, NIK / Password salah, coba lagi!</div>';
                }
              } ?>
              <form class="pt-3" method="post">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" name="user" placeholder="NIK / Username" required>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" name="password" placeholder="Password" required>
                </div>
                <div class="mt-3">
                  <input type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" value="Login" name="login">
                </div>
                <div class="mt-1">
                  <a class="btn btn-block btn-gradient-info btn-lg font-weight-medium auth-form-btn" href="register.php">Daftar</a>
                </div>
                
                <!-- <div class="text-center mt-3 font-weight-light">
                  Lupa Password ? <a href="register.html" class="text-primary">Click Here</a>
                </div> -->
              </form>
              <!-- <div class="mt-1">
                  <a class="btn btn-block btn-gradient-info btn-lg font-weight-medium auth-form-btn" onclick="Swal.fire('Hello World', 'Latihan SweetAlert', 'success')" href="#">Cek sweetalert</a>
                </div> -->
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
  <script src="js/sweetalert2.all.min.js"></script>
</body>

</html>
<?php } ?>