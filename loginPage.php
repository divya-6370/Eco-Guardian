<?php
    session_start();
    if (isset($_SESSION['email'])) {
        header("Location:index.php");
        die;
    }

    include("db.php");
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if(!empty($email) && !empty($password) && !is_numeric($email)){
            $query = "SELECT * FROM form WHERE email = '$email' LIMIT 1";
            $result= mysqli_query($con, $query);

            if($result){
                if($result && mysqli_num_rows($result)>0){
                    $user_data = mysqli_fetch_assoc($result);
                    if($user_data['password'] == $password){
                        $_SESSION['email'] = $user_data['email'];
                        $_SESSION['fname'] = $user_data['fname'];
                        header("Location: index.php");
                        die;
                    }
            }
        }
        echo  "<script type='text/javascript'>alert('Wrong Username or Password')</script>";
    }
    else{
        echo  "<script type='text/javascript'>alert('Wrong Username or Password')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login">
        <h1>Login</h1>
        <form action="" method="post">
            <label>Email</label>
            <input type="email" name="email" required placeholder="Enter your email">
            <label>Password</label>
            <input type="password" name="password" required placeholder="Enter your password">
            <button type="submit" name="" value="Submit">Login</button>
        </form>
        <p>Don't have an account? <a href="signup.php">Register now</a></p>
    </div>
</body>
</html>