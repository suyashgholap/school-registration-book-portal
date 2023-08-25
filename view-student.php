<?php
require "config.php";
if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit;
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/datatable.css">
    <title>View Student Information</title>
    <link rel="icon" type="image/x-icon" href="./assets/education.png">
</head>

<body>
    <?php require_once('navbar.php'); ?>
    <div class="row1">
        <div class="columnz left">
            <?php require_once('sidebar.php'); ?>
        </div>
        <div class="columnz right">
            <?php
                $grn =  $_GET['id'];
                $tble =  $_GET['xyz'];
                $sql = "SELECT * FROM $tble WHERE student_id = '$grn';";
                $result = $conn->query($sql);
                if ($result->num_rows == 1) {
                    $row = $result->fetch_assoc();
                }
            ?>
            <div class="testedit"><h1>Student Information</h1></div>
            <div  class="testedsp">
                <?php if ($_SESSION['prev_id'] == 1 || $_SESSION['prev_id'] == 3) : ?>
                    <a class="editst" href="./edit-student.php?id=<?php echo $row['student_id'];?>&xyz=<?php echo $tble;?>"><i class="fa fa-fw fa-lg fa-edit"></i>Edit</a>
                <?php endif; ?>
            </div>
            <table class="show1">
                <tbody>
                    <tr>
                        <td>GRN Number</td>
                        <td><?php echo $row['student_grn']; ?></td>
                        <td>Student Current Standard</td>
                        <td><?php echo $row['student_currnstd']; ?></td>
                        <td rowspan="7" colspan="2"><div class="imgs"><img src="<?php echo $row['student_photo']; ?>"></div></td>
                    </tr>
                    <tr>
                        <td>Full Name</td>
                        <td><?php echo $row['student_fname'] . ' ' . $row['student_mname'] . ' ' . $row['student_lname']; ?></td>
                        <td>Student Saral Portal ID</td>
                        <td><?php echo $row['student_sid']; ?></td>
                    </tr>
                    <tr>
                        <td>Student Mother Name</td>
                        <td><?php echo $row['student_mothername']; ?></td>
                        <td>Student Aadhar</td>
                        <td><?php echo $row['student_uid']; ?></td>                        
                    </tr>
                    <tr>
                        <td>Date of Birth</td>
                        <td><?php echo $row['student_dob']; ?></td>
                        <td>Contact Number</td>
                        <td><?php echo $row['student_contact']; ?></td>                        
                    </tr>
                    <tr>
                        <td>Mother Tongue</td>
                        <td><?php echo $row['student_mothertongue']; ?></td>
                        <td>Student Gender</td>
                        <td><?php if ($row['student_gender'] == 'M') {
                            echo 'Male';
                        } else {
                            echo 'Female';
                        } ?></td>
                    </tr>
                    <tr>                        
                        <td>Category</td>
                        <td><?php echo $row['student_category']; ?></td>
                        <td>Religion - Caste</td>
                        <td><?php echo $row['student_religion'].' - '.$row['student_caste']; ?></td>
                    </tr>
                    <tr>
                        <td>Below Proverty (BPL)</td>
                        <td><?php if ($row['student_bpl'] == 'Y') {
                                echo 'Yes';
                            } else {
                                echo 'No';
                            } ?></td>
                        <td>Semi English</td>
                        <td><?php if ($row['student_semieng'] == 'Y') {
                                echo 'Yes';
                            } else {
                                echo 'No';
                            } ?></td>
                    </tr>
                    <tr>
                        <td colspan="6"><h2>Other Details</h2></td>
                    </tr>
                    <tr>
                        <td>Is Disable ?</td>
                        <td><?php if ($row['student_disability'] == 'Y') {
                                echo 'Yes';
                            } else {
                                echo 'No';
                            } ?></td>
                        <td>Disability Type</td>
                        <td><?php if ($row['student_disabilitytype'] == NULL) {
                                echo 'Null';
                            } else {
                                echo $row['student_disabilitytype'];
                            } ?></td>
                        <td>Disability %</td>
                        <td><?php if ($row['student_dispercentage'] == NULL) {
                                echo 'Null';
                            } else {
                                echo $row['student_dispercentage'];
                            } ?></td>
                    </tr>
                    <tr>
                        <td colspan="6"><h2>Admission Details</h2></td>
                    </tr>
                    <tr>
                        <td>Date of Admission</td>
                        <td><?php echo $row['student_dateofadmi']; ?></td>
                        <td>Admission Class</td>
                        <td><?php echo $row['student_admistd']; ?></td>
                        <td>Admission Type</td>
                        <td><?php echo $row['student_admitype']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="6"><h2>Birth Details</h2></td>
                    </tr>
                    <tr>
                        <td>Birth Place</td>
                        <td><?php echo $row['student_dob_place']; ?></td>
                        <td>Birth District</td>
                        <td><?php echo $row['student_dob_dist']; ?></td>
                        <td>Birth State</td>
                        <td><?php echo $row['student_dob_state']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="6"><h2>Residential Address</h2></td>
                    </tr>
                    <tr>
                        <td>House No</td>
                        <td><?php echo $row['student_addr_hno']; ?></td>
                        <td>Street Name</td>
                        <td><?php echo $row['student_addr_strtname']; ?></td>
                        <td>Village</td>
                        <td><?php echo $row['student_addr_village']; ?></td>
                    </tr>
                    <tr>
                        <td>Post</td>
                        <td><?php echo $row['student_addr_post']; ?></td>
                        <td>Taluka</td>
                        <td><?php echo $row['student_addr_tal']; ?></td>
                        <td>District</td>
                        <td><?php echo $row['student_addr_dist']; ?></td>
                        
                    </tr>
                    <tr>
                        <td>State</td>
                        <td><?php echo $row['student_addr_state']; ?></td>
                        <td>Country</td>
                        <td><?php echo $row['student_addr_country']; ?></td>
                        <td>Pin Code</td>
                        <td><?php echo $row['student_addr_pin']; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>