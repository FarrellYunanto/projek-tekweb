<?php
session_start();
require("../connect.php");
if(isset($_SESSION['id'])){
    $stmt = $conn->prepare("SELECT * FROM user WHERE id_user = (?)");
    $stmt->execute([$_SESSION['id']]); // Perbaikan: Tambahkan eksekusi
    $result = $stmt->fetch();
}?>