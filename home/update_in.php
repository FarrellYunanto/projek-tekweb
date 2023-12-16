<?php
session_start();
require("../connect.php");
$success = false;
$message = "";
if(isset($_POST['nama'])|| isset($_POST['password'])){
    $nama = $_POST['nama'];
    $password = $_POST['password'];

    $id = $_SESSION['id'];

    if(empty($nama) || empty($password)){
        $message = "Please fill the empty field";
    }else{
        $query = "UPDATE user SET nama = '$nama', password = '$password' WHERE id_user = '$id' ";
        $stmt = $conn->prepare($query);
        
        if($stmt->execute()){
            $success = true;
            $message = "Berhasil di update";
            $_SESSION['username'] = $nama;
        }
        else{
            $message =  "Failed updated";
        }

    }
}
echo json_encode([
    'success' => $success,
    'message' => $message
]);
?>