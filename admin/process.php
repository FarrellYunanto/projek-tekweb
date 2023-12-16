<?php 
require("../connect.php");
$success = false;
$message = '';
// processType 1 = register
if(isset($_POST['processType']) && $_POST['processType'] == "addRuangan"){
    //cek data tidak boleh ada yang kosong
    if(isset($_POST['kodeRuang']) && isset($_POST['namaRuang']) && isset($_POST['kapasitas']) && isset($_FILES['img']) && !($_POST['kodeRuang'] == '' || $_POST['namaRuang'] == '' || $_POST['kapasitas'] == '')){
        //cek kode ruangan sudah terdaftar atau belum
        $stmt = $conn->prepare(
        "SELECT kode_ruangan
        FROM `ruangan` 
        WHERE kode_ruangan = \"" . $_POST['kodeRuang'] . "\"");
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $message = "Ruangan sudah terdaftar";
        } else {
            //insert image
            $targetDir = '../img/';
            $namafile = basename($_FILES['img']['name']);
            $targetFile = $targetDir . basename($_FILES['img']['name']);
            move_uploaded_file($_FILES['img']['tmp_name'], $targetFile);

            //insert ruangan baru
            $sql = "INSERT INTO ruangan (kode_ruangan, nama_ruangan, kapasitas, img_dir) VALUES (?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$_POST['kodeRuang'], $_POST['namaRuang'], $_POST['kapasitas'], $namafile]);
            $success = true;
            $message = "Berhasil menambahkan ruangan!";
        }
    } else {
        $message = "Error, data tidak lengkap!";
    }
}
else if(isset($_POST['processType']) && $_POST['processType'] == "editRuangan"){
    //cek data tidak boleh ada yang kosong
    if(isset($_POST['kodeRuang']) && isset($_POST['namaRuang']) && isset($_POST['kapasitas']) && isset($_FILES['img']) && !($_POST['kodeRuang'] == '' || $_POST['namaRuang'] == '' || $_POST['kapasitas'] == '')){
        $kodeRuang = $_POST['kodeRuang'];
        $namaRuangan = $_POST['namaRuang'];
        $kapasitas = $_POST['kapasitas'];

        //insert image
        $targetDir = '../img/';
        $namafile = basename($_FILES['img']['name']);
        $targetFile = $targetDir . basename($_FILES['img']['name']);
        move_uploaded_file($_FILES['img']['tmp_name'], $targetFile);

        $stmt = $conn->prepare(
        "UPDATE `ruangan`
        SET  `nama_ruangan` = '$namaRuangan', `kapasitas` = '$kapasitas', `img_dir` = '$namafile'
        WHERE kode_ruangan = \"" . $kodeRuang . "\"");
        $stmt->execute();
        $success = true;
        $message = "Berhasil mengedit ruangan";
    } else {
        $message = "Error, data tidak lengkap!";
    }
}
echo json_encode([
    'success' => $success,
    'message' => $message
]);
?>