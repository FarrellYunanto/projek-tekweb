<?php 
require ("fetch.php");
?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    span{
            display: inline;
            margin-left: 5px;
            font-style: italic;
            color: red;
        }
</style>
<div class= "account-container" >
        <div class="card overflow-hidden" style="border-radius: 15px;">
            <div class="card-header">
                My Account
            </div>
            
            <p style = "padding-left: 20px">This is your profile page. You can make change here.</p>
            <div id = "dispMsg"></div>
            <form id = "myForm">
            <div class="card-body">
                <div class="form-group">
                <label for = "nrp"class="form-label">NRP <span>(not editable)</span></label>
                    <input id = "nrp"type="text" class="form-control mb-1" value="<?= $result['nrp']?>" readonly>
                </div>
                <div class="form-group">
                    <label for = "nama" class="form-label">Nama</label>
                    <input id = "nama"type="text" class="form-control" value="<?= $result['nama']?>" >
                </div>
                <div class="form-group">
                    <label for = "email"class="form-label">Email<span>(not editable)</span></label>
                    <input id = "email"type="text" class="form-control mb-1" value= "<?=$result['email']?>" readonly>
                </div>
                <div class="form-group">
                    <label for = "password" class="form-label">Password</label>
                    <input id  ="password"type="password" class="form-control mb-1" value="<?=$result['password']?>">
                </div>
            </div>
            </form>
            <div class="text-right mt-3">
                <button type="submit" class="btn btn-primary" onclick ="updateData()" >Save changes</button>&nbsp;
                
                <button type="button" class="btn btn-default" id = "cancelBtn">Cancel</button>
            </div>
        </div>
        </div>
        <script>
                    function updateData() {
                    var nama = $("#nama").val();
                    var password = $("#password").val();

                    var formData = {
                        nama: nama,
                        password: password
                    };

                    $.ajax({
                        url: "update_in.php",
                        type: "POST",
                        dataType: "json",
                        data: formData,
                        success: function(data) {
                            console.log(data);
                            if (!data.success) {
                                Swal.fire({
                                    title: "Failed",
                                    text: data.message,
                                    icon: "error",
                                    confirmButtonText: "OK"
                                });
                            } else if (data.success) {
                                Swal.fire({
                                    title: "Berhasil",
                                    text: data.message,
                                    icon: "success",
                                    confirmButtonText: "OK"
                                }).then(() => {
                                    // Redirect to userProfile.php
                                    window.location.href = "userProfile.php";
                                });
                                $("#nama").val('');
                                $("#password").val('');
                            }
                        }
                    });
                }
            $(document).ready(function() {
                $("#cancelBtn").click(function(e) {
                    e.preventDefault();
                    // Redirect to userProfile.php
                    window.location.href = "userProfile.php";
                });

                function updateData() {
                    var nama = $("#nama").val();
                    var password = $("#password").val();

                    var formData = {
                        nama: nama,
                        password: password
                    };

                    $.ajax({
                        url: "update_in.php",
                        type: "POST",
                        dataType: "json",
                        data: formData,
                        success: function(data) {
                            console.log(data);
                            if (!data.success) {
                                Swal.fire({
                                    title: "Failed",
                                    text: data.message,
                                    icon: "error",
                                    confirmButtonText: "OK"
                                });
                            } else if (data.success) {
                                Swal.fire({
                                    title: "Berhasil",
                                    text: data.message,
                                    icon: "success",
                                    confirmButtonText: "OK"
                                }).then(() => {
                                    // Redirect to userProfile.php
                                    window.location.href = "userProfile.php";
                                });
                                $("#nama").val('');
                                $("#password").val('');
                            }
                        }
                    });
                }
            });
        </script>
