<?php
require("../connect.php");
session_start();
$db = $conn;
$success = false;
$message = '';
$bentrok = false;

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

    //cek jam tabrakan
    $query = "SELECT " . "start, end" . 
    " FROM peminjaman
    where id_ruangan = \"" . $id_ruangan . "\" 
    AND tanggal_peminjaman = \"" . $_POST['tanggal'] . "\"";
    $stmt = $db->query($query);
    $listPinjam = $stmt->fetchAll();

    //cek format jam
    $mulaiFormat = strlen($_POST['mulai']);
    $selesaiFormat = strlen($_POST['selesai']);

    if ($_POST['mulai'] < 830 || $_POST['selesai'] < 830 || $_POST['mulai'] >  1930 || $_POST['selesai'] > 2030) {
        $rangeWaktu = false;
    } else {

        $rangeWaktu = true;

        $waktuMulai = $_POST['mulai'];
        $waktuSelesai = $_POST['selesai'];

        $menitMulai = substr($waktuMulai, -2);
        $menitSelesai = substr($waktuSelesai, -2);
        
        if ($menitMulai > 59 || $menitSelesai > 59) {
            $rangeWaktu = false;
            $message = "menit tidak bisa melebihi 59!";
        }
    }
    if ($mulaiFormat >= 3 && $mulaiFormat <= 4 && $selesaiFormat >= 3 && $selesaiFormat <= 4 && $rangeWaktu == true) {
        foreach ($listPinjam as $pinjam) {
            if ($_POST['mulai'] >= $pinjam['start'] && $_POST['mulai'] < $pinjam['end']) { //buat cek bentrok jam mulai

                if(strlen($pinjam['start']) > 3){
                    $mulaiSplit = str_split($pinjam['start'], 2);
                } else {
                    $hh = substr($pinjam['start'], 0, 1); // Get the first character
                    $mm = substr($pinjam['start'], 1);

                    $mulaiSplit[0] = $hh;
                    $mulaiSplit[1] = $mm;
                }

                if(strlen($pinjam['end']) > 3){
                    $selesaiSplit = str_split($pinjam['end'], 2);
                } else {
                    $hh = substr($pinjam['end'], 0, 1); // Get the first character
                    $mm = substr($pinjam['end'], 1);

                    $selesaiSplit[0] = $hh;
                    $selesaiSplit[1] = $mm;
                }
            
                $message = "Peminjaman bertabrakan dengan peminjaman di jam " . $mulaiSplit[0] . ":" . $mulaiSplit[1] 
                . "-" . $selesaiSplit[0] . ":" . $selesaiSplit[1];
                $bentrok = true;
                break;
            }
    
            if ($_POST['selesai'] >= $pinjam['start'] && $_POST['selesai'] < $pinjam['end']) { //buat cek bentrok jam selesai

                if(strlen($pinjam['start']) > 3){
                    $mulaiSplit = str_split($pinjam['start'], 2);
                } else {
                    $hh = substr($pinjam['start'], 0, 1); // Get the first character
                    $mm = substr($pinjam['start'], 1);

                    $mulaiSplit[0] = $hh;
                    $mulaiSplit[1] = $mm;
                }

                if(strlen($pinjam['end']) > 3){
                    $selesaiSplit = str_split($pinjam['end'], 2);
                } else {
                    $hh = substr($pinjam['end'], 0, 1); // Get the first character
                    $mm = substr($pinjam['end'], 1);

                    $selesaiSplit[0] = $hh;
                    $selesaiSplit[1] = $mm;
                }
            
                $message = "Peminjaman bertabrakan dengan peminjaman di jam " . $mulaiSplit[0] . ":" . $mulaiSplit[1] 
                . "-" . $selesaiSplit[0] . ":" . $selesaiSplit[1];
                $bentrok = true;
                break;
            }
        }

        //insert data
        if (!$bentrok) {   // insert jika tidak dabrakan
            if ($_SESSION['user_type'] == 'admin') {
                $sql = "INSERT INTO peminjaman (id_ruangan, id_admin, tanggal_peminjaman, start, end, keterangan) VALUES (?,?,?,?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$id_ruangan,$_SESSION['id'], $_POST['tanggal'], $_POST['mulai'], $_POST['selesai'], $_POST['keterangan']]);
                $success = true;
                $message = "Berhasil membuat peminjaman!";
            } else {                
                $sql = "INSERT INTO peminjaman (id_ruangan, id_user, tanggal_peminjaman, start, end, keterangan) VALUES (?,?,?,?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$id_ruangan,$_SESSION['id'], $_POST['tanggal'], $_POST['mulai'], $_POST['selesai'], $_POST['keterangan']]);
                $success = true;
                $message = "Berhasil membuat peminjaman!";
            }
        }
    } else{
        if($message == ''){
            $message = "Ruangan dapat dipinjam mulai jam 8:30 sampai 20:30!";
        }
    }


} //live bentrok cek
elseif (isset($_POST['kodeRuang']) && isset($_POST['tanggal']) && isset($_POST['mulai']) && isset($_POST['selesai'])
&& $_POST['kodeRuang'] != '' && $_POST['tanggal'] != '' && $_POST['mulai'] != '' && $_POST['selesai'] != '') {

//fetch id ruangan
$query = 
"SELECT " . "id_ruangan" . 
" FROM ruangan
where kode_ruangan = \"" . $_POST['kodeRuang'] . "\"";

$stmt = $db->query($query);
$kode = ($stmt->fetch());
$id_ruangan = $kode['id_ruangan'];

//cek jam tabrakan
$query = "SELECT " . "start, end" . 
" FROM peminjaman
where id_ruangan = \"" . $id_ruangan . "\" 
AND tanggal_peminjaman = \"" . $_POST['tanggal'] . "\"";
$stmt = $db->query($query);
$listPinjam = $stmt->fetchAll();

//cek format jam
$mulaiFormat = strlen($_POST['mulai']);
$selesaiFormat = strlen($_POST['selesai']);
if ($mulaiFormat >= 3 && $mulaiFormat <= 4 && $selesaiFormat >= 3 && $selesaiFormat <= 4) {
    foreach ($listPinjam as $pinjam) {
        if ($_POST['mulai'] >= $pinjam['start'] && $_POST['mulai'] < $pinjam['end']) { //buat cek bentrok jam mulai

            if(strlen($pinjam['start']) > 3){
                $mulaiSplit = str_split($pinjam['start'], 2);
            } else {
                $hh = substr($pinjam['start'], 0, 1); // Get the first character
                $mm = substr($pinjam['start'], 1);

                $mulaiSplit[0] = $hh;
                $mulaiSplit[1] = $mm;
            }

            if(strlen($pinjam['end']) > 3){
                $selesaiSplit = str_split($pinjam['end'], 2);
            } else {
                $hh = substr($pinjam['end'], 0, 1); // Get the first character
                $mm = substr($pinjam['end'], 1);

                $selesaiSplit[0] = $hh;
                $selesaiSplit[1] = $mm;
            }
        
            $message = "Jam " . $mulaiSplit[0] . ":" . $mulaiSplit[1] 
            . "-" . $selesaiSplit[0] . ":" . $selesaiSplit[1] . " tidak tersedia!";
            $bentrok = true;
            break;
        }

        if ($_POST['selesai'] >= $pinjam['start'] && $_POST['selesai'] < $pinjam['end']) { //buat cek bentrok jam selesai

            if(strlen($pinjam['start']) > 3){
                $mulaiSplit = str_split($pinjam['start'], 2);
            } else {
                $hh = substr($pinjam['start'], 0, 1); // Get the first character
                $mm = substr($pinjam['start'], 1);

                $mulaiSplit[0] = $hh;
                $mulaiSplit[1] = $mm;
            }

            if(strlen($pinjam['end']) > 3){
                $selesaiSplit = str_split($pinjam['end'], 2);
            } else {
                $hh = substr($pinjam['end'], 0, 1); // Get the first character
                $mm = substr($pinjam['end'], 1);

                $selesaiSplit[0] = $hh;
                $selesaiSplit[1] = $mm;
            }
        
            $message = "Jam " . $mulaiSplit[0] . ":" . $mulaiSplit[1] 
            . "-" . $selesaiSplit[0] . ":" . $selesaiSplit[1] . " tidak tersedia!";
            $bentrok = true;
            break;
        }
    }
}

if(!$bentrok){
    $success = true;
}
} else {
    $message = 'Data tidak lengkap!';
}

// return message and success
echo json_encode([
    'success' => $success,
    'message' => $message
]);
?>