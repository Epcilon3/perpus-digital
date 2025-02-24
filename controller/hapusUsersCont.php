<?php
include '../config/conn.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "DELETE FROM user WHERE UserID = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data User berhasil dihapus!'); window.location.href='../ui/users/usersPage.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
