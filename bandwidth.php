<?php

session_start();

include 'api/db.php';

$query = mysqli_query($conn,"SELECT * FROM bandwidth");

$totalBandwidth = 100;
$usedBandwidth = 0;

while($row = mysqli_fetch_assoc($query)){
    $usedBandwidth += $row['download_speed'];
}

$availableBandwidth = $totalBandwidth - $usedBandwidth;

?>

<?php include 'includes/theme.php'; ?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="<?php echo $themeAttr; ?>">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Bandwidth Monitoring</title>

<link rel="stylesheet" href="dist/css/adminlte.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<link rel="stylesheet" href="css/style.css">

</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">

<div class="app-wrapper">

<?php include 'includes/navbar.php'; ?>

<?php include 'includes/sidebar.php'; ?>

<main class="app-main">

<div class="app-content">


<section class="content-header">

<div class="container-fluid">

<h1><i class="fas fa-tachometer-alt me-2"></i>Bandwidth Monitoring</h1>

</div>

</section>


<section class="content">

<div class="container-fluid">


<div class="row">


<div class="col-lg-4 col-md-6">

<div class="small-box text-bg-primary">

<div class="inner">

<h3>
<?php echo $totalBandwidth; ?> Mbps
</h3>

<p>Total Bandwidth</p>

</div>



</div>

</div>


<div class="col-lg-4 col-md-6">

<div class="small-box text-bg-danger">

<div class="inner">

<h3>
<?php echo number_format($usedBandwidth,2); ?> Mbps
</h3>

<p>Used Bandwidth</p>

</div>



</div>

</div>


<div class="col-lg-4 col-md-6">

<div class="small-box text-bg-success">

<div class="inner">

<h3>
<?php echo number_format($availableBandwidth,2); ?> Mbps
</h3>

<p>Available Bandwidth</p>

</div>



</div>

</div>


</div>

<div class="card mt-4">

<div class="card-header bg-dark text-white">

<h3>
Device Bandwidth Usage
</h3>

</div>

<div class="card-body">

<table class="table table-bordered table-striped">

<tr>

<th>Device</th>
<th>Upload</th>
<th>Download</th>
<th>Usage</th>
<th>Status</th>

</tr>

<?php

$result = mysqli_query($conn,"SELECT * FROM bandwidth");

while($device=mysqli_fetch_assoc($result)){

?>

<tr>

<td><?php echo $device['device_name']; ?></td>

<td><?php echo $device['upload_speed']; ?> Mbps</td>

<td><?php echo $device['download_speed']; ?> Mbps</td>

<td><?php echo $device['usage_percent']; ?>%</td>

<td>

<?php

if($device['status']=="High")
{
echo "<span class='badge bg-danger'>High</span>";
}
else
{
echo "<span class='badge bg-success'>Normal</span>";
}

?>

</td>

</tr>

<?php } ?>

</table>

</div>

</div>

</div>

</section>

</div>

</main>

</div>

<?php include 'includes/footer.php'; ?>

</body>

</html>