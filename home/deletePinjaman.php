<?php
require('../connect.php');
$id = $_GET['id'];

try {
    $stmt = $conn->prepare("DELETE FROM pinjaman WHERE id = '$id'");
    $stmt->execute();
    
    Header("Location: listPinjaman.php");
} catch (PDOException $e) {
}
?>