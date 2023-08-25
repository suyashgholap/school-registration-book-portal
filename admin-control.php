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
    /* ----------U P D A T E    S C H O O L    D A T A   -----------------*/
    $school_name = $_POST['school_name'];
    $school_village = $_POST['school_village'];
    $school_taluka = $_POST['school_taluka'];
    $school_district = $_POST['school_district'];
    $school_state = $_POST['school_state'];
    $school_managing_auth = $_POST['school_managing_auth'];
    $school_contactno = $_POST['school_contactno'];
    $school_email = $_POST['school_email'];
    $school_accreditationno = $_POST['school_accreditationno'];
    $school_affiliationno = $_POST['school_affiliationno'];
    $school_udise = $_POST['school_udise'];
    $school_board = $_POST['school_boards'];
    $school_medium = $_POST['school_medium'];
    $sql =  "UPDATE school_master SET school_name = '$school_name',school_village = '$school_village',school_taluka = '$school_taluka',school_district = '$school_district',school_state = '$school_state',school_managing_auth = '$school_managing_auth',school_contactno = '$school_contactno',school_email = '$school_email',school_accreditationno = '$school_accreditationno',school_affiliationno = '$school_affiliationno',school_udise = '$school_udise',school_board = '$school_boards',school_medium = '$school_medium' WHERE id = '1';";
    $stmtinsert = $conn->prepare($sql);
    $result = $stmtinsert->execute();
    $result = $conn->query($sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/all.css">
    <title>Admin Dashboard</title>
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
            <?php
            if ($_GET) {
                echo "<script>alert('School Data Not Set, Please Set all the to Use the System')</script>";
            }
            ?>
            <?php
            $sql = "SELECT * FROM school_master WHERE id = '1';";
            $result = $conn->query($sql);
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
            }
            ?>
            <div class="editform">
                <form enctype="multipart/form-data" action="admin-control.php" method="post">
                    <h1>School Details</h1>
                    <table>
                        <tr>
                            <td><label for="lc_srn">School Name <span class="require">*</span></label></td>
                            <td><input type="text" placeholder="Enter in Marathi or English" name="school_name" id="stud_grn" value="<?php echo $row['school_name']; ?>" required></td>
                        </tr>
                        <tr>
                            <td><label for="lc_srn">Vilage <span class="require">*</span></label></td>
                            <td><input type="text" placeholder="Enter in Marathi or English" name="school_village" value="<?php echo $row['school_village']; ?>" id="lc_srn" required></td>
                        </tr>
                        <tr>
                            <td><label for="academic_prg">Taluka <span class="require">*</span></label></td>
                            <td><input type="text" placeholder="Enter in Marathi or English" name="school_taluka" value="<?php echo $row['school_taluka']; ?>" id="academic_prg" required></td>
                        </tr>
                        <tr>
                            <td><label for="behavior">District <span class="require">*</span></label></td>
                            <td><input type="text" placeholder="Enter in Marathi or English" name="school_district" value="<?php echo $row['school_district']; ?>" id="behavior" required></td>
                        </tr>
                        <tr>
                            <td><label for="date">State <span class="require">*</span></label></td>
                            <td><input type="text" placeholder="Enter in Marathi or English" name="school_state" value="<?php echo $row['school_state']; ?>" id="leave_date" required></td>
                        </tr>
                        <tr>
                            <td><label for="reason">Managing Authority <span class="require">*</span></label></td>
                            <td><input type="text" placeholder="Enter in Marathi or English" name="school_managing_auth" value="<?php echo $row['school_managing_auth']; ?>" id="Reason" required></td>
                        </tr>
                        <tr>
                            <td><label for="lc_srn">Contact Number <span class="require">*</span></label></td>
                            <td><input type="text" pattern="[0-9]{10}" placeholder="Enter 10 Digit Number" name="school_contactno" id="stud_grn" value="<?php echo $row['school_contactno']; ?>" required></td>
                        </tr>
                        <tr>
                            <td><label for="lc_srn">Email Address <span class="require">*</span></label></td>
                            <td><input type="text" placeholder="Email" name="school_email" id="lc_srn" value="<?php echo $row['school_email']; ?>" required></td>
                        </tr>
                        <tr>
                            <td><label for="academic_prg">Accreditation Number </label></td>
                            <td><input type="text" placeholder="" name="school_accreditationno" id="academic_prg" value="<?php echo $row['school_accreditationno']; ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="behavior">Affiliation Number</label></td>
                            <td><input type="text" placeholder="" name="school_affiliationno" value="<?php echo $row['school_affiliationno']; ?>" id="behavior"></td>
                        </tr>
                        <tr>
                            <td><label for="date">UDISE Code <span class="require">*</span></label></td>
                            <td><input type="text" pattern="[0-9]{11}" placeholder="Enter 11 Digit Number" name="school_udise" value="<?php echo $row['school_udise']; ?>" id="leave_date" required></td>
                        </tr>
                        <tr>
                            <td><label for="reason">Board Name </label></td>
                            <td><input type="text" placeholder="Enter in Marathi or English" name="school_board" value="<?php echo $row['school_board']; ?>" id="Reason"></td>
                        </tr>
                        <tr>
                            <td><label for="reason">School Medium <span class="require">*</span></label></td>
                            <td><input type="text" placeholder="Enter in Marathi or English" name="school_medium" value="<?php echo $row['school_medium']; ?>" id="Reason" required></td>
                        </tr>
                        <tr>
                            <td colspan="">
                                <button type="submit" name="submit" class="addbtn">Submit</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</body>
</html>