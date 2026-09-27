<?php
session_start();
include 'db.php';

if(isset($_POST['login'])){

$username = trim($_POST['username']);
$password = md5(trim($_POST['password']));

$stmt = $conn->prepare("SELECT * FROM admins WHERE username=? AND password=?");
$stmt->bind_param("ss",$username,$password);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
$_SESSION['admin']=$username;
header("Location: dashboard.php");
exit();
}else{
$error="Invalid username or password";
}
}
?>

<!DOCTYPE html>
<html>
<head>
<title>PPS Login</title>
<link rel="stylesheet" href="/PPS/css/style.css">
</head>

<?php
if(isset($_GET['logout'])){
echo "<script>alert('Logout Successful!');</script>";
}
?>

<body class="login-page">   
<div class="login-card">
<img src="/PPS/images/logo.png" class="login-logo">

<h2>Product Procurement System</h2>
<?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>

<form method="POST">
<input type="text" name="username" placeholder="Username" required>
<input type="password" name="password" placeholder="Password" required>
<button type="submit" name="login">Login</button>
</form>
</div>

</body>
</html>