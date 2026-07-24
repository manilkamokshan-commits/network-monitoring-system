<?php

include 'api/db.php';


$id=$_GET['id'];


mysqli_query($conn,
"DELETE FROM alerts WHERE id=$id");


header("Location: alerts.php");


?>