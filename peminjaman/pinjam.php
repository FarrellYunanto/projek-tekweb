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
            padding-left: 15px;
            padding-right: 15px;
        }

        .petraBlue {
            color: #03396c;
        }

        .petraBlue-bold {
            font-weight: bold;
            color: #03396c;
        }

        .grid {
            display: grid;
            place-items: center;
        }

        html,
        body {
            height: 100%;
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .row {
            margin-left: 0;
            margin-right: 0;
        }
    </style>
</head>

<body>
    <?php include ("../navbar.php") ?>
    <div class="container h-100 pt-5">
        <div class="content center pt-2 pb-2 w-50 rounded-4 mt-2 ">
            <div class="row text-center">
                <div class="col-12">
                    <h2 class="petraBlue-bold">PINJAM RUANG</h2>
                </div>
                <div class="col-12 pb-2">
                    <label for="" class="float-start" style="font-size: larger;">Kode Ruang</label>
                    <input type="text" id="kodeRuang" class="form-control" value="<?php echo $_GET['kode_ruangan']?>" placeholder="<?php echo $_GET['kode_ruangan']?>" disabled>
                </div>
                <div class="col-12 pb-2">
                    <label for="" class="float-start" style="font-size: larger;">Tanggal</label>
                    <input type="date" id="tanggal" class="form-control" required>
                </div>
                <div class="col-6 pb-2">
                    <label for="" class="float-start" style="font-size: larger;">Mulai</label>
                    <input type="text" id="mulai" class="form-control" placeholder="hhmm" required>
                </div>
                <div class="col-6 pb-2 accordion">
                    <label for="" class="float-start" style="font-size: larger;">Selesai</label>
                    <input type="text" id="selesai" class="form-control" placeholder="hhmm" required>
                </div>
                <div class="">
                    <label id="notice" class="" style="color: red; "></label>
                </div>
                <div class="col-12 pb-3">
                    <label for="" class="float-start" style="font-size: larger;">Acara</label>
                    <input type="text" id="acara" class="form-control" placeholder="Nama acara" required>
                </div>
                <div class="col-12 pb-3">
                    <label for="" class="float-start" style="font-size: larger;">Keterangan</label>
                    <textarea id="keterangan" class="form-control" placeholder="Keterangan" required> </textarea>
                </div>
                <div class="col-12 pb-2">
                    <button class="btn float-start" style="font-weight: bold; background-color: #03396c; color: white;"
                        onclick="sendData()">PINJAM</button>
                </div>
            </div>
        </div>
    </div>

    <script> // supaya tidak bisa pinjam di masa lalu
        $(function () {
            var dtToday = new Date();

            var month = dtToday.getMonth() + 1;
            var day = dtToday.getDate();
            var year = dtToday.getFullYear();
            if (month < 10)
                month = '0' + month.toString();
            if (day < 10)
                day = '0' + day.toString();

            var maxDate = year + '-' + month + '-' + day;

            $('#tanggal').attr('min', maxDate);
        });
    </script>

    <script> //live cek bentrok
        $('#mulai').on('keyup', (event) => {
            var kodeRuang = $(`#kodeRuang`).val();
            var tanggal = $('#tanggal').val();
            var mulai = $(`#mulai`).val();
            var selesai = $(`#selesai`).val();

            var formData = {
                kodeRuang: kodeRuang,
                tanggal: tanggal,
                mulai: mulai,
                selesai: selesai,
            };
            $.ajax({
                type: "POST",
                url: "process.php",
                data: formData,
                dataType: "json",
                success: (e) => {
                    console.log(e);
                    if (!e.success) {
                        if(e.message != "Data tidak lengkap!"){
                            $("#notice").text(e.message);
                        }
                    } else if (e.success) {
                        $("#notice").text("");
                    }
                }
            });
        })

        $('#selesai').on('keyup', (event) => {
            var kodeRuang = $(`#kodeRuang`).val();
            var tanggal = $('#tanggal').val();
            var mulai = $(`#mulai`).val();
            var selesai = $(`#selesai`).val();

            var formData = {
                kodeRuang: kodeRuang,
                tanggal: tanggal,
                mulai: mulai,
                selesai: selesai,
            };
            $.ajax({
                type: "POST",
                url: "process.php",
                data: formData,
                dataType: "json",
                success: (e) => {
                    console.log(e);
                    if (!e.success) {
                        if(e.message != "Data tidak lengkap!"){
                            $("#notice").text(e.message);
                        }
                    } else if (e.success) {
                        $("#notice").text("");
                    }
                }
            });
        })
    </script>

    <script> // buat kirim data
        function sendData() {
            var kodeRuang = $(`#kodeRuang`).val();
            var tanggal = $('#tanggal').val();
            var mulai = $(`#mulai`).val();
            var selesai = $(`#selesai`).val();
            var acara = $(`#acara`).val();
            var keterangan = acara.concat("|", $(`#keterangan`).val());

            var formData = {
                kodeRuang: kodeRuang,
                tanggal: tanggal,
                mulai: mulai,
                selesai: selesai,
                keterangan: keterangan,
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
                        Swal.fire({
                            title: "Berhasil",
                            text: e.message,
                            icon: "success",
                            button: "OK"
                        });
                        $(`#tanggal`).val('dd/mm/yy');
                        $(`#mulai`).val('');
                        $(`#selesai`).val('');
                        $(`#acara`).val('');
                        $(`#keterangan`).val('');
                    }
                }
            });
        }
    </script>

</body>

</html>