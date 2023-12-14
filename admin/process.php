<?php 
require("../connect.php");
$success = false;
$message = '';
// processType 1 = register
if(isset($_POST['processType']) && $_POST['processType'] == "addRuangan"){
    //cek data tidak boleh ada yang kosong
    if(isset($_POST['kodeRuang']) && isset($_POST['namaRuang']) && isset($_POST['kapasitas']) && isset($_POST['img']) && !($_POST['kodeRuang'] == '' || $_POST['namaRuang'] == '' || $_POST['kapasitas'] == '')){
        //cek email sudah terdaftar belum
        $stmt = $conn->prepare(
        "SELECT kode_ruangan
        FROM `ruangan` 
        WHERE kode_ruangan = \"" . $_POST['kodeRuang'] . "\"");
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $message = "Ruangan sudah terdaftar";
        } else {
            //insert account baru
            $sql = "INSERT INTO ruangan (kode_ruangan, nama_ruangan, kapasitas, img_dir) VALUES (?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$_POST['kodeRuang'], $_POST['namaRuang'], $_POST['kapasitas'], $_POST['img']]);
            $success = true;
            $message = "Berhasil menambahkan ruangan!";
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