<body class="bg-light">
  <?php
  include 'connect.php';

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    // $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT);

    // check for same email
    $email_check = "SELECT * FROM signup WHERE email = '$email' ";
    $result = $conn->query($email_check);

    if ($result->num_rows > 0) {
      echo '<div class="alert alert-danger alert-dismissible col-md-4 container" role="alert">
      <i class="fa-solid fa-triangle-exclamation" style="color: #b61b3a;"></i>
  Email is Already present!
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
    // check for same username
     else {
      $username_check = "SELECT * FROM signup WHERE user_name = '$username' ";
      $check = $conn->query($username_check);
      if($check->num_rows>0){
        echo '<div class="alert alert-danger alert-dismissible col-md-4 container" role="alert">
      <i class="fa-solid fa-triangle-exclamation" style="color: #b61b3a;"></i>
  userName is Already present!
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
      }
      else{ 
      $sql = "INSERT INTO signup (first_name, last_name, email, user_name, Password) VALUES('$fname','$lname','$email','$username','$pwd')";
      if ($conn->query($sql) === TRUE) {
        header("location: login.php");
        exit();
      }
    }
    }
  }
  ?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">


  
</head>

<body>

  <div class="container d-flex justify-content-center align-items-center min-vh-100">
    <form action="Regestration.php" method="post" class="row g-3 bg-white p-4 rounded shadow" style="max-width: 500px;" onsubmit="return formValidation();">
      <h3 class="text-center mb-4">Registration Form</h3>

      <!-- First Name -->
      <div class="col-md-12">
        <label for="fname" class="form-label fw-semibold">First Name</label>
        <input type="text" name="fname" class="form-control " id="fname" placeholder="Enter your first name">
        <div id="fnameError" class="text-danger mx-2 mb-2"></div>
      </div>

      <!-- Last Name -->
      <div class="col-md-12">
        <label for="lname" class="form-label fw-semibold">Last Name</label>
        <input type="text" name="lname" class="form-control" id="lname" placeholder="Enter your last name">
        <div id="lnameError" class="text-danger mx-2 mb-2"></div>
      </div>

      <!-- Email -->
      <div class="col-md-12">
        <label for="email" class="form-label fw-semibold">Email</label>
        <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email">
        <div id="emailError" class="text-danger mx-2 mb-2"></div>
      </div> 

      <!-- user name -->
      <div class="col-md-12">
        <label for="username" class="form-label fw-semibold">UserName</label>
        <input type="text" name="username" class="form-control" id="username" placeholder="Enter your username">
        <div id="usernameError" class="text-danger mx-2 mb-2"></div>
      </div>

      <!-- Password -->
      <div class="col-md-12">
        <label for="pwd" class="form-label fw-semibold">Password</label>
        <input type="password" name="pwd" class="form-control" id="pwd" placeholder="Enter your password">
        <div id="pwdError" class="text-danger mx-2 mb-2"></div>
      </div>
         

      <!-- Submit Button -->
      <div class="col-12">
        <button class="btn btn-primary w-100" type="submit" name="btn">Submit Form</button>
      </div>

      <div  class=" mx-2 mb-2"><a href="login.php">Already have an Account?</a></div>

    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


  <script>
    function formValidation() {
      let fname = document.getElementById('fname').value.trim();
      let lname = document.getElementById('lname').value.trim();
      let email = document.getElementById('email').value.trim();
      let username = document.getElementById('username').value.trim();
      let pwd = document.getElementById('pwd').value.trim();
  

      let emailReg = /^[a-z]+[a-z0-9._%+-]*@[a-z0-9.-]+\.[a-z]{2,}$/i;
      let namepattren = /^[A-Za-z]+$/;
      let usernameReg = /^[a-zA-Z]{2,}\d*_?$/;

      let isvalid = true;

      if (fname === "") {
        document.getElementById('fnameError').textContent = "First name cannot be empty";
        isvalid = false;
      } else if (!namepattren.test(fname)) {
        document.getElementById('fnameError').textContent = "First name only contains letters";
        isvalid = false;
      } else {
        document.getElementById('fnameError').textContent = "";
      }

      if (lname === "") {
        document.getElementById('lnameError').textContent = "Last name cannot be empty";
        isvalid = false;
      } else if (!namepattren.test(lname)) {
        document.getElementById('lnameError').textContent = "Last name only contains letters";
        isvalid = false;
      } else {
        document.getElementById('lnameError').textContent = "";
      }

      if (email === "" || !emailReg.test(email)) {
        document.getElementById('emailError').textContent = "Enter a valid email";
        isvalid = false;
      } else {
        document.getElementById('emailError').textContent = "";
      }

      if (username === "" || !usernameReg.test(username)) {
        document.getElementById('usernameError').textContent = "Enter a valid username";
        isvalid = false;
      } else {
        document.getElementById('usernameError').textContent = "";
      }

      if (pwd === "" || pwd.length < 8) {
        document.getElementById('pwdError').textContent = "Password must be at least 8 characters long";
        isvalid = false;
      } else {
        document.getElementById('pwdError').textContent = "";
      }

      return isvalid; 
    }
  </script>
</body>


</html>
