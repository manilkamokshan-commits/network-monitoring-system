
<?php include 'includes/theme.php'; ?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="<?php echo $themeAttr; ?>">
 
<body>
<aside class="app-sidebar">

<div class="sidebar-brand">
<a href="#" class="brand-link">
Network Monitor
</a>
</div>

<div class="sidebar-wrapper">
<nav>
<ul class="nav sidebar-menu flex-column">

<li class="nav-item">
<a href="dashboard.php" class="nav-link">
<i class="fa-solid fa-house"></i> Dashboard
</a>
</li>

<li class="nav-item">
<a href="devices.php" class="nav-link">
<i class="fa-solid fa-desktop"></i> Devices
</a>
</li>

<li class="nav-item">
<a href="bandwidth.php" class="nav-link">
<i class="fa-solid fa-chart-line"></i> Bandwidth
</a>
</li>

<li class="nav-item">
<a href="alerts.php" class="nav-link">
<i class="fa-solid fa-bell"></i> Alerts
</a>
</li>

<li class="nav-item">
<a href="reports.php" class="nav-link">
<i class="fa-solid fa-file"></i> Reports
</a>
</li>

<li class="nav-item">
<a href="settings.php" class="nav-link">
<i class="fa-solid fa-gear"></i> Settings
</a>
</li>

<li class="nav-item">
<a href="logout.php" class="nav-link">
<i class="fa-solid fa-right-from-bracket"></i> Logout
</a>
</li>

</ul>
</nav>
</div>

</aside>

    
</body>
</html>