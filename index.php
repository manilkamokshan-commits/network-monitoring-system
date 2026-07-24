<?php
session_start();
include 'api/db.php';

$error = "";

if(isset($_POST['login'])){

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){

        $_SESSION['username'] = $username;

        header("Location: dashboard.php");
        exit();

    }else{

        $error = "Invalid Username or Password!";

    }
}
?>

<?php include 'includes/theme.php'; ?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="<?php echo $themeAttr; ?>">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Admin Login</title>

<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body>

<div class="login-page">

    <div class="login-container">

        <div class="login-logo">
            <i class="fas fa-network-wired"></i>
            <h2>Network Monitoring</h2>
            <p>Management System</p>
        </div>

        <div class="login-card">

            <h3>Admin Login</h3>

            <?php if($error!=""){ ?>
                <div class="error">
                    <?php echo $error; ?>
                </div>
            <?php } ?>

            <form method="POST">

                <div class="input-group">
                    <i class="fas fa-user"></i>

                    <input
                    type="text"
                    name="username"
                    class="form-control"
                    placeholder="Username"
                    required>
                </div>

                <div class="input-group">

                    <i class="fas fa-lock"></i>

                    <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control"
                    placeholder="Password"
                    required>

                    <span onclick="togglePassword()">
                        <i class="fas fa-eye" id="eye"></i>
                    </span>

                </div>

                <button type="submit" name="login" class="btn-login">
                    Login
                </button>

            </form>

        </div>

    </div>

</div>

<script>

function togglePassword(){

    let pass = document.getElementById("password");
    let eye = document.getElementById("eye");

    if(pass.type==="password"){

        pass.type="text";
        eye.classList.replace("fa-eye","fa-eye-slash");

    }else{

        pass.type="password";
        eye.classList.replace("fa-eye-slash","fa-eye");

    }

}

</script>

</body>
</html>