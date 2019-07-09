<?php 
$nik = @$_GET['nik'];

$sql_per_id = mysqli_query($db, "SELECT * FROM user WHERE nik = '$nik'") or die ($db->error);
$data = mysqli_fetch_array($sql_per_id);
if(@$_GET['action'] == '') {
  ?>
  <div class="content-wrapper">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="border-bottom text-center pb-4">
                  <img src="images/foto/<?= $data_terlogin['gambar']; ?>" alt="profile" class="img-lg rounded-circle mb-3" />
                  <p><?= $data_terlogin['nama_lengkap']; ?></p>
                </div>
                <div class="py-4">
                  <p class="clearfix">
                    <span class="float-left"> Status </span>
                    <span class="float-right text-muted"> Aktif </span>
                  </p>
                  <p class="clearfix">
                    <span class="float-left"> NIK </span>
                    <span class="float-right text-muted"> <?= $data_terlogin['nik']; ?> </span>
                  </p>
                  <p class="clearfix">
                    <span class="float-left"> Nama Lengkap </span>
                    <span class="float-right text-muted"> <?= $data_terlogin['nama_lengkap']; ?></span>
                  </p>
                  <p class="clearfix">
                    <span class="float-left"> Email </span>
                    <span class="float-right text-muted"> <?= $data_terlogin['email']; ?> </span>
                  </p>
                  <p class="clearfix">
                    <span class="float-left"> No. HP </span>
                    <span class="float-right text-muted"> <?= $data_terlogin['no_telp']; ?> </span>
                  </p>
                  <p class="clearfix">
                    <span class="float-left"> Jenis Kelamin </span>
                    <span class="float-right text-muted"> <?= $data_terlogin['jenis_kelamin']; ?> </span>
                  </p>
                  <p class="clearfix">
                    <span class="float-left"> Alamat </span>
                    <span class="float-right text-muted"> <?= $data_terlogin['alamat']; ?> </span>
                  </p>
                  <p class="clearfix">
                    <span class="float-left"> Username </span>
                    <span class="float-right text-muted"><?= $data_terlogin['username']; ?></span>
                  </p>
                  <p class="clearfix">
                    <span class="float-left"> Password </span>
                    <span class="float-right text-muted"><?= $data_terlogin['password']; ?></span>
                  </p>
                </div>
                <a href="?page=users_detail&action=editusers&nik=<?= $data_terlogin['nik']; ?>" class="btn btn-gradient-success btn-block">Edit</a>
                <a href="./" class="btn btn-gradient-primary btn-block">Kembali</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } elseif (@$_GET['action'] == 'editusers') { ?>
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
        Edit User
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
            <form class="forms-sample" method="post" action="?page=users_detail&action=proseseditusers&nik=<?php echo $data['nik']; ?>" enctype="multipart/form-data">
              <div class="form-group">
                <label for="nik">NIK</label>
                <input type="text" class="form-control" name="nik" value="<?= $data['nik']; ?>" readonly>
              </div>
              <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input type="text" class="form-control" name="nama_lengkap" value="<?= $data['nama_lengkap']; ?>">
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" value="<?= $data['email']; ?>">
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
                <input type="number" class="form-control" name="no_telp" value="<?= $data['no_telp']; ?>">
              </div>
              <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea class="form-control" name="alamat" rows="4"><?= $data['alamat']; ?></textarea>
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
                <input type="text" class="form-control" name="username" value="<?= $data['username']; ?>">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" value="<?= $data['pass']; ?>">
              </div>
              <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
              <button type="reset" class="btn btn-gradient-success mr-2">Reset</button>
              <a href="?page=users_detail" class="btn btn-gradient-danger">Cancel</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } elseif (@$_GET['action'] == 'proseseditusers') { 

  $nik = @mysqli_real_escape_string($db, $_POST['nik']);
  $nama_lengkap = @mysqli_real_escape_string($db, $_POST['nama_lengkap']);
  $email = @mysqli_real_escape_string($db, $_POST['email']);
  $jenis_kelamin = @mysqli_real_escape_string($db, $_POST['jenis_kelamin']);
  $no_telp = @mysqli_real_escape_string($db, $_POST['no_telp']);
  $alamat = @mysqli_real_escape_string($db, $_POST['alamat']);
  $username = @mysqli_real_escape_string($db, $_POST['username']);
  $password = @mysqli_real_escape_string($db, $_POST['password']);


  $ekstensi_diperbolehkan = array('png','jpg');
  $nama = @$_FILES['files']['name'];
  $x = explode('.', $nama);
  $ekstensi = strtolower(end($x));
  $ukuran = @$_FILES['files']['size'];
  $file_tmp = @$_FILES['files']['tmp_name'];  

  if ($nama == '') {
    if($ukuran < 1044070){      
      move_uploaded_file($file_tmp, 'images/foto/'.$nama);
      mysqli_query($db, "UPDATE user SET nik = '$nik', nama_lengkap = '$nama_lengkap', email = '$email', jenis_kelamin = '$jenis_kelamin', no_telp = '$no_telp', alamat = '$alamat', username = '$username', password = md5('$password'), pass = '$password' WHERE nik = '$nik' ") or die ($db->error);
      echo "<script>window.location='?page=users_detail';</script>";
    }else{
      echo '<div class="alert alert-danger">Ukuran File Terlalu Besar!</div>';
    }
  } else {
    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
      if($ukuran < 1044070){      
        move_uploaded_file($file_tmp, 'images/foto/'.$nama);
        mysqli_query($db, "UPDATE user SET nik = '$nik', nama_lengkap = '$nama_lengkap', email = '$email', jenis_kelamin = '$jenis_kelamin', no_telp = '$no_telp', alamat = '$alamat', gambar = '$nama', username = '$username', password = md5('$password'), pass = '$password' WHERE nik = '$nik' ") or die ($db->error);
        echo "<script>window.location='?page=users_detail';</script>";
      }else{
        echo '<div class="alert alert-danger">Ukuran File Terlalu Besar!</div>';
      }
    }else{
      echo '<div class="alert alert-danger">Ekstensi File Tidak Diperbolehkan!</div>';
    }
  }
  
  

} ?>