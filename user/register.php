
<?php

    include "../db.php";

    if(isset($_POST["signup"])){
        $name = $_POST["name"];
        $password = $_POST["password"];
        $email = $_POST["email"];
        $user_role = $_POST["user_role"];
        $user_school = $_POST["school"];
        $sql_school = "SELECT * FROM school WHERE school_name = '$user_school'";
        $query_school = mysqli_query($baglan,$sql_school);
        while($row_school_while = mysqli_fetch_assoc($query_school)){
            $row_school_while_id = $row_school_while["school_id"];
        }
        $query = "INSERT INTO users (user_name, user_password, user_email, status ,role, school_id)";
        $query .= "VALUES ('{$name}', '{$password}', '{$email}','offline','{$user_role}','{$row_school_while_id}')";
        $sql_query = mysqli_query($baglan, $query);
        header("Location: login.php");
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="main">

        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" class="register-form" id="register-form" action="">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="name" id="name" placeholder="Your Name"/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email"/>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="pass" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="re_password" id="re_pass" placeholder="Repeat your password"/>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name='user_role' id="exampleFormControlSelect1">
                                    <option value='student'>Öğrenci</option>
                                    <option value='teacher'>Öğretmen</option>
                                    <option value="client">Müşteri</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name='school' id="exampleFormControlSelect1">
                                    <?php
                                        $get_school_list_sql = "SELECT * FROM school";
                                        $get_school_list_query = mysqli_query($baglan,$get_school_list_sql);
                                        while($row = mysqli_fetch_assoc($get_school_list_query)){
                                            $row_school = $row['school_name'];
                                            echo "<option>$row_school</option>";
                                        };
                                    ?>
                                </select>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                            </div>
                            
                        </div>
                        </form>
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