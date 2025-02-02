<?php
include 'connect.php';

$emailError = "";
$newpwd_Error = "";
 $cnfrmpwd_Error = "";

if(isset($_POST['btn'])){
  $email = $_POST['email'];
  $new_pwd = $_POST['new_pwd'];
  $cnfrm_pwd = $_POST['cnfrm_pwd'];

  // $new_pwd = password_hash($new_pwd,PASSWORD_DEFAULT);

  if(empty($email)){
    $emailError = "email is required";
  }
  else{
    $emailError = "";
  }

  if(empty($new_pwd) || empty($cnfrm_pwd)){
    $newpwd_Error = "password is required";
    $cnfrmpwd_Error = "Password is required"; 
  }
  if (strcasecmp($new_pwd, $cnfrm_pwd) !== 0) {
    $cnfrmpwd_Error = "Passwords do not match.";
}  
  else{
    $newpwd_Error = "";
    $cnfrmpwd_Error = "";
  }

  // check email is present
  if(empty($new_pwd) === empty($cnfrm_pwd) && $new_pwd !== $cnfrm_pwd && !empty($email)){
    $sql = "SELECT * FROM signup WHERE email = '$email' ";

    $result = $conn->query($sql);
     
    // set password
    if($result->num_rows>0){
      $pwd_update  = "UPDATE  signup SET Password = '$new_pwd' WHERE email = '$email'"; 

      if($conn->query($pwd_update) === TRUE){
        header("location: login.php");
      }
      else{
        echo "Password Not changed try again";
      }
    }
    else{
      echo '<div class="alert alert-danger alert-dismissible col-md-4 container" role="alert">
      <i class="fa-solid fa-triangle-exclamation" style="color: #b61b3a;"></i>
      Email not found
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';  
}    
}
  }



?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Forget pwd</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
    </head>

<body class="bg-light">

  <div class="container d-flex justify-content-center align-items-center min-vh-100">
    <form action="forgetPassword.php" method="post" class="row g-3  bg-white p-4 rounded shadow"
      style="max-width: 400px;" >
      <h3 class="text-center mb-4">Forgot Password</h3>

      <!-- Email -->
      <div class="col-md-12">
        <label for="validationCustomEmail" class="form-label fw-semibold">Email</label>
        <input type="email" name="email" class="form-control" id="validationCustomEmail" placeholder="Enter your email">
        <div  class="text-danger mx-2 mb-2"><?php echo $emailError;?></div>
      </div>

      <!-- Password -->
      <div class="col-md-12">
        <label for="new_pwd" class="form-label fw-semibold">New Password</label>
        <input type="password" name="new_pwd" class="form-control" id="new_pwd"
          placeholder="Enter your password">
          <div  class="text-danger mx-2 mb-2"><?php echo $newpwd_Error;?></div>
      </div>

            <!-- cnfrm -->
      <div class="col-md-12">
        <label for="cnfrm_pwd" class="form-label fw-semibold">Conform new Password</label>
        <input type="password" name="cnfrm_pwd" class="form-control" id="cnfrm_pwd"
          placeholder="Enter your password">
          <div  class="text-danger mx-2 mb-2"><?php echo $cnfrmpwd_Error;?></div>
      </div>

      <!-- Submit Button -->
      <div class="col-12">
        <button class="btn btn-primary w-100" type="submit" name="btn">Submit</button>
      </div>


    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>
