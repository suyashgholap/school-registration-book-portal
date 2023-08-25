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
    $newpasswd = $_POST['new-psw'];
    $rpasswd = $_POST['psw-repeat'];
    $userid = $_POST['userid'];
    $sql = "SELECT passwd FROM tbl_user WHERE user_id = '$userid';";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        if (strcmp($newpasswd, $rpasswd) == 0) {
            $passwd = password_hash($newpasswd, PASSWORD_DEFAULT);
            $sql =  "UPDATE tbl_user SET passwd = '$passwd' WHERE user_id = '$userid';";
            $stmtinsert = $conn->prepare($sql);
            $result = $stmtinsert->execute();
        }
    }
}
?>
<html>
<head>
    <title>Change Password</title>
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="icon" type="image/x-icon" href="./assets/education.png">
</head>
<body>
    <?php require_once('navbar.php'); ?>
    <div class="row1">
        <div class="columnz left">
            <?php require_once('admin-sidebar.php'); ?>
        </div>
        <div class="columnz right">
            <h1>Password Change Form</h1>
            <div class="addform">
                <form action="./change-user-password.php" method="post" class="useradd">
                    <table>
                        <tbody>
                            <tr>
                                <td><label for="psw-repeat">Select User</label></td>
                                <td>
                                    <select class="select" name="userid" id="preve">
                                        <?php
                                        $sql = "SELECT user_id,user_name FROM tbl_user WHERE user_id != 1;";
                                        $result = $conn->query($sql);
                                        ?>
                                        <?php if ($result->num_rows > 0) : ?>
                                            <?php while ($row = $result->fetch_assoc()) : ?>
                                                <option value="<?php echo $row['user_id']; ?>"><?php echo $row['user_name']; ?></option>
                                            <?php endwhile; ?>
                                        <?php endif; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="psw">New Password</label></td>
                                <td><input type="password" placeholder="Enter New Password" name="new-psw" id="new-psw" required></td>
                            </tr>
                            <tr>
                                <td><label for="psw-repeat">Repeat New Password</label></td>
                                <td><input type="password" placeholder="Repeat New Password" name="psw-repeat" id="psw-repeat" required></td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="submit" name="submit" class="addbtn">Change Password</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>