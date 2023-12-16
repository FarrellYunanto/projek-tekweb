<?php
include("../connect.php");
include("../navbar.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <script>
        $(document).ready(function () {
            $("#adminForm").submit(function (event) {
                event.preventDefault(); // Prevent the default form submission
                sendData(); // Call your function to handle the form submission
            });

            // Toggle password visibility
            $("#add").click(function () {
                if ($("#password").attr("type") === "password") {
                    $("#password").attr("type", "text");
                } else if ($("#password").attr("type") === "text") {
                    $("#password").attr("type", "password");
                }
                if ($("#add").attr("class") === "bi bi-eye-slash") {
                    $("#add").attr("class", "bi bi-eye");
                } else if ($("#add").attr("class") === "bi bi-eye") {
                    $("#add").attr("class", "bi bi-eye-slash");
                }
            });
        });

        function sendData() {
            var nip = $("#nip").val();
            var nama = $("#nama").val();
            var password = $("#password").val();
            var email = nip.concat("@peter.petra.ac.id");
            var processType = 1;

            var formData = {
                nip: nip,
                nama: nama,
                password: password,
                email: email,
                processType: processType,
            };

            $.ajax({
                type: "POST",
                url: "./registerAdmin/process.php",
                data: formData,
                dataType: "json",
                success: function (e) {
                    console.log(e);
                    if (!e.success) {
                        Swal.fire({
                            title: "Failed",
                            text: e.message,
                            icon: "error",
                            button: "OK",
                        });
                    } else if (e.success) {
                        Swal.fire({
                            title: "Berhasil",
                            text: e.message,
                            icon: "success",
                            button: "OK",
                        });
                        location.reload();
                    }
                },
            });

            // Clear input fields after sending data
            $("#nip").val("");
            $("#nama").val("");
            $("#password").val("");
        }
    </script>
    <title>Document</title>
    <style>
        .container {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .content {
            border: 1px solid #eee6e6;
            width: 50%;
            padding: 20px;
            border-radius: 8px;
        }

        .form-label {
            font-size: larger;
        }

        .form-control {
            margin-bottom: 10px;
        }

        .btn-dark {
            font-weight: bold;
            background-color: #03396c;
            color: white;
        }

        .mt-3 {
            margin-top: 3rem;
        }

        .table-bordered {
            margin-top: 3rem;
        }

        .petraBlue-bold {
            font-weight: bold;
            color: #03396c;
            text : center;
        }
    </style>
</head>

<body>
    <div class="container mx-auto border rounded">
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="petraBlue-bold mt-4 mb-4">REGISTER ADMIN</h2>
            </div>
            <!-- Form add user_admin -->
            <form id="adminForm">
                <div class="col-12">
                    <div class="col-7">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" id="nama">
                        <?php
                            if (isset($_POST["tambah"])) {
                                $nama = $_POST["nama"];
                                if (empty($nama)) {
                                    echo "<p><span class = text-danger>* </span>Please fill the name</p>";
                                }
                            }
                        ?>
                    </div>

                    <div class="col-7">
                        <label for="nip" class="form-label">NIP</label>
                        <input type="text" name="nip" class="form-control" id="nip">
                        <?php
                            if (isset($_POST["tambah"])) {
                                $nip = $_POST["nip"];
                                if (empty($nip)) {
                                    echo "<p><span class = text-danger>* </span>Please fill the nip</p>";
                                }
                            }
                        ?>
                    </div>

                    <div class="col-7">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <div class="input-group-text"> <i class="bi bi-eye-slash" id="add"></i></div>
                            <input type="password" name="password" class="form-control" id="password">
                        </div>
                        <?php
                            if (isset($_POST["tambah"])) {
                                $password = $_POST["password"];
                                if (empty($password)) {
                                    echo "<p><span class = text-danger>* </span>Please fill the password</p> <br>";
                                }
                            }
                        ?>
                    </div>

                    <div class="my-2">
                        <button type="submit" class="btn btn-dark" name="tambah">Tambah</button>
                    </div>
                </div>
            </form>            
        
        <!-- ini tabel -->
        <div class="mt-3">
            <div>
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">NIP</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM admin";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();

                        $registrants = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if ($registrants) {
                            foreach ($registrants as $row) :
                                ?>
                                <tr>
                                    <td><?= $row["id_admin"] ?></td>
                                    <td><?= $row["nip"] ?></td>
                                    <td><?= $row["nama"] ?></td>
                                    <td><?= $row["email"] ?></td>
                                </tr>
                            <?php
                            endforeach;
                        } else {
                            echo "<tr><td colspan='3'>No data</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
