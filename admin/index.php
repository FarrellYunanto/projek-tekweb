<?php
ini_set("display_errors", 1);
require "peminjaman.php";
include("../navbar.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>My Bootstrap Website</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-12 d-flex flex-row justify-content-between">
                <h1>List Peminjaman Ruangan</h1>
                <span class="d-flex align-items-center">
                <button class=" btn btn-primary" id = "btn_getPeminjaman">Tampilkan List</button>&nbsp;
                    </span>
            </div>
            <div class="col-12">
                <p><?php if (isset($_SESSION['msg'])) {
                        echo $_SESSION['msg'];
                        $_SESSION['msg'] = null;
                    } ?></p>
                <table class="table table-bordered" id = "tbl_peminjaman">
                    <thead>
                        <tr>
                            <th>Id Peminjaman</th>
                            <th>Id Ruangan</th>
                            <th>Id User</th>
                            <th>Id Admin</th>
                            <th>Tanggal</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Acara</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

<?php require "listPeminjaman.php"; ?>