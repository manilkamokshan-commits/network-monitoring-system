<?php
include 'api/db.php';

if(isset($_GET['id']))
{
    $id = $_GET['id'];

    mysqli_query($conn, "DELETE FROM devices WHERE id=$id");

    header("Location: devices.php");
    exit();
}
?>