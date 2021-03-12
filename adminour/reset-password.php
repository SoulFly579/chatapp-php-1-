

<?php

include('../db.php');
$reset_kod = trim($_GET['reset']);
if(!$reset_kod){
  echo "Sıfırlama kodu yok.";
}else{
if(isset($_POST['reset'])){
  $email = $_POST['email'];
  $password = $_POST['password'];

  $update_password = "UPDATE users SET user_password = '$password', reset_password = '' WHERE reset_password = '$reset_kod'  ";
  $update_password_query = mysqli_query($baglan,$update_password);

  header('Location: ../user/login.php');
}
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sıfırla</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
<form action='' method='post' style='margin-left:700px;margin-top:300px; width:500px;'>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
  </div>
  <input type="submit" name='reset' value='submit' class="btn btn-primary">
</form>
</body>
</html>