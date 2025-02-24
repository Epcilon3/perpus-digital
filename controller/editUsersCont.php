<?php
include '../config/conn.php';

if (isset($_POST['submit'])) {
    $id = intval($_POST['id']);
    $email = $_POST['email'];
    $nama = $_POST['namalengkap'];
    $alamat = $_POST['alamat'];
    $role = $_POST['role']; // Pastikan role dikirim

    // Jika password diisi, update juga
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sql = "UPDATE user SET Email = ?, NamaLengkap = ?, Alamat = ?, Role = ?, Password = ? WHERE UserID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $email, $nama, $alamat, $role, $password, $id);
    } else {
        $sql = "UPDATE user SET Email = ?, NamaLengkap = ?, Alamat = ?, Role = ? WHERE UserID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $email, $nama, $alamat, $role, $id);
    }

    if ($stmt->execute()) {
        echo "<script>alert('User berhasil diperbarui!'); window.location.href='../ui/users/usersPage.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui user!'); window.location.href='../ui/users/usersPage.php';</script>";
    }
    $stmt->close();
}
?>
