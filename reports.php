<?php

session_start();

include 'api/db.php';


if(!isset($_SESSION['username'])){

    header("Location: login.php");
    exit();

}


$totalDevices = mysqli_num_rows(
    mysqli_query($conn,"SELECT * FROM devices")
);




$onlineDevices = mysqli_num_rows(
    mysqli_query($conn,"SELECT * FROM devices WHERE status='Online'")
);




$offlineDevices = mysqli_num_rows(
    mysqli_query($conn,"SELECT * FROM devices WHERE status='Offline'")
);





$bandwidthQuery = mysqli_query($conn,
"SELECT SUM(download_speed) AS used FROM bandwidth");


$bandwidthData=mysqli_fetch_assoc($bandwidthQuery);


$usedBandwidth=$bandwidthData['used'] ?? 0;





$totalAlerts=mysqli_num_rows(
    mysqli_query($conn,"SELECT * FROM alerts")
);


?>


<?php include 'includes/theme.php'; ?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="<?php echo $themeAttr; ?>">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Reports</title>
<link rel="stylesheet" href="dist/css/adminlte.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<link rel="stylesheet" href="css/style.css">
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<div class="app-wrapper">
<?php include 'includes/navbar.php'; ?>
<?php include 'includes/sidebar.php'; ?>
<main class="app-main">
<div class="app-content">
<div class="container-fluid">
<div class="content-header mb-3">
<h1><i class="fas fa-file-alt"></i> Reports</h1>
</div>

<div class="row">
<div class="col-lg-3 col-md-6">
<div class="small-box text-bg-primary">
<div class="inner">
<h3><?php echo $totalDevices; ?></h3>
<p>Total Devices</p>
</div>

</div>
</div>

<div class="col-lg-3 col-md-6">
<div class="small-box text-bg-success">
<div class="inner">
<h3><?php echo $onlineDevices; ?></h3>
<p>Online Devices</p>
</div>

</div>
</div>

<div class="col-lg-3 col-md-6">
<div class="small-box text-bg-danger">
<div class="inner">
<h3><?php echo $offlineDevices; ?></h3>
<p>Offline Devices</p>
</div>

</div>
</div>

<div class="col-lg-3 col-md-6">
<div class="small-box text-white bg-warning">
<div class="inner">
<h3><?php echo $totalAlerts; ?></h3>
<p>Total Alerts</p>
</div>

</div>
</div>
</div>

<div class="card mt-4">
<div class="card-header bg-dark text-white">
<h3 class="card-title">Network Report Summary</h3>
</div>

<div class="card-body">
<table class="table table-bordered">
<tr>
<th>Report Item</th>
<th>Value</th>
</tr>
<tr>
<td>Total Bandwidth Usage</td>
<td><?php echo number_format($usedBandwidth,2); ?> Mbps</td>
</tr>
<tr>
<td>Generated Date</td>
<td><?php echo date("Y-m-d H:i:s"); ?></td>
</tr>
<tr>
<td>Report Status</td>
<td><span class="badge bg-success">Generated</span></td>
</tr>
</table>

<button onclick="window.print()" class="btn btn-primary">
<i class="fas fa-print"></i> Print Report
</button>
</div>
</div>

</div>
</div>
</main>
</div>
<script src="dist/js/adminlte.js"></script>
</body>
</html>