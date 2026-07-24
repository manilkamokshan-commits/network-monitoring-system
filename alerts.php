<?php
session_start();
include 'api/db.php';
if(!isset($_SESSION['username'])){header("Location: login.php");exit();}
$query="SELECT * FROM alerts ORDER BY created_at DESC";
$result=mysqli_query($conn,$query);
?>
<?php include 'includes/theme.php'; ?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="<?php echo $themeAttr; ?>">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Alerts</title>
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
<h1><i class="fas fa-bell"></i> Alerts</h1>
</div>
<div class="card">
<div class="card-header bg-dark text-white">
<h3 class="card-title">Alert History</h3>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered table-striped">
<thead>
<tr>
<th>ID</th>
<th>Type</th>
<th>Device</th>
<th>Message</th>
<th>Severity</th>
<th>Status</th>
<th>Date</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php while($row=mysqli_fetch_assoc($result)){ ?>
<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['alert_type']; ?></td>
<td><?php echo $row['device_name']; ?></td>
<td><?php echo $row['message']; ?></td>
<td><?php if($row['severity']=="High"){echo "<span class='badge bg-danger'>High</span>";}elseif($row['severity']=="Medium"){echo "<span class='badge bg-warning'>Medium</span>";}else{echo "<span class='badge bg-success'>Low</span>";} ?></td>
<td><?php echo $row['status']; ?></td>
<td><?php echo $row['created_at']; ?></td>
<td><a href="delete_alert.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</main>
</div>
<script src="dist/js/adminlte.js"></script>
</body>
</html>