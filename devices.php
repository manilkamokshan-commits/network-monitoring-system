<?php
session_start();
include 'api/db.php';
?>

<?php include 'includes/theme.php'; ?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="<?php echo $themeAttr; ?>">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Devices</title>

<link rel="stylesheet" href="dist/css/adminlte.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<link rel="stylesheet" href="css/style.css">

</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">

<div class="app-wrapper">



<?php include 'includes/navbar.php'; ?>

<?php include 'includes/sidebar.php'; ?>

<main class="app-main">

<div class="container-fluid mt-4">

<h1><i class="fas fa-desktop me-2"></i>Devices</h1>

<form method="GET" class="row mb-3">
    <div class="col-md-5">
        <input type="text" name="search" class="form-control"
               placeholder="Search Device..."
               value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
    </div>
    <div class="col-md-3">
        <select name="status" class="form-control">
            <option value="">All Status</option>
            <option value="Online">Online</option>
            <option value="Offline">Offline</option>
        </select>
    </div>
    <div class="col-md-2">
        <button class="btn btn-primary w-100">Search</button>
    </div>
    <div class="col-md-2">
        <a href="devices.php" class="btn btn-secondary w-100">Reset</a>
    </div>
</form>

<a href="add_device.php" class="btn btn-primary mb-3">
+ Add Device
</a>

<table class="table table-bordered table-striped">
<thead>
<tr>
<th>ID</th>
<th>Device Name</th>
<th>IP Address</th>
<th>MAC Address</th>
<th>Type</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>
<tbody>

<?php
$where = [];

if (!empty($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $where[] = "(device_name LIKE '%$search%' 
              OR ip_address LIKE '%$search%' 
              OR mac_address LIKE '%$search%')";
}

if (!empty($_GET['status'])) {
    $status = mysqli_real_escape_string($conn, $_GET['status']);
    $where[] = "status='$status'";
}

$sql = "SELECT * FROM devices";

if (count($where) > 0) {
    $sql .= " WHERE " . implode(" AND ", $where);
}

$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)){
?>

<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['device_name']; ?></td>
<td><?php echo $row['ip_address']; ?></td>
<td><?php echo $row['mac_address']; ?></td>
<td><?php echo $row['device_type']; ?></td>
<td><?php echo $row['status']; ?></td>
<td>
<a href="edit_device.php?id=<?php echo $row['id']; ?>" class="btn btn-success btn-sm">Edit</a>
<a href="delete_device.php?id=<?php echo $row['id']; ?>"
   class="btn btn-danger btn-sm"
   onclick="return confirm('Are you sure you want to delete this device?');">Delete</a>
</td>
</tr>

<?php } ?>

</tbody>
</table>

</div>

</main>

</div>

<script src="dist/js/adminlte.js"></script>

</body>

</html>