<?php
require("../connect.php");
$db = $conn;
$success = false;
$message = '';

if (isset($_POST['kodeRuang']) && isset($_POST['tanggal']) && isset($_POST['mulai']) && isset($_POST['selesai']) && isset($_POST['keterangan'])
&& $_POST['kodeRuang'] != '' && $_POST['tanggal'] != '' && $_POST['mulai'] != '' && $_POST['selesai'] != '' && $_POST['keterangan'] != '') {
    
    //fetch id ruangan
    $query = 
    "SELECT " . "id_ruangan" . 
    " FROM ruangan
    where kode_ruangan = \"" . $_POST['kodeRuang'] . "\"";
    
    $stmt = $db->query($query);
    $kode = ($stmt->fetch());
    $id_ruangan = $kode['id_ruangan'];
    
    //insert data
    $sql = "INSERT INTO peminjaman (id_ruangan, id_user, tanggal_peminjaman, start, end, keterangan) VALUES (?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_ruangan,1, $_POST['tanggal'], $_POST['mulai'], $_POST['selesai'], $_POST['keterangan']]);
    $success = true;
    $message = "Berhasil membuat akun, silahkan login!";

} else {
    $message = 'Data tidak lengkap!';
}

echo json_encode([
    'success' => $success,
    'message' => $message
]);
?>