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
                    <h2 class="petraBlue-bold">REGISTER</h2>
                </div>
                <div class="col-12 pb-2">
                    <label for="" class="float-start" style="font-size: larger;">First Name</label>
                    <input type="text" id="firstName" class="form-control" required>
                </div>
                <div class="col-12 pb-2">
                    <label for="" class="float-start" style="font-size: larger;">Email (Petra)</label>
                    <input type="email" id="email" class="form-control" required>
                </div>
                <div class="col-12 pb-2">
                    <label for="" class="float-start" style="font-size: larger;">Username</label>
                    <input type="text" id="username" class="form-control" required>
                </div>
                <div class="col-12 pb-3">
                    <label for="" class="float-start" style="font-size: larger;">Password</label>
                    <input type="password" id="password" class="form-control" required>
                </div>
                <div class="col-12 pb-2">
                    <button class="btn float-start" style="font-weight: bold; background-color: #03396c; color: white;">SIGN UP</button>
                </div>
                <div class="col-12">
                    <label for="" class="float-start mb-2"><a href="login.php" style="text-decoration: none;" class="petraBlue">Already have an account?</a></label>
                </div>
            </div>
        </div>
    </div>

</body>

</html>