<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myDB";

// Membuat koneksi
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Memeriksa koneksi
if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

// membuat tabel
$sql = "INSERT INTO liga(kode, negara, champion) VALUES (`Jer`, `Jerman`, 4), (`Spa`, `Spanyol`, 3), (`Eng`, `English`, 3)";

if (mysqli_query($conn, $sql)) {
    echo "New record created succesfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// menutup koneksi ke database
mysqli_close($conn);
?>




