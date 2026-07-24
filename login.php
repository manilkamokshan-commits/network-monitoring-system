<?php
session_start();
include 'api/db.php';

$error = "";

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
    $stmt->bind_param("ss",$username,$password);
    $stmt->execute();

    $result = $stmt->get_result();

    if($result->num_rows > 0){

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

<title>Admin Login</title><br>


<link rel="stylesheet" href="dist/css/adminlte.css">


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">


<link rel="stylesheet" 
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">


</head>


<body class="hold-transition login-page">


<div class="login-box">


<div class="card card-outline card-primary">






<div class="card-header text-center">

<h1 class="h2">

<b>ADMIN</b> LOGIN
</h1>

</div><br><br>





<?php if($error != ""){ ?>

<div class="alert alert-danger">

<?php echo $error; ?>

</div>

<?php } ?>







<form method="POST">



<div class="input-group mb-3">


<input 
type="text"
name="username"
class="form-control"
placeholder="Username"
required>


<div class="input-group-text">

<span class="fas fa-user"></span>

</div>


</div>







<div class="input-group mb-3">


<input 
type="password"
id="password"
name="password"
class="form-control"
placeholder="Password"
required>



<div class="input-group-text">


<span onclick="togglePassword()" style="cursor:pointer;">

<i class="fas fa-eye" id="eye"></i>

</span>


</div>



</div>

<div class="text-end mt-3 mb-4 px-2">
    <a href="forgot_password.php" class="text-decoration-none">
        <i class="fas fa-key me-1"></i> Forgot Password?
    </a>
</div>


<div class="row">


<div class="col-12">


<button 
type="submit"
name="login"
class="btn btn-primary btn-block w-100">


<i class="fas fa-sign-in-alt"></i>

Login


</button>


</div>


</div>



</form>





<p class="mt-4 text-center text-muted">

Smart Network Monitoring System

</p>



</div>


</div>


</div>





<script src="dist/js/adminlte.js"></script>



<script>


function togglePassword(){


let pass=document.getElementById("password");

let eye=document.getElementById("eye");



if(pass.type=="password"){


pass.type="text";


eye.classList.remove("fa-eye");

eye.classList.add("fa-eye-slash");


}else{


pass.type="password";


eye.classList.remove("fa-eye-slash");

eye.classList.add("fa-eye");


}


}


</script>


</body>

</html>