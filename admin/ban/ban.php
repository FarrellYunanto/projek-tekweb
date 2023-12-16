<?php
    require('../../connect.php');

    if(isset($_POST['id_user'])){
        $id_user = $_POST['id_user'];

        $update_user = "UPDATE `user` SET `status_ban`='-1' WHERE `id_user`=:id_user";
        $update_user = $conn->prepare($update_user);
        $update_user->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $update_user->execute();

        if($update_user->rowCount() > 0){
            header('location: ../banuser.php');
        }
    }
?>