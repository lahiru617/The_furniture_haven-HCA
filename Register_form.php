<?php

@include 'config.php';

if(isset($_POST['Submit'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']);
    $user_type = $_POST['user_type'];

    $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$password' ";

    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0 ){

        $error[] = 'User already exist!'; 

    }else{

        if($password != $cpassword){
            $error[] = 'Password not matched!'; 
        }else{
            $insert = "INSERT INTO user_form (Name, Email, Password, User_type) VALUES('$name', '$email', '$password', '$user_type')";
            mysqli_query($conn, $insert);
            header('location:Login_form.php');
        }
    }

};

?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register Form</title>
        <link rel="stylesheet" href="CSS/Style.css">
    </head>
    <body>

        <div class="form_container">

            <form action="" method="post">
                <h3>Register Now</h3>
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
                <input type="password" name="cpassword" required placeholder="Confirm your password">
                <select name="user_type">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
                <input type="submit" name="Submit" value="Register now" class="form-btn">
                <p>Already have an Account? <a href="Login_form.php">Login now</a></p>
            </form>
        </div>

    </body>
</html>