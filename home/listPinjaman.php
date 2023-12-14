<?php
require("../connect.php");
require("process.php");
// Pastikan sesi sudah dimulai

if (true) {
    $id = 1;
    $stmt = $conn->prepare("SELECT * FROM peminjaman WHERE id_user = (?) ORDER BY tanggal_peminjaman");
    $stmt->execute([$id]); // Perbaikan: Tambahkan eksekusi
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
    <?php include("../navbar.php") ?>
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>ID Ruangan</th>
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
                <tr>
                    <td><?= $row['id_ruangan']; ?></td>
                    <td><?= $row['tanggal_peminjaman']; ?></td>
                    <?php $jam = convert_start_end($row['start'], $row['end']);
                    ?>
                    <td><?=  $jam['start']. "-". $jam['end'];?></td>
                    <?php $keterangan = trim_keterangan($row['keterangan']);?>
                    <td><?= $keterangan['acara']?></td>
                    <td><?= $keterangan['keterangan']?></td>
                    <td>
                        <button class="btn btn-primary edit">
                            <a style = "color: white; text-decoration: none"href="editPinjaman.php?id=<?=$row['id_ruangan']?>">Edit</a>
                        </button>
                        <button class="btn btn-danger delete">
                            <a style = "color: white; text-decoration: none"href="deletePinjaman.php?id=<?=$row['id_ruangan']?>">Batalkan Peminjaman</a>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
