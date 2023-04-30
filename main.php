<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "my_db_pegawai";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}
$nip        = "";
$nama       = "";
$alamat     = "";
$jenis_kelamin   = "";
$jabatan ="";
$department = "";
$sukses     = "";
$error      = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if($op == 'delete'){
    $id         = $_GET['id'];
    $sql1       = "delete from pegawai where id = '$id'";
    $q1         = mysqli_query($koneksi,$sql1);
    if($q1){
        $sukses = "Berhasil hapus data";
    }else{
        $error  = "Gagal melakukan delete data";
    }
}
if ($op == 'edit') {
    $id         = $_GET['id'];
    $sql1       = "select * from pegawai where id = '$id'";
    $q1                     = mysqli_query($koneksi, $sql1);
    $r1                     = mysqli_fetch_array($q1);
    $nip                    = $r1['nip'];
    $nama_lengkap           = $r1['nama_lengkap'];
    $alamat                 = $r1['alamat'];
    $jenis_kelamin          = $r1['jenis_kelamin'];
    $jabatan                = $r1['jabatan'];
    $department             = $r1['department'];

    if ($nim == '') {
        $error = "Data tidak ditemukan";
    }
}
if (isset($_POST['simpan'])) { //untuk create
    $nip                = $_POST['nip'];
    $nama_lengkap       = $_POST['nama_lengkap'];
    $alamat             = $_POST['alamat'];
    $jenis_kelamin      = $_POST['jenis_kelamin'];
    $jabatan            = $_POST['jabatan'];
    $department         = $_POST['department'];

    if ($nip && $nama_lengkap && $alamat && $jenis_kelamin && $jabatan && $department) {
        if ($op == 'edit') { //untuk update
            $sql1       = "update pegawai set nip = '$nip',nama_lengkap='$nama_lengkap',alamat = '$alamat',jenis_kelamin='$jenis_kelamin',jabatan = '$jabatan',department='$department' where id = '$id'";
            $q1         = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate";
            }
        } else { //untuk insert
            $sql1   = "insert into pegawai(nip,nama,alamat,jabatan,department) values ('$nip','$nama','$alamat','$jabatan','$department')";
            $q1     = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses     = "Berhasil memasukkan data baru";
            } else {
                $error      = "Gagal memasukkan data";
            }
        }
    } else {
        $error = "Silakan masukkan semua data";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 800px
        }

        .card {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="mx-auto">
        <!-- untuk memasukkan data -->
        <div class="card">
            <div class="card-header">
                Create / Edit Data
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh:5;url=main.php");//5 : detik
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                    header("refresh:5;url=main.php");
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="nip" class="col-sm-2 col-form-label">NIP</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nip" name="nip" value="<?php echo $nip ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama_lengkap" class="col-sm-2 col-form-label">Nama Lengkap</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?php echo $nama?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                <option value="">- Pilih Jenis Kelamin Anda -</option>
                                <option value="perempuan" <?php if ($jenis_kelamin == "perempuan") echo "selected" ?>>perempuan</option>
                                <option value="laki-laki" <?php if ($jenis_kelamin == "laki-laki") echo "selected" ?>>laki-laki</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="jabatan" id="jabatan">
                                <option value="">- Pilih Jabatan Anda -</option>
                                <option value="HRD" <?php if ($jabatan == "HRD") echo "selected" ?>>HRD</option>
                                <option value="Manager pemasaran" <?php if ($jabatan == "Manager pemasaran") echo "selected" ?>>Manager pemasaran</option>
                                 <option value="Manager keuangan" <?php if ($jabatan == "Manager keuangan") echo "selected" ?>>Manager keuangan</option>
                            </select>
                        </div>
                    </div>
                   <div class="mb-3 row">
                        <label for="department" class="col-sm-2 col-form-label">Department</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="department" id="department">
                                <option value="">- Pilih Department Anda -</option>
                                <option value="Kepegawaian" <?php if ($department == "Kepegawaian") echo "selected" ?>>Kepegawaian</option>
                                <option value="Pemasaran" <?php if ($department == "Pemasaran") echo "selected" ?>>Pemasaran</option>
                                 <option value="Keuangan" <?php if ($department == "Keuangan") echo "selected" ?>>Keuangan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>

        <!-- untuk mengeluarkan data -->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Data Pegawai
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">NIP</th>
                            <th scope="col">Nama lengkap</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Jenis Kelamin</th>
                             <th scope="col">Jabatan</th>
                              <th scope="col">Department</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2   = "select * from pegawai order by id desc";
                        $q2     = mysqli_query($koneksi, $sql2);
                        $urut   = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id         = $r2['id'];
                            $nip        = $r2['nip'];
                            $nama       = $r2['nama'];
                            $alamat     = $r2['alamat'];
                            $jabatan   = $r2['jabatan'];
                            $department   = $r2['department'];

                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $nip ?></td>
                                <td scope="row"><?php echo $nama ?></td>
                                <td scope="row"><?php echo $alamat ?></td>
                                <td scope="row"><?php echo $jabatan ?></td>
                                  <td scope="row"><?php echo $department ?></td>
                                <td scope="row">
                                    <a href="index.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="index.php?op=delete&id=<?php echo $id?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a>            
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>
</body>

</html>