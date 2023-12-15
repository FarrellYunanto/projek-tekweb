<?php
require('../connect.php');
$id = $_GET['id_peminjaman'];

try {
    $stmt = $conn->prepare("DELETE FROM peminjaman WHERE id_peminjaman = '$id'");
    $stmt->execute();
  
    Header("Location: listPinjaman.php");
} catch (PDOException $e) {
}
?>