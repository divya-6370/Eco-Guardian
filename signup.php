<?php
    session_start();

    include("db.php");
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $firstname = $_POST['fname'];
        $lastname = $_POST['lname'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        if(!empty($email) && !empty($password) && !is_numeric($email))
        {
            $query= "insert into form(fname, lname, gender, email, password) values ('$firstname', '$lastname', '$gender', '$email', '$password')";
            mysqli_query($con, $query);

            echo "<script type='text/javascript'>alert('You have successfully signed up!'); window.location.href='loginPage.php';</script>";
        }
        else{
            $_SESSION['email'] = $email;
            $_SESSION['fname'] = $firstname;

            echo "<script type='text/javascript'>alert('You have successfully signed up!'); window.location.href='index.php';</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="signup">
        <h1>Sign Up</h1>
        <h4>One step towards climate action</h4>
        <form action="" method="post">
            <label>First Name</label>
            <input type="text" name="fname" required placeholder="Enter your first name">
            <label>Last Name</label>
            <input type="text" name="lname" required placeholder="Enter your last name">
            <label>Gender</label>
            <input type="text" name="gender" required placeholder="Enter your gender">
            <label>Email</label>
            <input type="email" name="email" required placeholder="Enter your email">
            <label>Password</label>                     
            <input type="password" name="password" required placeholder="Enter your password">
            <input type="submit" name="submit" value="Sign Up">
        </form>
            <p>Already have an account? <a href="loginPage.php">Login</a></p>
    </div>
</body>
</html>