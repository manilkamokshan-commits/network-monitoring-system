<?php

session_start();

include 'api/db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM settings WHERE id=1");
$data = mysqli_fetch_assoc($result);

$message = "";

if (isset($_POST['save'])) {

    $stmt = mysqli_prepare($conn,
        "UPDATE settings SET
            system_name = ?,
            ssid = ?,
            bandwidth_limit = ?,
            admin_email = ?,
            theme = ?
         WHERE id = 1"
    );

    $system    = $_POST['system_name'];
    $ssid      = $_POST['ssid'];
    $bandwidth = $_POST['bandwidth_limit'];
    $email     = $_POST['admin_email'];
    $theme     = $_POST['theme'];

    mysqli_stmt_bind_param($stmt, "sssss", $system, $ssid, $bandwidth, $email, $theme);
    mysqli_stmt_execute($stmt);

    $message = "Settings Updated Successfully!";

    $result = mysqli_query($conn, "SELECT * FROM settings WHERE id=1");
    $data = mysqli_fetch_assoc($result);
}

$themeAttr = ($data['theme'] === 'Dark') ? 'dark' : 'light';
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="<?php echo $themeAttr; ?>">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Settings</title>

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
    <h1><i class="fas fa-cog"></i> Settings</h1>
</div>

<?php if (!empty($message)): ?>
    <div class="alert alert-success"><?php echo htmlspecialchars($message); ?></div>
<?php endif; ?>

<div class="card">
    <div class="card-header bg-dark text-white">
        <h3 class="card-title">System Settings</h3>
    </div>

    <div class="card-body">
        <form method="POST">

            <div class="mb-3">
                <label class="form-label">System Name</label>
                <input type="text" class="form-control" name="system_name"
                    value="<?php echo htmlspecialchars($data['system_name']); ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Network SSID</label>
                <input type="text" class="form-control" name="ssid"
                    value="<?php echo htmlspecialchars($data['ssid']); ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Bandwidth Limit (Mbps)</label>
                <input type="number" class="form-control" name="bandwidth_limit"
                    value="<?php echo htmlspecialchars($data['bandwidth_limit']); ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Admin Email</label>
                <input type="email" class="form-control" name="admin_email"
                    value="<?php echo htmlspecialchars($data['admin_email']); ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Theme</label>
                <select class="form-select" name="theme">
                    <option value="Light" <?php echo ($data['theme'] === 'Light') ? 'selected' : ''; ?>>Light</option>
                    <option value="Dark" <?php echo ($data['theme'] === 'Dark') ? 'selected' : ''; ?>>Dark</option>
                </select>
            </div>

            <button type="submit" name="save" class="btn btn-primary">
                <i class="fas fa-save"></i> Save Settings
            </button>

        </form>
    </div>
</div>

</div>
</div>
</main>

</div>

<script src="dist/js/adminlte.js"></script>
</body>
</html>