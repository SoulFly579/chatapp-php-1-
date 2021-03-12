<?php

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  require '../vendor/phpmailer/phpmailer/src/Exception.php';
  require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
  require '../vendor/phpmailer/phpmailer/src/SMTP.php';
  require_once '../db.php';

  if(isset($_POST['reset'])){
    $email = $_POST['email'];
    $sql = "SELECT * FROM users WHERE user_email = '$email'";
    $query = mysqli_query($baglan,$sql);
    while ($row = mysqli_fetch_array($query)){
      $user_name = $row['user_name'];
    }
    $reset_password = uniqid('resetpassword_');
    $reset_link = "http://localhost/chatapphp/adminour/reset-password.php?reset=".$reset_password;

    $add_reset = "UPDATE users SET reset_password = '{$reset_password}' WHERE user_email = '$email' ";
    $add_reset_query = mysqli_query($baglan,$add_reset);


    $mail = new PhpMailer();
    $mail->IsSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->SMTPKeepAlive = true;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = True;
    $mail->Username = "iletisim.blogw@gmail.com";
    $mail->Password = "1881a1938";
    $mail->AddAddress($email);
    $mail->From = "iletisim.blogw@gmail.com";
    $mail->FromName = "Şifremi Unuttum ";
    $mail->CharSet = "UTF-8";
    $mail->Subject = "Şifremi Sıfırlama Kodu";
    $mail->isHTML(true);
    $mailicerik = "<div style='font-size:20px'>Sayın '.$user_name.' Sıfırlama linkiniz: <a href='$reset_link'>Sıfırla</a> </div>";

    $mail->MsgHTML($mailicerik);
    if($mail->Send()){

    }

  }




?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Forgot Password</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                    <p class="mb-4">We get it, stuff happens. Just enter your email address below and we'll send you a link to reset your password!</p>
                  </div>
                  <form class="user" action='' method='POST'>
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user"  name='email' id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                    </div>
                    <input class="btn btn-primary btn-user btn-block" type='submit' name='reset' value='Submit'>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="register.html">Create an Account!</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="login.html">Already have an account? Login!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
