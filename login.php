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
    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <style>
        .content {
            border: 1px solid #eee6e6;
        }

        .petraBlue{
            color: #03396c;
        }
        .petraBlue-bold{
            font-weight: bold;
            color: #03396c;
        }

        .grid{
            display: grid;
            place-items: center;
        }

        html, body{
            height: 100%;
        }

        .container{
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .row{
            margin-left: 0;
            margin-right: 0;
        }
    </style>
</head>

<body>
    <div class="container h-100">
        <div class="content content center pt-2 pb-2 w-50 rounded-4">
            <div class="row text-center">
                <div class="col-12">
                    <h2 class="petraBlue-bold">LOGIN</h2>
                </div>
                <div class="col-12 pb-2">
                    <label for="" class="float-start" style="font-size: larger;">Email</label>
                    <input type="text" id="email" class="form-control">
                </div>
                <div class="col-12 pb-3">
                    <label for="" class="float-start" style="font-size: larger;">Password</label>
                    <input type="password" id="password" class="form-control">
                </div>
                <div class="col-12 pb-2">
                    <button class="btn float-start" style="font-weight: bold; background-color: #03396c; color: white;" onclick="sendData()">LOGIN</button>
                </div>
                <div class="col-12">
                    <label for="" class="float-start mb-2"><a href="register.php" style="text-decoration: none;" class="petraBlue">Dont have an account?</a></label>
                </div>
            </div>
        </div>
    </div>
    <script>
        function sendData(){
            var email = $(`#email`).val();
            var password = $(`#password`).val();
            var processType = 2;
            var emailType = email.split("@");
            var userType = emailType[1];
            
            var formData = {
                email: email,
                password: password,
                processType: processType,
                emailType: userType
            };

            $.ajax({
                type: "POST",
                url: "process.php",
                data: formData,
                dataType: "json",
                success: (e) => {
                    console.log(e);
                    if (!e.success) {
                        Swal.fire({
                            title: "Failed",
                            text: e.message,
                            icon: "error",
                            button: "OK"
                        });
                    } else if (e.success) {
                        window.location.href = "./home/listRuang.php";
                    }
                }
            });
        }
    </script>

</body>

</html>