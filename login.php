<?php
 $login = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
 include 'dbconnect.php';
$username = $_POST["username"];
$password  = $_POST["password"];



// $sql = "Select * from users where username = '$username' AND password = '$password'";
$sql = "Select * from school where username = '$username'";
$result = mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);
if($num == 1){
    while($row=mysqli_fetch_assoc($result)){
        if(password_verify($password, $row['password'])){
            $login = true;
            $login = true;
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            header("location: home.php");
            }
            else{
                $showError = "Invalid credentials";
            }
        }
    }
   
  
  else{
      $showError = "Invalid credentials";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>

<body>
    <?php include "header.php"; ?>
    <?php
    if($login){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> You are loged in
       
    </div>';
}
?>
    <?php
    if($showError){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> ' . $showError .'
        
    </div>';
}
?>
    <div class="login-page">
        <h2>Login Here</h2>
        <form action="/login1/login.php" method="post">
            <div class="username">
                <input type="text" name="username" placeholder="username">
            </div>
            <div class="password">
                <input type="password" name="password" placeholder="password">
            </div>
            <div class="logg">
            <button type="submit" class="btn-login">Login</button>
            <a href="sign.php">Sign-up</a>
            </div>
        </form>
    </div>
</body>

</html>