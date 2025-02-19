<?php

var_dump($_POST); // Menampilkan semua data POST yang dikirim

session_start();
include '../config/conn.php';

if (isset($_SESSION['Username'])) {
    header("Location: ../loginView.php");
    exit();
}

if (isset($_POST['submit'])) {
    $NamaLengkap = $_POST['NamaLengkap'];
    $Username = $_POST['Username'];
    $Password = hash('sha256', $_POST['Password']);
    $Email = $_POST['Email'];
    $Alamat = $_POST['Alamat'];
    $Role = $_POST['Role'];

    // Cek apakah username sudah ada di database
    $sql = "SELECT * FROM user WHERE username='$Username'";
    $result = mysqli_query($conn, $sql);

    if (!$result->num_rows > 0) {
        // Masukkan data ke dalam tabel user
        $sql = "INSERT INTO user (NamaLengkap, Username, Password, Email,  Alamat, Role) 
                VALUES ('$NamaLengkap','$Username', '$Password', '$Email',  '$Alamat', '$Role')";
                // echo $sql;
        $result = mysqli_query($conn, $sql);

        if ($result) {
            // Registrasi berhasil, arahkan ke halaman login
            header("Location: ../loginView.php?message=Registrasi Berhasil");
            exit();
        } else {
            echo "<script>alert('Terjadi Kesalahan saat melakukan registrasi.')</script>";
        }
    } else {
        echo "<script>alert('Username sudah terdaftar.')</script>";
    }
}
?>