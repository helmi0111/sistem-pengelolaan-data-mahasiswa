<?php
session_start();
// Jika tidak bisa login maka balik ke login.php
// jika masuk ke halaman ini melalui url, maka langsung menuju halaman login
if (!isset($_SESSION['login'])) {
    header('location:login.php');
    exit;
}

// Memanggil atau membutuhkan file function.php
require 'function.php';

// Mengambil data dari nim dengan fungsi get
$nim = $_GET['nim'];

// Mengambil data dari table mahasiswa dari nim yang tidak sama dengan 0
$mahasiswa = query("SELECT * FROM mahasiswa WHERE nim = $nim")[0];

// Jika fungsi ubah lebih dari 0/data terubah, maka munculkan alert dibawah
if (isset($_POST['ubah'])) {
    if (ubah($_POST) > 0) {
        echo "<script>
                alert('Data mahasiswa berhasil diubah!');
                document.location.href = 'index.php';
            </script>";
    } else {
        // Jika fungsi ubah dibawah dari 0/data tidak terubah, maka munculkan alert dibawah
        echo "<script>
                alert('Data mahasiswa gagal diubah!');
            </script>";
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <!-- Font Google -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <!-- Own CSS -->
    <link rel="stylesheet" href="css/style.css">

    <title>Ubah Data</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-uppercase">
        <div class="container">
            <a class="navbar-brand" href="index.php">Sistem Pengelolaan Data Mahasiswa</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Close Navbar -->

    <!-- Container -->
    <div class="container">
        <div class="row my-2">
            <div class="col-md">
                <h3 class="fw-bold text-uppercase"><i class="bi bi-pencil-square"></i>&nbsp;Ubah Data mahasiswa</h3>
            </div>
            <hr>
        </div>
        <div class="row my-2">
            <div class="col-md">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="gambarLama" value="<?= $mahasiswa['gambar']; ?>">
                    <div class="mb-3">
                        <label for="nim" class="form-label">nim</label>
                        <input type="number" class="form-control w-50" id="nim" value="<?= $mahasiswa['nim']; ?>" name="nim" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control w-50" id="nama" value="<?= $mahasiswa['nama']; ?>" name="nama" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label for="tmpt_Lahir" class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control w-50" id="tmpt_Lahir" value="<?= $mahasiswa['tmpt_Lahir']; ?>" name="tmpt_Lahir" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label for="tgl_Lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control w-50" id="tgl_Lahir" value="<?= $mahasiswa['tgl_Lahir']; ?>" name="tgl_Lahir" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label>Jenim Kelamin</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jekel" id="Laki - Laki" value="Laki - Laki" <?php if ($mahasiswa['jekel'] == 'Laki - Laki') { ?> checked='' <?php } ?>>
                            <label class="form-check-label" for="Laki - Laki">Laki - Laki</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jekel" id="Perempuan" value="Perempuan" <?php if ($mahasiswa['jekel'] == 'Perempuan') { ?> checked='' <?php } ?>>
                            <label class="form-check-label" for="Perempuan">Perempuan</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="prodi" class="form-label">PRODI</label>
                        <select class="form-select w-50" id="prodi" name="prodi">
                            <option disabled selected value>Pilih Prodi</option>
                            <option value="Biologi" <?php if ($mahasiswa['prodi'] == 'Biologi') { ?> selected='' <?php } ?>>Biologi</option>
                            <option value="Farmasi" <?php if ($mahasiswa['prodi'] == 'Farmasi') { ?> selected='' <?php } ?>>Farmasi</option>
                            <option value="Fisika" <?php if ($mahasiswa['prodi'] == 'Fisika') { ?> selected='' <?php } ?>>Fisika</option>
                            <option value="Ilmu Komputer" <?php if ($mahasiswa['prodi'] == 'Ilmu Komputer') { ?> selected='' <?php } ?>>Ilmu Komputer</option>
                            <option value="Kimia" <?php if ($mahasiswa['prodi'] == 'Kimia') { ?> selected='' <?php } ?>>Kimia</option>
                            <option value="Matematika" <?php if ($mahasiswa['prodi'] == 'Matematika') { ?> selected='' <?php } ?>>Matematika</option>
                            <option value="Statistika" <?php if ($mahasiswa['prodi'] == 'Statistika') { ?> selected='' <?php } ?>>Statistika</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="semester" class="form-label">Semester</label>
                        <input type="number" class="form-control w-50" id="semester" value="<?= $mahasiswa['semester']; ?>" min="1" name="semester" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label for="kelas" class="form-label">Kelas</label>
                        <select class="form-select w-50" id="kelas" name="kelas">
                        <option disabled selected value>Pilih Kelas</option>
                            <option value="Reguler" <?php if ($mahasiswa['kelas'] == 'Regueler') { ?> selected='' <?php } ?>>Reguler</option>
                            <option value="Karyawan" <?php if ($mahasiswa['kelas'] == 'Karyawan') { ?> selected='' <?php } ?>>Karyawan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tahun_angkatan" class="form-label">Tahun Angkatan</label>
                        <select class="form-select w-50" id="tahun_angkatan" name="tahun_angkatan">
                        <option disabled selected value>Pilih Tahun Angkatan</option>
                            <option value="2016" <?php if ($mahasiswa['tahun_angkatan'] == '2016') { ?> selected='' <?php } ?>>2016</option>
                            <option value="2017" <?php if ($mahasiswa['tahun_angkatan'] == '2017') { ?> selected='' <?php } ?>>2017</option>
                            <option value="2018" <?php if ($mahasiswa['tahun_angkatan'] == '2018') { ?> selected='' <?php } ?>>2018</option>
                            <option value="2019" <?php if ($mahasiswa['tahun_angkatan'] == '2019') { ?> selected='' <?php } ?>>2019</option>
                            <option value="2020" <?php if ($mahasiswa['tahun_angkatan'] == '2020') { ?> selected='' <?php } ?>>2020</option>
                            <option value="2021" <?php if ($mahasiswa['tahun_angkatan'] == '2021') { ?> selected='' <?php } ?>>2021</option>
                            <option value="2022" <?php if ($mahasiswa['tahun_angkatan'] == '2022') { ?> selected='' <?php } ?>>2022</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-Mail</label>
                        <input type="email" class="form-control w-50" id="email" value="<?= $mahasiswa['email']; ?>" name="email" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar <i>(Saat ini)</i></label> <br>
                        <img src="img/<?= $mahasiswa['gambar']; ?>" width="50%" style="margin-bottom: 10px;">
                        <input class="form-control form-control-sm w-50" id="gambar" name="gambar" type="file">
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control w-50" id="alamat" rows="5" name="alamat" autocomplete="off"><?= $mahasiswa['alamat']; ?></textarea>
                    </div>
                    <hr>
                    <a href="index.php" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-warning" name="ubah">Ubah</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Close Container -->



    <!-- Footer -->
    <footer class="bg-dark text-white text-center" style="padding: 5px;">
        <p>Created by Muhammad Helmi</p>
    </footer>
    <!-- Close Footer -->

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>

</html>