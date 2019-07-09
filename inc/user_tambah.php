<div class="content-wrapper">
  <div class="page-header">
    <h3 class="page-title">
      Tambah User
    </h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Tambah</a></li>
        <li class="breadcrumb-item active" aria-current="page">Manajemen User</li>
      </ol>
    </nav>
  </div>
  <div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <form class="forms-sample">
            <div class="form-group">
              <label for="exampleInputName1">Nama Lengkap</label>
              <input type="text" class="form-control" id="exampleInputName1" placeholder="Nama Lengkap">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail3">Email</label>
              <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Email">
            </div>
            <div class="form-group">
              <label for="exampleSelectGender">Jenis Kelamin</label>
              <select class="form-control" id="exampleSelectGender">
                <option>-- Pilih Jenis Kelamin --</option>
                <option>Pria</option>
                <option>Wanita</option>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail3">No. HP</label>
              <input type="number" class="form-control" id="exampleInputEmail3" placeholder="Email">
            </div>
            <div class="form-group">
              <label for="exampleTextarea1">Alamat</label>
              <textarea class="form-control" id="exampleTextarea1" rows="4"></textarea>
            </div>
            <div class="form-group">
              <label>Upload Foto</label>
              <input type="file" name="img[]" class="file-upload-default">
              <div class="input-group col-xs-12">
                <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Foto">
                <span class="input-group-append">
                  <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                </span>
              </div>
            </div>
            <div class="form-group">
              <label for="exampleInputCity1">Username</label>
              <input type="text" class="form-control" id="exampleInputCity1" placeholder="Username">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword4">Password</label>
              <input type="password" class="form-control" id="exampleInputPassword4" placeholder="Password">
            </div>
            <div class="form-group">
              <label for="exampleSelectGender">Hak Akses</label>
              <select class="form-control" id="exampleSelectGender">
                <option>-- Pilih Hak Akses --</option>
                <option>Admin</option>
                <option>Karyawan</option>
              </select>
            </div>
            <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
            <button type="reset" class="btn btn-gradient-success mr-2">Reset</button>
            <button onclick="self.history.back();" class="btn btn-gradient-danger">Cancel</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>