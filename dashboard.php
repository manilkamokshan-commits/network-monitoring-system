<?php
session_start();
include 'api/db.php';
include 'api/check_alerts.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$totalDevices = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM devices"));
$onlineDevices = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM devices WHERE status='Online'"));
$offlineDevices = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM devices WHERE status='Offline'"));
?>

<?php include 'includes/theme.php'; ?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="<?php echo $themeAttr; ?>">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Dashboard</title>

<link rel="stylesheet" href="dist/css/adminlte.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<link rel="stylesheet" href="css/style.css">
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">

<div class="app-wrapper">


<?php include 'includes/NAVbar.php'; ?>
<?php include 'includes/sidebar.php'; ?>

<main class="app-main">

<div class="container-fluid">

<h1><i class="fas fa-chart-line me-2"></i>Network Dashboard</h1>

<div class="mb-3">
    <h5 id="currentDate"></h5>
    <h6 id="currentTime"></h6>
</div>

<div class="row">

    <div class="col-lg-3 col-6">
        <div class="small-box text-bg-primary">
            <div class="inner">
                <h3><?php echo $totalDevices; ?></h3>
                <p>Total Devices</p>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box text-bg-success">
            <div class="inner">
                <h3><?php echo $onlineDevices; ?></h3>
                <p>Online Devices</p>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box text-bg-danger">
            <div class="inner">
                <h3><?php echo $offlineDevices; ?></h3>
                <p>Offline Devices</p>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box text-white bg-warning">
            <div class="inner">
                <h3>0</h3>
                <p>Alerts</p>
            </div>
        </div>
    </div>

    <div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">Network Traffic</h3>
    </div>
    <div class="card-body">
        <canvas id="trafficChart"></canvas>
    </div>
    </div>

</div>

</div>

</main>

</div>

<script src="dist/js/adminlte.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('trafficChart');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'],
        datasets: [{
            label: 'Bandwidth (Mbps)',
            data: [25,40,35,55,70,60,80],
            borderColor: 'blue',
            backgroundColor: 'rgba(54,162,235,0.2)',
            tension: 0.4,
            fill: true
        }]
    },
    options:{ responsive:true }
});
</script>
<script>
function updateClock() {
    const now = new Date();
    const dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    document.getElementById("currentDate").innerHTML = now.toLocaleDateString('en-US', dateOptions);
    document.getElementById("currentTime").innerHTML = now.toLocaleTimeString();
}
setInterval(updateClock,1000);
updateClock();
</script>
</body>

</html>