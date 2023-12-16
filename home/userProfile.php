<?php
require ("fetch.php");
require ("../navbar.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css">
    <style>
        
       
        h1{
            margin-top: 10px;
            color: white;
            margin-bottom: 40px;
        }
        .container {
            
            border-radius: 15px;
            padding: 2% 5%;
            margin-top: 5vh;
            margin-bottom: 5vh;
        }
        .card{
            box-shadow: 0 20px 50px rgba(0,0,0,0.8);
        }
        .btn{
            margin:20px;
        }
        
        img {
            position: absolute;
            width: 1400px;
            margin-top: -80px; /* Adjust this value as needed */
            z-index: -1;
            background-color: rgba(0, 0, 0, 0.5)
        }
        
        input[readonly] {
            background-color: white;
        }

        .heading {
            font-weight : bold; 
            color : #03396c;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
       $(document).ready(function(){
            $("#editBtn").click(function(e){
                e.preventDefault();
                $.get($(this).attr("href"), function(data){
                    $("#result").html(data);
                });
            });
        });
    </script>

</head>

<body>
    
    <!-- <img src="89411343_a2VREmXXg5s0NmqExQLy1is94HFXnAUirg9BTbznnq0 (1).jpg" alt="" > -->
    <div class="container light-style flex-grow-1 container-p-y">
        <h1 class="heading">
            Hello <?= $_SESSION['username']?>
        </h1>
        <a href="updateUser.php" class = "btn btn-dark" id= "editBtn">Edit Button</a>
        
        <div class= "account-container" id = "result">
        <div class="card overflow-hidden" style="border-radius: 15px;">
            <div class="card-header">
                My Account
            </div>
            
            <p style = "padding-left: 20px">This is your profile page. You can make change here.</p>
            <div class="card-body">
                <div class="form-group">
                <label class="form-label">NRP </label>
                    <input type="text" class="form-control mb-1" value="<?= $result['nrp']?>" readonly>
                </div>
                <div class="form-group">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control" value="<?= $result['nama'] ?>" readonly>
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="text" class="form-control mb-1" value= "<?=$result['email']?>" readonly>
                </div>
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control mb-1" value="<?=$result['password']?>" readonly>
                </div>
                <div class="text-right mt-3">
                    <a href="listRuang.php" class = "btn btn-primary" id= "cancelBtn">Back</a>
                </div>
            </div>
            
        </div>
        </div>
        
    </div>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>