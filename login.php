<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

<?php
session_start();
if ($_SERVER['REQUEST_METHOD']=='POST') {

    $user = $_POST['username'];
    $password = $_POST['password'];

    require_once 'connect.php';

    $sql = "SELECT * FROM User_admin WHERE username='$user' ";

    $response = mysqli_query($conn, $sql);

    $result = array();
    $result['login'] = array();

     if ( mysqli_num_rows($response) === 1 ) {
        
        $row = mysqli_fetch_assoc($response);
        if ( password_verify($password, $row['password']) ) {
            $index['user'] = $row['username'];
            $index['name'] = $row['name'];

            array_push($result['login'], $index);

            $result['success'] = "1";
            $result['message'] = "success";
            $_SESSION['user'] = $row['username'];
            $_SESSION['name'] = $row['name'];
            header('location:student.php');
            mysqli_close($conn);
        } else {
            $result['success'] = "0";
            $result['message'] = "error";
            echo "Not Fail";
        mysqli_close($conn);
        }}}
?>

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">
        <center>
        <img src="img/logos.png" width="125" height="100">
      </center>
      </div>
      <div class="card-body">
        <form action="" method="POST">
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="username" class="form-control" placeholder="Username" required="required" autofocus="autofocus"
              name="username">
              <label for="username">Username</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="Password" class="form-control" placeholder="Password" required="required"
              name="password">
              <label for="Password">Password</label>
            </div>
          </div>
          <center>
          <input type="submit" name="submit" class="btn btn-info" value="Sign In">
        </center>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
