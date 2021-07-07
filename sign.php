<?php
$showError = false;
 $showAlert = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
include 'dbconnect.php';
$username = $_POST["username"];
$password  = $_POST["password"];
$cpassword  = $_POST["cpassword"];
// $exists = false;

//check weather this username exists
$existsql = "SELECT * FROM `school` WHERE username = '$username'";
$result = mysqli_query($conn, $existsql);
$numExistsRows = mysqli_num_rows($result);
if($numExistsRows > 0){
    // $exists = true;
    $showError = " username already exists";
}
else{
    // $exists = false;
if(($password == $cpassword)){
    $hash = password_hash($password, PASSWORD_DEFAULT);
$sql = "INSERT INTO `school` ( `username`, `password`, `dt`) VALUES ('$username', '$hash', current_timestamp())";
$result = mysqli_query($conn, $sql);
if($result){
    // $showAlert = true;
    //below code will redirect to home.php page
    session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            header("location: home.php");
    }
  }
  else{
      $showError = "Passwords do not match";
    }
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
    <title>Sign Up</title>
</head>

<body>
    <?php include "header.php"; ?>
    <?php
    if($showAlert){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your Account is now created and you can login
    </div>';
}
?>
    <?php
    if($showError){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Alert!</strong> ' . $showError .'
    </div>';
}
?>
    <div class="signform">
        <h2>Sign-Up Form</h2>
        <form action="/login1/sign.php" method="post">
            <div class="username">
                <input type="text" name="username" placeholder="Enter Your Username">
            </div>
            <div class="password">
                <input type="password" name="password" placeholder="Enter Your Password">
            </div>
            <div class="cpassword">
                <input type="password" name="cpassword" placeholder="Please Confirm Your Password">
            </div>
            <button type="submit" class="signn">Sign-Up</button>
        </form>
    </div>
</body>

</html>