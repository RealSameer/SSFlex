<?php
session_start();
require_once "connection.php";
if (isset($_SESSION['user_id']) != "") {
header("Location: dashboard.php");
}
if (isset($_POST['login'])) {
$username    = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

if(empty($username)){
    $username_error = "Username is empty";
}

if (strlen($password) < 6) {
$password_error = "Password must be minimum of 6 characters";
}
$result = mysqli_query($conn, "SELECT * FROM tbl_user WHERE username = '" . $username . "' and password = '" . md5($password) . "'");
if ($row = mysqli_fetch_array($result)) {
$_SESSION['user_id']     = $row['id'];
$_SESSION['user_name']   = $row['name'];
$_SESSION['user_mobile'] = $row['mobile'];
$_SESSION['user_email']  = $row['username'];
header("Location: welcome.php");
} else {
$error_message = "Incorrect Username or Password!!!";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
  <link rel="stylesheet" href="style.css">

</head>
<body>
<section class="vh-100">
    <div class="container py-5 h-100">
      <div class="row d-flex align-items-center justify-content-center h-100">
        <div class="col-md-8 col-lg-7 col-xl-6">
          <img src="Sign up-cuate.png" class="img-fluid" alt="Filter icon" height="300px" width="600px">
        </div>
        <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
        <span class="text-danger"><?php if (isset($error_message)) echo $error_message; ?></span>
          <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <p class="text-center h1 fw-bold mb-4 mx-1 mx-md-3 mt-3">Login </p>
            <!-- Email input -->
            <div class="form-outline mb-4">
              <label class="form-label" for="form1Example13"> <i class="bi bi-person-circle"></i> Email</label>
              <input type="text" id="form1Example13" class="form-control form-control-lg py-3" name="username" autocomplete="off" placeholder="enter your email" style="border-radius:25px ;" />
                
<span class="text-danger"><?php if (isset($username_error)) echo $username_error; ?></span>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
              <label class="form-label" for="form1Example23"><i class="bi bi-chat-left-dots-fill"></i> Password</label>
              <input type="password" id="form1Example23" class="form-control form-control-lg py-3" name="password" autocomplete="off" placeholder="enter your password" style="border-radius:25px ;" />
              <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
            </div>


            <!-- Submit button -->
            <!-- <button type="submit" class="btn btn-primary btn-lg">Login in</button> -->
            <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
              <input type="submit" value="Sign in" name="login" class="btn btn-dark btn-lg text-light my-2 py-3" style="width:100% ; border-radius: 30px; font-weight:600;" />
            </div>

          </form><br>
          <p align="center">i don't have any account <a href="register.php" class="text-warning" style="font-weight:600;text-decoration:none;">Register Here</a></p>
        </div>
      </div>
    </div>
  </section>

</body>
</html>