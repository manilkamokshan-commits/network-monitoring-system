<?php
include 'api/db.php';

if(isset($_POST['save']))
{
    $device_name = $_POST['device_name'];
    $ip_address = $_POST['ip_address'];
    $mac_address = $_POST['mac_address'];
    $device_type = $_POST['device_type'];
    $status = $_POST['status'];

    $sql = "INSERT INTO devices(device_name, ip_address, mac_address, device_type, status)
            VALUES('$device_name','$ip_address','$mac_address','$device_type','$status')";

    mysqli_query($conn, $sql);

    header("Location: devices.php");
}
?>

<?php include 'includes/theme.php'; ?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="<?php echo $themeAttr; ?>">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Add Device</title>

<link rel="stylesheet" href="dist/css/adminlte.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="container mt-5">

<h2>Add New Device</h2>

<form method="POST">

<div class="mb-3">
<label>Device Name</label>
<input type="text" name="device_name" class="form-control" required>
</div>

<div class="mb-3">
<label>IP Address</label>
<input type="text" name="ip_address" class="form-control" required>
</div>

<div class="mb-3">
<label>MAC Address</label>
<input type="text" name="mac_address" class="form-control" required>
</div>

<div class="mb-3">
<label>Device Type</label>
<select name="device_type" class="form-control">
<option>Router</option>
<option>Switch</option>
<option>Server</option>
<option>PC</option>
<option>Laptop</option>
</select>
</div>

<div class="mb-3">
<label>Status</label>
<select name="status" class="form-control">
<option>Online</option>
<option>Offline</option>
</select>
</div>

<button type="submit" name="save" class="btn btn-primary">
Save Device
</button>

<a href="devices.php" class="btn btn-secondary">
Back
</a>

</form>

</body>
</html>