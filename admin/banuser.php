<?php
    require('../connect.php');
    include('../navbar.php')
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ADMIN | Pengiriman Resi</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <style>
            .navbar-custom a{
                color : white;
            }
            .navbar-custom a.active{
                color : #ccc!important;
            }
            .content-web{
                border: 1px solid #ccc;
                padding: 25px;
                border-radius: 8px;
            }
            .container {
                display: flex;
                justify-content: space-between;
            }

            #kembali {
                margin-right: 10px;
                background-color: black;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <div class="content-web my-5">
            <div class="container">
                <h3>BAN DATA USERS</h3>
                <button class="btn btn-primary btn-sm" id="kembali" onclick="goToIndexPage()">KEMBALI</button>
                <script>
                function goToIndexPage() {
                window.location.href = "../home/index.php";
                }
                </script>
            </div>
                <?php
                $check_data = "select * from `user` ORDER BY id_user ASC";
                $check_data = $conn->prepare($check_data);
                $check_data->execute();

                if($check_data->rowCount() == 0): ?>
                    <p>Tidak ada data user</p>

                <?php else: ?>
                <br/>
                    <table class="table table-bordered ">
                    <thead class="bg-dark text-white" >
                    <tr>
                        <th scope="col">NRP</th>
                        <th scope="col">PASSWORD</th>
                        <th scope="col">NAMA</th>
                        <th scope="col">EMAIL</th>
                        <th scope="col">STATUS_BAN</th>
                        <th scope="col">BAN ACTION</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php while($data = $check_data->fetch(PDO::FETCH_ASSOC)): ?>
                        <tr>
                        <td><?=$data['nrp']?></td>
                            <td><?=$data['password']?></td>
                            <td><?=$data['nama']?></td>
                            <td><?=$data['email']?></td>
                            <td><?=$data['status_ban']?></td>
                            <td>
                            <?php if($data['status_ban'] == '1'): ?>
                            <form action="./ban/ban.php" method="post">
                                <input type="hidden" name="id_user" value="<?=$data['id_user']?>">
                                <button style="background-color: red" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure you want to ban this user?')">BAN USER</button>
                            </form>
                            <?php elseif($data['status_ban'] == '-1'): ?>
                            <form action="./ban/unban.php" method="post">
                                <input type="hidden" name="id_user" value="<?=$data['id_user']?>">
                                <button class="btn btn-primary btn-sm" onclick="return confirm('Are you sure you want to un-ban this user?')">UN-BAN USER</button>
                            </form>
                            <?php endif; ?>
                            </td>
                        </tr>   
                        <?php endwhile; ?>
                    </tbody>
                    </table>
                <?php endif ?>    
            </div>
        </div>
    </body>
</html>

