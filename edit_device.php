<?php
include 'api/db.php';

$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM devices WHERE id=$id");
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update']))
{
    $device_name = $_POST['device_name'];
    $ip_address = $_POST['ip_address'];
    $mac_address = $_POST['mac_address'];
    $device_type = $_POST['device_type'];
    $status = $_POST['status'];

    $sql = "UPDATE devices SET
    device_name='$device_name',
    ip_address='$ip_address',
    mac_address='$mac_address',
    device_type='$device_type',
    status='$status'
    WHERE id=$id";

    mysqli_query($conn, $sql);

    header("Location: devices.php");
}
?>

<?php include 'includes/theme.php'; ?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="<?php echo $themeAttr; ?>">
<html>
<head>
<title>Edit Device</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">

<h2>Edit Device</h2>

<form method="POST">

<div class="mb-3">
<label>Device Name</label>
<input type="text" name="device_name" class="form-control"
value="<?php echo $row['device_name']; ?>">
</div>

<div class="mb-3">
<label>IP Address</label>
<input type="text" name="ip_address" class="form-control"
value="<?php echo $row['ip_address']; ?>">
</div>

<div class="mb-3">
<label>MAC Address</label>
<input type="text" name="mac_address" class="form-control"
value="<?php echo $row['mac_address']; ?>">
</div>

<div class="mb-3">
<label>Device Type</label>

<select name="device_type" class="form-control">

<option <?php if($row['device_type']=="Router") echo "selected"; ?>>Router</option>

<option <?php if($row['device_type']=="Switch") echo "selected"; ?>>Switch</option>

<option <?php if($row['device_type']=="Server") echo "selected"; ?>>Server</option>

<option <?php if($row['device_type']=="PC") echo "selected"; ?>>PC</option>

<option <?php if($row['device_type']=="Laptop") echo "selected"; ?>>Laptop</option>

</select>

</div>

<div class="mb-3">

<label>Status</label>

<select name="status" class="form-control">

<option <?php if($row['status']=="Online") echo "selected"; ?>>Online</option>

<option <?php if($row['status']=="Offline") echo "selected"; ?>>Offline</option>

</select>

</div>

<button class="btn btn-success" name="update">
Update Device
</button>

<a href="devices.php" class="btn btn-secondary">
Cancel
</a>

</form>

</body>
</html>