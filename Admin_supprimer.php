<?php
@include 'Config.php';


if( isset($_GET["id"])){
    $id = $_GET["id"];

    $sql = "DELETE FROM etudiant WHERE id='$id'";
    $conn->query($sql);
}


header("location: Admin.php");
exit;
?>