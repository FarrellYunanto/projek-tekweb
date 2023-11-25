<?php 
require("connect.php");
$success = false;
$message = '';
if(isset($_POST['processType']) && $_POST['processType'] == 1){
    if(isset($_POST['nrp']) && isset($_POST['nama']) && isset($_POST['password']) && isset($_POST['email'])){
        $sql = "INSERT INTO user (nrp, password, nama, email) VALUES (?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$_POST['nrp'], $_POST['password'], $_POST['nama'], $_POST['email']]);
        $success = true;
        $message = "Berhasil membuat akun, silahkan login!";
    } else {
        $message = "Error, data tidak lengkap!";
    }
} else if (isset($_POST['processType']) && $_POST['processType'] == 2){
    if(isset($_POST['password']) && isset($_POST['email'])){
        $stmt = $conn->prepare(
        "SELECT email, password 
        FROM `user` 
        WHERE email = \"" . $_POST['email'] . "\" AND password = \"" . $_POST['password'] . "\"");
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $success = true;
            // header("Location: ./home/listRuang.php");
        } else {
            $message = "Wrong password or email!";
        }
    } else {
        $message = "Error, data tidak lengkap!";
    }
} else {
    $message = 'Error mengirim data!';
}


echo json_encode([
    'success' => $success,
    'message' => $message
]);
?>