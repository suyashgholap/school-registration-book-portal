<?php
require "config.php";
if (isset($_SESSION['uid'])) {
    header("Location: index.php");
}
if (isset($_POST['submit'])) {
    $uname = $_POST['uname'];
    $password = $_POST['password'];
    $sql = "SELECT `user_id`,`prev_id`,`username`,`user_name`,`passwd` FROM tbl_user WHERE `username` = '$uname';";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        session_start();
        $row = $result->fetch_assoc();        
        if(password_verify($password,$row['passwd'])){
            $_SESSION['uid'] = $row['user_id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['user_name'] = $row['user_name'];
            $_SESSION['prev_id'] = $row['prev_id'];
            $sql = "SELECT school_udise FROM school_master WHERE id = 1;";
            $result = $conn->query($sql);
            if ($result->num_rows == 1) {                
                $row = $result->fetch_assoc();
                echo $row['school_udise'];
                if(empty($row['school_udise'])){
                    $errmsg = "1";
                    header("Location: admin-control.php?err=".$errmsg);
                }else{
                    header("Location: index.php");
                }
            }
        }else{
            $err = "Invalid Login Credentials";    
        }
    }else{
        $err = "Invalid Login Credentials";        
    }
    $conn->close();
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="./assets/education.png">
    <style>
        p{
            color: red;
            text-align: center;
            padding: 5px 0;
        }
    </style>
</head>
<body>
    <div class="info">
        <h1>Welcome to Online General Register Management Portal</h1>
        <h2>Features</h2>
        <ul>
            <li>Admin Control</li>
            <li>Principal, Clerk and Teacher Login</li>
            <li>Auto Generate Bonafide, Leaving Certificate and Many more</li>
            <li>Student Information and Status Management</li>
            <li>Multiple General Register Book Support</li>
            <li>Secure Data Storage</li>
        </ul>
        <footer>
            <h2>Developed By - <i class="fa fa-fw fa-desktop"></i> Suyash Sanjay Gholap  <i class="fa fa-fw fa-phone"></i> 9075212173 <i class="fa fa-fw fa-envelope"></i> contact@suyashgholap.dev <i class="fa fa-fw fa-sitemap"></i> <a href="https://suyashgholap.dev"> https://suyashgholap.dev </a></h2>            
        </footer>
    </div>
    <div class="bg-img">
        <form method="post" action="login.php" class="container">
            <label for="username">Username :</label>
            <input type="text" name="uname" id="uname">
            <label for="password">Password :</label>
            <input type="password" name="password" id="password">
            <p><?php echo $err; ?></p>
            <input type="submit" name="submit" class="btn" value="Log In">
        </form>
    </div>
</body>
</html>