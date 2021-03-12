<?php

    include "../db.php";
    session_start(); 


    if(isset($_POST["signin"])){
        $name = $_POST["name"];
        $password = $_POST["password"];
        $query = "SELECT * FROM users WHERE user_name = '{$name}'";
        $select_user_query = mysqli_query($baglan, $query);
        if(!$select_user_query){
            die("QUERY FAILED".mysqli_error($baglan));
        }
        while($row = mysqli_fetch_assoc($select_user_query)){
            $db_id = $row["user_id"];
            $db_name = $row["user_name"];
            $db_email = $row["user_email"];
            $db_role = $row["role"];
            $db_password = $row["user_password"];
            $db_school_id = $row["school_id"];

        }
        if($name !==  $db_name && $password !== $db_password){
            header("Location: login.php");
        }else if($name ==  $db_name && $password == $db_password){
            if($db_role == 'teacher'){
                $_SESSION["id"] = $db_id;
                $_SESSION["username"] = $db_name;
                $_SESSION["email"] = $db_email;
                $_SESSION["password"] = $db_password;
                $_SESSION["role"] = $db_role;
                $_SESSION["school_id"] = $db_school_id;
                // Set Online Status
                $update_durum_online = "UPDATE users SET status = 'online' WHERE user_id = '$db_id'";
                $update_query_durum_online = mysqli_query($baglan,$update_durum_online);
                header('Location: ../adminour/index.php');
            }else{
                $_SESSION["id"] = $db_id;
                $_SESSION["username"] = $db_name;
                $_SESSION["email"] = $db_email;
                $_SESSION["password"] = $db_password;
                $_SESSION["role"] = $db_role;
                // Set Online Status
                $update_durum_online = "UPDATE users SET status = 'online' WHERE user_id = '$db_id'";
                $update_query_durum_online = mysqli_query($baglan,$update_durum_online);
                header('Location: ../home.php');  
            }
        }else{
            header("Location: login.php");
        }
        
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by Colorlib</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="main">
     <!-- Sing in  Form -->
     <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="images/signin-image.jpg" alt="sing up image"></figure>
                        <a href="register.php" class="signup-image-link">Create an account</a>
                        <a href="../adminour/forgot-password.php" class="signup-image-link">Forget Password</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" class="register-form" id="login-form">
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="name" id="your_name" placeholder="Your Name"/>
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="your_pass" placeholder="Password"/>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                            </div>
                        </form>
                        <div class="social-login">
                            <span class="social-label">Or login with</span>
                            <ul class="socials">
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>