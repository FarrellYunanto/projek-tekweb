<?php 
require("connect.php");
session_start();
$success = false;
$message = '';
$db = $conn;
// processType 1 = register
if(isset($_POST['processType']) && $_POST['processType'] == 1){
    //cek data tidak boleh ada yang kosong
    if(isset($_POST['nrp']) && isset($_POST['nama']) && isset($_POST['password']) && isset($_POST['email']) && !($_POST['nama'] == '' || $_POST['nrp'] == '' || $_POST['password'] == '')){
        //cek email sudah terdaftar belum
        $stmt = $conn->prepare(
        "SELECT email
        FROM `user` 
        WHERE email = \"" . $_POST['email'] . "\"");
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $message = "NRP sudah terdaftar";
        } else {
            //insert account baru
            $sql = "INSERT INTO user (nrp, password, nama, email, status_ban) VALUES (?,?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$_POST['nrp'], $_POST['password'], $_POST['nama'], $_POST['email'], 1]);
            $success = true;
            $message = "Berhasil membuat akun, silahkan login!";
        }
    } else {
        $message = "Error, data tidak lengkap!";
    }
//processType 2 = login
} else if (isset($_POST['processType']) && $_POST['processType'] == 2){
    //password dan emai ltidak boleh kosong
    if(isset($_POST['password']) && isset($_POST['email'])){
        if ($_POST['emailType'] == "john.petra.ac.id") { // kalau user
            //cek apakah ada yang password dan emailnya cocok
            $stmt = $conn->prepare(
            "SELECT email, password 
            FROM `user` 
            WHERE email = \"" . $_POST['email'] . "\" AND password = \"" . $_POST['password'] . "\"");
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                //ambil data user buat session
                $query = "SELECT " . "id_user, nama, status_ban" . 
                " FROM user
                where email = \"" . $_POST['email'] . "\"";
                $request = $db->query($query);
                $userData = $request->fetch();

                if ($userData['status_ban'] == 1) {
                    $success = true;
                    $_SESSION['id'] = $userData['id_user'];
                    $_SESSION['username'] = $userData['nama'];
                    $_SESSION['user_type'] = "bukanadmin";
                } else {
                    $message = "Akun anda tersuspend mohon hubungi admin!";
                }
            } else {
                $message = "Wrong password or email!";
            }
        } else { // kalau admin
            //cek apakah ada yang password dan emailnya cocok
            $stmt = $conn->prepare(
            "SELECT email, password 
            FROM `admin` 
            WHERE email = \"" . $_POST['email'] . "\" AND password = \"" . $_POST['password'] . "\"");
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                //ambil data user buat session
                $query = "SELECT " . "id_admin, nama" . 
                " FROM admin
                where email = \"" . $_POST['email'] . "\"";
                $request = $db->query($query);
                $userData = $request->fetch();
    
                $success = true;
                $_SESSION['id'] = $userData['id_admin'];
                $_SESSION['username'] = $userData['nama'];
                $_SESSION['user_type'] = "admin";
            } else {
                $message = "Wrong password or email!";
            }
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