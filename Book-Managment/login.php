<?php
session_start();
include 'connect.php';

$emailError = "";
$pwdError =  "";

if(isset($_POST['btn'])){
  $email = $_POST['email'];
  $pwd = $_POST['pwd'];

  if(empty($email)){
    $emailError = "Email is required";
  }
  else{
    $emailError = "";
  }
  if(empty($pwd)){
    $pwdError = "Password is Reqired";
  }
  else{
    $pwdError = "";
  }

  
}

if(!empty($email) && !empty($pwd)){
  $sql = "SELECT * FROM  signup WHERE email = '$email' ";
  $result = $conn->query($sql);

  if($result->num_rows >0){
      $row = $result->fetch_assoc();
      // if(password_verify($pwd,$row['Password'])){
        if($pwd === $row['Password']){
        $_SESSION['user_login']= true;
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_email'] = $row['email'];
      header("location:  homepage.php");
      }
      else{
        echo '<div class="alert alert-danger alert-dismissible col-md-4 container" role="alert">
        <i class="fa-solid fa-triangle-exclamation" style="color: #b61b3a;"></i>
         Password is incorrect
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>'; 
      }
  }
  else{
    echo '<div class="alert alert-danger alert-dismissible col-md-4 container" role="alert">
    <i class="fa-solid fa-triangle-exclamation" style="color: #b61b3a;"></i>
    Email  is incorrect
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';  }
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
    </head>

<body class="bg-light">

  <!-- Centered Login Form -->
  <div class="container d-flex justify-content-center align-items-center min-vh-100">
    <form action="Login.php" method="post" class="row g-3  bg-white p-4 rounded shadow"
      style="max-width: 400px;" >
      <h3 class="text-center mb-4">Login</h3>

      <!-- Email -->
      <div class="col-md-12">
        <label for="validationCustomEmail" class="form-label fw-semibold">Email</label>
        <input type="email" name="email" class="form-control" id="validationCustomEmail" placeholder="Enter your email">
        <div  class="text-danger mx-2 mb-2"><?php echo $emailError;?></div>
      </div>

      <!-- Password -->
      <div class="col-md-12">
        <label for="validationCustomPassword" class="form-label fw-semibold">Password</label>
        <input type="password" name="pwd" class="form-control" id="validationCustomPassword"
          placeholder="Enter your password">
          <div  class="text-danger mx-2 mb-2"><?php echo $pwdError;?></div>
      </div>

      <!-- Submit Button -->
      <div class="col-12">
        <button class="btn btn-primary w-100" type="submit" name="btn">Login</button>
      </div>

      <div  class=" mx-2 mb-2">
      <a href="Regestration.php" >Don't have an Account?</a>
      <a href="forgetPassword.php" class="ms-2">Forget Password?</a>
    </div>

    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>
