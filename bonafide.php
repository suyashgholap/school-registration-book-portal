<?php
include "_function.php";
require "./config.php";
if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit;
}
if ($_SESSION['prev_id'] == 2) {
    header("Location: ./index.php");
}
$grn =  $_GET['id'];
$tble =  $_GET['xyz'];
$sql = "SELECT * FROM $tble WHERE student_id = '$grn';";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bonafile Template</title>
    <link rel="icon" type="image/x-icon" href="./assets/education.png">
    <link rel="stylesheet" href="./autofiles/bonafide.css">
</head>
<body>
    <div class="certdiv" id="bonafidecertificate" onload="display()">
        <div class="header">
            <h1>बोनाफाईड दाखला</h1>
        </div>
        <br><br>
        <div class="start row">
            <div class="from column">
                <h3>मुख्याध्यापक,</h3>
                <h3>जिल्हा परिषद प्राथमिक शाळा, शिर्डी </h3>
                <h3>ता. राहाता, जि. अहमदनगर </h3>
            </div>
            <div class="jno column">
                <h3>जा.क्र. :</h3>
            </div>
        </div>
        <br>
        <div class="centerdiv">
            <p>यांजकडून दाखला देण्यात येतो की,</p>
        </div>
        <br>
        <div class="body">
            <p><b><?php echo $row['student_fname'] . ' ' . $row['student_mname'] . ' ' . $row['student_lname']; ?></b><?php if ($row['student_gender'] == 'M') {
                                                                                                                            echo " हा विध्यार्थी ";
                                                                                                                        } else {
                                                                                                                            echo " ही विद्यार्थिनी ";
                                                                                                                        } ?>आमच्या शाळेत शिकत <?php if ($row['student_status'] == 0) {
                                                                                                                                                    if ($row['student_gender'] == 'M') {
                                                                                                                                                        echo " होता.";
                                                                                                                                                    } else {
                                                                                                                                                        echo " होती.";
                                                                                                                                                    }
                                                                                                                                                } else {
                                                                                                                                                    echo " आहे.";
                                                                                                                                                } ?>
                जन. रजिस्टर मधील नोंदीप्रमाणे, <?php if ($row['student_gender'] == 'M') {
                                                    echo " त्याची ";
                                                } else {
                                                    echo " तिची ";
                                                } ?> जन्मतारीख (अंकी) : <b><?php echo $row['student_dob']; ?></b> (अक्षरी) : <b><?php echo marathi_date($row['student_dob']); ?></b>
                धर्म व जात : <b><?php echo $row['student_religion'] . ' - ' . $row['student_caste']; ?></b> जन. रजिस्टर नं. <b><?php echo $row['student_grn']; ?></b> जन्मठिकाण : <b><?php echo $row['student_dob_place'] . ', ' . $row['student_dob_dist'] . ', ' . $row['student_dob_state']; ?></b> आईचे नाव : <b><?php echo $row['student_mothername']; ?></b>
                आधार नं <b><?php echo $row['student_uid']; ?></b> Student-Id : <b><?php echo $row['student_sid']; ?></b> याप्रमाणे असून,
                सादर <?php if ($row['student_gender'] == 'M') {
                            echo " विध्यार्थी ";
                        } else {
                            echo " विद्यार्थिनी ";
                        } ?> <b>इयत्ता <?php echo $row['student_currnstd']; ?></b> मध्ये शिकत <?php if ($row['student_status'] == 0) {
                                                                                                    if ($row['student_gender'] == 'M') {
                                                                                                        echo " होता.";
                                                                                                    } else {
                                                                                                        echo " होती.";
                                                                                                    }
                                                                                                } else {
                                                                                                    echo " आहे.";
                                                                                                } ?></p>
        </div>
        <div>
            <p>म्हणून हा दाखला दिला असे. </p>
        </div>
        <br>
        <div class="bodynotice">
            <p>(वरील माहिती शालेय जनरल रजिस्टर नं. १ मधील नोंदीप्रमाणे योग्य व अचूक असल्याची खात्री करून दिलेली आहे.)</p>
        </div>
        <div class="bodynotice">
            <p>दिनांक : <?php print date("d/m/Y"); ?></p>
        </div>
        <br><br><br>
        <div class="psign">
            <p>मुख्याध्यापक,</p>
            <p>जिल्हा परिषद प्राथमिक शाळा, शिर्डी</p>
            <p>ता. राहाता, जि. अहमदनगर</p>
        </div>
    </div>
</body>
</html>