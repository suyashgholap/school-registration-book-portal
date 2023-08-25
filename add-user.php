<?php
require "config.php";
if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit;
}
if ($_SESSION['uid'] != 1) {
    header("Location: ./index.php");
}
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $passwd = $_POST['psw'];
    $rpasswd = $_POST['psw-repeat'];
    $preve = $_POST['preve'];
    $sql = "SELECT username FROM tbl_user WHERE username = '$username';";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
        if (strcmp($passwd, $rpasswd) == 0) {
            $password = password_hash($passwd, PASSWORD_DEFAULT);
            $sql =  "INSERT INTO tbl_user (prev_id, username, user_name, passwd) VALUES (?,?,?,?);";
            $stmtinsert = $conn->prepare($sql);
            $result = $stmtinsert->execute([$preve, $username, $name, $password]);
        }
    }
}
?>
<html>
<head>
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/all.css">
    <title>Add User</title>

    <link rel="icon" type="image/x-icon" href="./assets/education.png">
</head>
<body>
    <?php require_once('navbar.php'); ?>
    <div class="row1">
        <div class="columnz left">
            <?php require_once('admin-sidebar.php'); ?>
        </div>
        <div class="columnz right">
            <h1>User Registration Form</h1>
            <div class="addform">
                <form action="./add-user.php" method="post" class="useradd">
                    <table>
                        <tbody>
                            <tr>
                                <td><label for="name">Enter Full Name</label></td>
                                <td><input type="text" placeholder="Enter Name" name="name" id="name" required></td>
                            </tr>
                            <tr>
                                <td><label for="email">Enter Username</label></td>
                                <td><input type="text" placeholder="Enter Username" name="username" id="username" required></td>
                            </tr>
                            <tr>
                                <td><label for="psw">Password</label></td>
                                <td><input type="password" placeholder="Enter Password" name="psw" id="psw" required></td>
                            </tr>
                            <tr>
                                <td><label for="psw-repeat">Repeat Password</label></td>
                                <td><input type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" required></td>
                            </tr>
                            <tr>
                                <td><label for="psw-repeat">Select User Type</label></td>
                                <td>
                                    <select class="select" name="preve" id="preve">
                                        <?php
                                        $sql = "SELECT * FROM tbl_userprev;";
                                        $result = $conn->query($sql);
                                        ?>
                                        <?php if ($result->num_rows > 0) : ?>
                                            <?php while ($row = $result->fetch_assoc()) : ?>
                                                <option value="<?php echo $row['prev_id']; ?>"><?php echo $row['user_type']; ?></option>
                                            <?php endwhile; ?>
                                        <?php endif; ?>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="submit" name="submit" class="addbtn">Add</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>