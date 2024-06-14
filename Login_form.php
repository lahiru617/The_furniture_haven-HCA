<?php

@include 'config.php';

session_start();

if(isset($_POST['Submit'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['password']);
    $user_type = $_POST['user_type'];

    $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$password' ";

    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0 ){

        $row = mysqli_fetch_array($result);

        if($row['user_type'] == 'admin'){

            $_SESSION['admin_name'] = $row['name'];
            header('location:Admin_page.php');

        }elseif($row['user_type'] == 'user'){

            $_SESSION['user_name'] = $row['name'];
            header('location:User_page.php');

        }
       
    }else{
        $error[] = 'incorrect email or password!';
    }

};

?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Form</title>
        <link rel="stylesheet" href="CSS/Style.css">
    </head>
    <body>

        <div class="form_container">

            <form action="" method="post">
                <h3>Login Now</h3>
                <?php
                if(isset($error)){
                    foreach($error as $error){
                        echo '<span class="error-msg">' .$error. '</span>';
                    };
                };
                
                ?>
                <input type="text" name="name" required placeholder="Enter your name">
                <input type="email" name="email" required placeholder="Enter your E-mail">
                <input type="password" name="password" required placeholder="Enter your password">
                <input type="submit" name="Submit" value="login now" class="form-btn">
                <p>Don't have an Account? <a href="Register_form.php">Register now</a></p>
            </form>
        </div>

    </body>
</html>