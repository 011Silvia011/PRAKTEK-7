<?php

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "buku_tamu";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Membuat tabel buku tamu jika belum ada
$sql = "CREATE TABLE IF NOT EXISTS buku_tamu (
    ID_BT INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Nama VARCHAR(200) NOT NULL,
    email VARCHAR(50) NOT NULL,
    isi TEXT
)";

if (mysqli_query($conn, $sql)) {
    echo "Tabel buku tamu berhasil dibuat ";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

// Memasukkan data buku tamu ke dalam tabel
if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $isi = $_POST['isi'];

    $sql = "INSERT INTO buku_tamu (Nama, email, isi) VALUES ('$nama', '$email', '$isi')";

    if (mysqli_query($conn, $sql)) {
        echo "Data berhasil ditambahkan";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Menampilkan data buku tamu dari tabel
$sql = "SELECT * FROM buku_tamu";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "ID: " . $row["ID_BT"]. " - Nama: " . $row["Nama"]. " - Email: " . $row["email"]. " - Isi: " . $row["isi"]. "<br>";
    }
} else {
    echo "Tidak ada data";
}

// Menutup koneksi
mysqli_close($conn);

?>

<form action="" method="post">
    Nama: <input type="text" name="nama"><br>
    Email: <input type="email" name="email"><br>
    Isi: <textarea name="isi"></textarea><br>
    <input type="submit" name="submit" value="Submit">
</form>
