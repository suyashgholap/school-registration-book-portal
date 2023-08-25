<?php
require "config.php";
if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit;
}
if ($_SESSION['uid'] != 1) {
    header("Location: ./index.php");
}
$uid = $_SESSION['uid'];
if (isset($_POST['submit'])) {
    $uname = $_POST['uname'];
    $passwd = $_POST['passwd'];
    $book_number = $_POST['book_number'];
    $start_point = $_POST['start_point'];
    $sql = "SELECT * FROM tbl_user WHERE user_id = '$uid' and prev_id = 1;";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if ((strcmp($passwd, $row['passwd']) == 0)) {
            $sql = "UPDATE tbl_books SET book_active = 0 WHERE book_active = 1;";
            $stmtinsert = $conn->prepare($sql);
            $result = $stmtinsert->execute();
            $book_name = "tbl_book_" . $book_number;
            $sql = "INSERT INTO tbl_books (book_name,book_number,start_point,book_current,book_active) VALUES ('$book_name','$book_number','$start_point','$start_point','1') ;";
            $stmtinsert = $conn->prepare($sql);
            $result = $stmtinsert->execute();
            $sql = "CREATE TABLE $book_name (
                `student_id` int(11) NOT NULL AUTO_INCREMENT,
                `student_grn` int(11) NOT NULL,
                `student_bid` int(11) NOT NULL,
                `student_sid` text NOT NULL,
                `student_currnstd` int(11) NOT NULL,
                `student_fname` text DEFAULT NULL,
                `student_mname` text DEFAULT NULL,
                `student_lname` text DEFAULT NULL,
                `student_mothername` text DEFAULT NULL,
                `student_gender` text DEFAULT NULL,
                `student_dob` text DEFAULT NULL,
                `student_mothertongue` text DEFAULT NULL,
                `student_contact` text DEFAULT NULL,
                `student_category` text DEFAULT NULL,
                `student_caste` text DEFAULT NULL,
                `student_religion` text DEFAULT NULL,
                `student_bpl` text DEFAULT NULL,
                `student_semieng` text DEFAULT NULL,
                `student_dateofadmi` text DEFAULT NULL,
                `student_admistd` text DEFAULT NULL,
                `student_admitype` text DEFAULT NULL,
                `student_prev_schoolname` text NOT NULL,
                `student_prev_schoolstd` text NOT NULL,
                `student_uid` text DEFAULT NULL,
                `student_photo` text DEFAULT NULL,
                `student_disability` text DEFAULT NULL,
                `student_disabilitytype` text DEFAULT NULL,
                `student_dispercentage` text DEFAULT NULL,
                `student_nation` text DEFAULT NULL,
                `student_dob_place` text DEFAULT NULL,
                `student_dob_taluka` text NOT NULL,
                `student_dob_dist` text DEFAULT NULL,
                `student_dob_state` text DEFAULT NULL,
                `student_addr_hno` text DEFAULT NULL,
                `student_addr_strtname` text DEFAULT NULL,
                `student_addr_pin` text DEFAULT NULL,
                `student_addr_state` text DEFAULT NULL,
                `student_addr_dist` text DEFAULT NULL,
                `student_addr_tal` text NOT NULL,
                `student_addr_village` text NOT NULL,
                `student_addr_post` text DEFAULT NULL,
                `student_addr_country` text NOT NULL,
                `student_status` int(11) DEFAULT NULL,
                `student_left_date` text DEFAULT NULL,
                `student_prg` text NOT NULL,
                `student_beha` text NOT NULL,
                `student_reason` text NOT NULL,
                PRIMARY KEY (`student_id`),
                FOREIGN KEY (`student_bid`) REFERENCES `tbl_books` (`book_id`),  
                UNIQUE KEY `student_grn` (`student_grn`)
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
            $stmtinsert = $conn->prepare($sql);
            $result = $stmtinsert->execute();
        }
    }
}
?>
<html>
<head>
    <title>Add Register</title>
    <link rel="stylesheet" href="css/all.css">
    <link rel="icon" type="image/x-icon" href="./assets/education.png">
    <link rel="icon" type="image/x-icon" href="./assets/education.png">
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/datatable.css">
    <style>
        .editform form {
            margin: 3px auto;
            width: 50%;
        }
    </style>
</head>
<body>
    <?php require_once('navbar.php'); ?>
    <div class="row1">
        <div class="columnz left">
            <?php require_once('admin-sidebar.php'); ?>
        </div>
        <div class="columnz right">
            <div class="editform">
                <form enctype="multipart/form-data" action="add-regi-table.php" method="post">
                    <h1>Add New Register Book (This is irreversible)</h1>
                    <table>
                        <tr>
                            <td><label for="lc_srn">Enter Admin Username <span class="require">*</span></label></td>
                            <td><input type="text" placeholder="Enter Username" name="uname" required></td>
                        </tr>
                        <tr>
                            <td><label for="lc_srn">Enter Admin Password <span class="require">*</span></label></td>
                            <td><input type="password" placeholder="Enter Password" name="passwd" required></td>
                        </tr>
                        <tr>
                            <td><label for="lc_srn">Book Number <span class="require">*</span></label></td>
                            <td><input type="text" placeholder="Enter Book Number" name="book_number" required></td>
                        </tr>
                        <tr>
                            <td><label for="lc_srn">Start From <span class="require">*</span></label></td>
                            <td><input type="text" placeholder="Enter a Number" name="start_point" required></td>
                        </tr>
                        <tr>
                            <td colspan="">
                                <button type="submit" name="submit" class="addbtn">Add </button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</body>
</html>