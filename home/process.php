<?php 
require("../connect.php");

$db = $conn;
$tableName = "ruangan";
$columns = ['id_ruangan', 'kode_ruangan', 'nama_ruangan', 'kapasitas'];
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

?> 