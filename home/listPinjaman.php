<?php
require("../connect.php");
require("process.php");
// Pastikan sesi sudah dimulai
session_start();
if (true) {
    $stmt = $conn->prepare("SELECT * FROM peminjaman WHERE id_user = (?) ORDER BY tanggal_peminjaman");
    $stmt->execute([$_SESSION['id']]); // Perbaikan: Tambahkan eksekusi
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Pastikan jQuery dimuat sebelum DataTables -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready( function(){
            $('#myTable').DataTable({
                "pageLength": 8,
                "scrollY": "250px",
                "lengthChange": false,
            });
            
        });
    </script>
</head>
<body>
    <?php 
        include("../navbar.php");
    ?>
    <div class="container pt-5">
    <table id="myTable" class="table">
        <thead>
            <tr>
                <th>Kode Ruangan</th>
                <th>Tanggal Peminjaman</th>
                <th>Start-End</th>
                <th>Acara</th>
                <th>Keterangan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Isi tabel dengan data dari $result -->
            <?php foreach ($result as $row): ?>
                <?php
                #fetch kode_ruangan
                $meh = $row['id_ruangan'];
                $fetchKodeRwangan = "SELECT " . "kode_ruangan" . 
                " FROM ruangan
                where id_ruangan = \"" . $meh . "\"";
                
                $stmt = $db->query($fetchKodeRwangan);
                $meh = ($stmt->fetch());
                $kode_ruangan = $meh['kode_ruangan'];
                ?> 
                <tr>
                    <td><?= $kode_ruangan; ?></td>
                    <td><?= $row['tanggal_peminjaman']; ?></td>
                    <?php $jam = convert_start_end($row['start'], $row['end']);
                    ?>
                    <td><?=  $jam['start']. "-". $jam['end'];?></td>
                    <?php $keterangan = trim_keterangan($row['keterangan']);?>
                    <td><?= $keterangan['acara']?></td>
                    <td><?= $keterangan['keterangan']?></td>
                    <td>
                    <a href="deletePinjaman.php?id_peminjaman=<?php echo $row['id_peminjaman'];?>" class="btn btn-danger">Batalkan Peminjaman</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</body>
</html>
