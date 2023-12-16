<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    if (!isset($_SESSION['username']) || $_SESSION['username'] == "") {
        header("Location: ../login.php");
        exit; 
    } 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</head>

<style>
    body {
        margin: 0;
        padding: 0; 
    }

    .navbar {
        background-color: #03396c !important;
    }

    .navbar-brand {
        font-weight: bold; 
        color: white !important;
    }

    .navbar-toggler-icon {
        background-color: #ffffff !important;
    }
</style>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
        <a class="navbar-brand" href="../home/userProfile.php">PinjamRuangan | Welcome, <?php echo $_SESSION['username'];?></a>';
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white" aria-current="page" href="../home/listRuang.php">Daftar Ruangan</a>
                    </li>
                    <!--Cek Hak akses--> 
                    <?php 
                    if ($_SESSION['user_type'] == 'admin') {
                    echo'<li class="nav-item">
                            <a class="nav-link text-white" href="../admin/index.php">Daftar Peminjaman Admin</a>
                        </li>';
                    echo'<li class="nav-item">
                            <a class="nav-link text-white" href="../admin/addRuangan.php">Add Ruangan</a>
                        </li>';
                    echo'<li class="nav-item">
                            <a class="nav-link text-white" href="../admin/addAdmin.php">Add Admin</a>
                        </li>';
                    echo'<li class="nav-item">
                            <a class="nav-link text-white" href="../admin/banuser.php">Ban User</a>
                        </li>';
                    } else {
                    echo '<li class="nav-item">
                        <a class="nav-link text-white" href="../home/listPinjaman.php">Daftar Peminjaman Pribadi</a> 
                    </li>';
                    }
                    ?>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="../logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</body>

</html>
