<?php
if (!isset($conn)) {
    include 'api/db.php';
}

$themeResult = mysqli_query($conn, "SELECT theme FROM settings WHERE id=1");
$themeData = mysqli_fetch_assoc($themeResult);
$themeAttr = (isset($themeData['theme']) && $themeData['theme'] === 'Dark') ? 'dark' : 'light';