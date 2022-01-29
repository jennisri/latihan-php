<?php   

include 'config/core.php';

if(isset($_POST['login'])){
  $username = mysqli_escape_string($db, $_POST['username']);
  $password = mysqli_escape_string($db, $_POST['password']);

  // ambil semua data user berdasarkan nama
  $checkuser = mysqli_query($db, "SELECT * FROM user WHERE username = '$username'");
    // jika data yang diambil dari checkuser bernilai satu
  if(mysqli_num_rows($checkuser) === 1){
        // validasi password
    $rows = mysqli_fetch_assoc($checkuser);
  // lakukan verifikasi password yang di masukkan oleh user dengan yang ada di database
    if(password_verify($password, $rows['password'])){
    // set session
      $_SESSION['login']      = true;
      $_SESSION['id_user']    = $rows['id_user'];
      $_SESSION['username']   = $rows['username'];
      $_SESSION['role']       = $rows['role'];

      header("Location: index.php");
      exit;
    }
  }
  $error= true;
}

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.88.1">
  <title>Signin Template · Bootstrap v4.6</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/4.6/examples/sign-in/">



  <!-- Bootstrap core CSS -->
  <link href="https://getbootstrap.com/docs/4.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">



  
  <meta name="msapplication-config" content="/docs/4.6/assets/img/favicons/browserconfig.xml">
  <meta name="theme-color" content="#563d7c">


  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>


  <!-- Custom styles for this template -->
  <link href="https://getbootstrap.com/docs/4.6/examples/sign-in/signin.css" rel="stylesheet">
</head>
<body class="text-center">

  <form class="form-signin" method="post" action="">
    <h1 class="h3 mb-5 font-weight-normal">Login</h1>

    <!-- KETIKA LOGIN ERROR ATAU SALAH KATASANDI DAN PASSWORD -->
    <?php if (isset($error)) :?>
      <p style="color: red; font-style: italic;">username atau password salah</p>
    <?php endif ?>

    <div class="form-group">
      <label for="username" class="sr-only">Username</label>
      <input type="text" id="username" name="username" class="form-control" placeholder="Masukkan Username" required autofocus>
    </div>
    <div class="form-group">
      <label for="password" class="sr-only">Password</label>
      <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
    </div>

    <div class="form-group">
      <div class="custom-control custom-checkbox float-left mb-3">
        <input class="custom-control-input" id="show-password" type="checkbox" />
        <label class="custom-control-label" for="show-password">
          <small>Remember password</small></label>
        </div>
      </div>  

      <button class="btn btn-lg btn-primary btn-block" name="login" type="submit">Log in</button>

      <p class="mt-5 mb-3 text-muted">&copy; <?php  echo date('Y'); ?></p>
    </form>



  </body>
  </html>
