<?php 
require("../connect.php");

//Fetch Data
$db = $conn;
$tableName = "ruangan";
$columns = ['id_ruangan', 'kode_ruangan', 'nama_ruangan', 'kapasitas', 'img_dir'];
$rooms = fetch_ruangan($db, $tableName, $columns); 

function fetch_ruangan($db, $tableName, $columns) {
    if(empty($db)) {
        $msg = "Database Connection Error";
    } elseif (empty($columns) || !is_array($columns)) {
        $msg = "Invalid Columns";
    } elseif (empty($tableName)) {
        $msg = "table name is empty";
    } else {
        $query = "SELECT * FROM $tableName";
        $stmt = $db->query($query);

        if($stmt !== false) {
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($rows) {
                $msg = $rows;
            } else {
                $msg = "No Data Found";
            }
        } else {
            $msg = "DB error";
        }
    }
    return $msg; 
}

function convert_start_end($start, $end){
    $result = [];

    if (strlen($start) > 3) {
        $mulaiSplit = str_split($start, 2);
    } else {
        $hh = substr($start, 0, 1);
        $mm = substr($start, 1);

        $mulaiSplit[0] = $hh;
        $mulaiSplit[1] = $mm;
    }

    if (strlen($end) > 3) {
        $selesaiSplit = str_split($end, 2);
    } else {
        $hh = substr($end, 0, 1);
        $mm = substr($end, 1);

        $selesaiSplit[0] = $hh;
        $selesaiSplit[1] = $mm;
    }

    $result['start'] = implode(":", $mulaiSplit);
    $result['end'] = implode(":", $selesaiSplit);

    return $result;
}

function trim_keterangan($input){ 
    $splitInput = explode("|", $input);
    
    $acara = trim($splitInput[0]); 
    $keterangan = trim($splitInput[1]);  

    return ['acara' => $acara, 'keterangan' => $keterangan];
}

function cari($keyword){
    global $conn;
    $keywordWithoutColon = str_replace(':', '', $keyword);
    $keyword = trim($keywordWithoutColon);
    $query = "SELECT * FROM peminjaman WHERE 
          LOWER(id_ruangan) LIKE LOWER('%$keyword%') OR 
          LOWER(tanggal_peminjaman) LIKE LOWER('%$keyword%') OR 
          CAST(`start` AS CHAR) LIKE '%$keyword%' OR 
          CAST(`end` AS CHAR) LIKE '%$keyword%' OR 
          LOWER(keterangan) LIKE LOWER('%$keyword%')";
    $stmt = $conn->prepare($query);
    $stmt->execute(); // Perbaikan: Tambahkan eksekusi
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result; 
}

?> 