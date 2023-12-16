<?php 
require("../../connect.php");
session_start();
$success = false;
$message = '';
$db = $conn;

// processType 1 = register
if(isset($_POST['processType']) && $_POST['processType'] == 1){
    //cek data tidak boleh ada yang kosong
    if(isset($_POST['nip']) && isset($_POST['nama']) && isset($_POST['password']) && isset($_POST['email']) && !($_POST['nama'] == '' || $_POST['nip'] == '' || $_POST['password'] == '')){
        //cek email sudah terdaftar belum
        $stmt = $conn->prepare(
        "SELECT email
        FROM `admin` 
        WHERE email = \"" . $_POST['email'] . "\"");
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $message = "NIP sudah terdaftar";
        } else {
            //insert account baru
            $sql = "INSERT INTO admin (nip, nama, email, password) VALUES (?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$_POST['nip'], $_POST['nama'], $_POST['email'], $_POST['password']]);
            $success = true;
            $message = "Berhasil membuat akun, silahkan login!";
        }
    } else {
        $message = "Error, data tidak lengkap!";
    }
}

echo json_encode([
    'success' => $success,
    'message' => $message
]);
?>