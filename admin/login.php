<?php include('../config/constant.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login -Food Order System</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>

        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>
            <?php
             if(isset($_SESSION['login'])){
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            if(isset($_SESSION['no-login-message'])){
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }
            ?>
            <br><br>
            <!-- login start here -->

           <form action="" method="post" class="text-center">
            Username:
            <br>
            <input type="text" name="username" placeholder="Enter Username">
            <br><br>
            password:
            <br>
            <input type="password" name="password" placeholder="Enter Password">
            <br><br>
            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>
           </form>
             <!-- login ends here -->

            <p class="text-center">Created by <a href="#">Forson</a></p>
        </div>

</body>
</html>

<?php
    // check whether the submit button is clicked or not

    if(isset($_POST['submit'])){
         // process for login
        // 1. get date from form
           // $username = $_POST['username'];
             $password = md5($_POST['password']);
           //because of sql injection we ude this rather
            $username = mysqli_real_escape_string($conn,$_POST['username']);
           // $username = mysqli_real_escape_string($conn,md5($_POST['password']));
          

        //2. create sql to check whether the username and password exist or not
            $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'";
        //3. execurte the query
            $res = mysqli_query($conn,$sql);
        //4. count rows to check whether user exist or not
            $count = mysqli_num_rows($res);
            if($count == 1){
                // user available and login success
                $_SESSION['login'] = "<div class='success'>Login Successful</div>";
                $_SESSION['user'] = $username; // to check whether the user is logged in or not
                header('location:'.HOMEURL.'admin/index.php');
            }else{
                // users not available and login fail
                $_SESSION['login'] = "<div class='error text-center'>Wrong Username or Password</div>";
                header('location:'.HOMEURL.'admin/login.php');
            }


    }

?>