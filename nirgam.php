<?php
include "_function.php";
require "config.php";
if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit;
}
if ($_SESSION['prev_id'] == 2) {
    header("Location: ./index.php");
}
$id =  $_GET['id'];
$tbl =  $_GET['xyz'];
$stud_grn = $_GET['grn'];
$sql = "SELECT * FROM school_master WHERE id = 1;";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $school_name = $row['school_name'];   
    $school_village = $row['school_village'];   
    $school_taluka = $row['school_taluka'];   
    $school_dist = $row['school_district'];
    $sql = "SELECT * FROM $tbl WHERE student_id = '$id';";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $student_sid = $row['student_sid'];
        $student_uid = str_replace(" ","",$row['student_uid']);
        $student_bid = $row['student_bid'];
        $student_fname = $row['student_fname'];
        $student_mname = $row['student_mname'];
        $student_lname = $row['student_lname'];
        $student_mothername = $row['student_mothername'];
        $student_mothertongue = $row['student_mothertongue'];
        $student_nation = $row['student_nation'];
        $student_caste = $row['student_caste'];
        $student_religion = $row['student_religion'];
        $student_dob_place = $row['student_dob_place'];
        $student_dob_taluka = $row['student_dob_taluka'];
        $student_dob_dist = $row['student_dob_dist'];
        $student_dob_state = $row['student_dob_state'];
        $student_dob = $row['student_dob'];
        $dob_word = marathi_date($row['student_dob']);
        $student_prev_schoolstd = $row['student_prev_schoolstd'];
        $student_prev_schoolname = $row['student_prev_schoolname'];
        $student_dateofadmi = $row['student_dateofadmi'];
        $student_admistd = $row['student_admistd'];
        $student_status = $row['student_status'];
        $academic_prg = $row['student_prg'];
        $behavior = $row['student_beha'];
        $reason = $row['student_reason'];
        $leave_date = $row['student_left_date'];
        $leave_std = $row['student_currnstd'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pravesh Nirgam</title>
    <link rel="stylesheet" href="autofiles/nirgam.css">
    <link rel="icon" type="image/x-icon" href="./assets/education.png">
</head>
<body>
    <div class="nirgam">
        <h1 class="head">विद्यार्थी प्रवेश निर्गम उतारा</h1>
        <h1 class=""><?php echo $school_name.'  ता. '.$school_taluka.' जि. '.$school_dist; ?></h1>
        <div class="nirgamtable">
            <table>
                <tr class="header">
                    <td rowspan="2">जनरल रजिस्टर क्र.</td>
                    <td rowspan="2">स्टुडन्ट आय. डी. (सरल मधील)</td>
                    <td rowspan="2">यु. आय. डी. (आधार क्र.)</td>
                    <td rowspan="2">विद्यार्थ्यांचे पूर्ण नाव</td>
                    <td rowspan="2">आईचे नाव</td>
                    <td rowspan="2">राष्ट्रीयत्व</td>
                    <td rowspan="2">मातृभाषा</td>
                    <td rowspan="2">धर्म</td>
                    <td rowspan="2">जात</td>
                    <td rowspan="2">जन्मस्थळ</td>
                    <td colspan="2">जन्म दिनांक</td>
                    <td colspan="2">या पूर्वीची शाळा व इयत्ता</td>
                    <td rowspan="2">प्रवेश दिनांक</td>
                    <td colspan="2">कोणत्या इयत्तेत व कधीपासून होता</td>
                    <td rowspan="2">अभ्यासातील प्रगती</td>
                    <td rowspan="2">वर्तवणूक</td>
                    <td rowspan="2">शाळा सोडण्याचे कारण</td>
                </tr>
                <tr class="header">              
                    <td>अंकी</td>
                    <td>अक्षरी</td>
                    <td>शाळेचे नाव</td>
                    <td>इयत्ता</td>
                    <td>इयत्ता</td>
                    <td>कधीपासून</td>
                </tr>
                <tr class="header">
                    <td><?php echo $stud_grn ?></td>
                    <td><?php echo $student_sid ?></td>
                    <td><?php echo $student_uid ?></td>
                    <td><?php echo $student_fname.' '.$student_mname.' '.$student_lname; ?></td>
                    <td><?php echo $student_mothername ?></td>
                    <td><?php echo $student_nation ?></td>
                    <td><?php echo $student_mothertongue ?></td>
                    <td><?php echo $student_religion ?></td>
                    <td><?php echo $student_caste ?></td>
                    <td><?php echo $student_dob_place.'  ता. '.$student_dob_taluka.' जि. '.$student_dob_dist; ?></td>
                    <td><?php echo $student_dob ?></td>
                    <td><?php echo $dob_word ?></td>
                    <td><?php echo $student_prev_schoolname; ?></td>
                    <td><?php echo $student_prev_schoolstd; ?></td>
                    <td><?php echo $student_dateofadmi; ?></td>
                    <td><?php echo $student_admistd ?></td>
                    <td><?php echo $student_dateofadmi; ?></td>
                    <td><?php echo $academic_prg ?></td>
                    <td><?php echo $behavior ?></td>
                    <td><?php echo $reason ?></td>
                </tr>
            </table>
        </div>
    </div>    
</body>
</html>
