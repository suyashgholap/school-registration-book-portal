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
if (isset($_POST['submit'])) {
    /*-------------------F O R M ----------------*/
    $tbl = $_POST['tbl'];
    $id = $_POST['id'];
    $stud_grn = $_POST['stud_grn'];
    $lc_srn = $_POST['lc_srn'];
    $academic_prg = $_POST['academic_prg'];
    $behavior = $_POST['behavior'];
    $reason = $_POST['Reason'];
    $leave_date = $_POST['leave_date'];
    $leave_std = $_POST['leave_std'];
    $sql = "SELECT * FROM school_master WHERE id = 1;";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $school_name = $row['school_name'];   
        $school_village = $row['school_village'];   
        $school_taluka = $row['school_taluka'];   
        $school_dist = $row['school_district'];   
        $school_state = $row['school_state'];   
        $school_auth = $row['school_managing_auth'];   
        $school_contact = $row['school_contactno'];   
        $school_email = $row['school_email'];   
        $school_accred = $row['school_addreditationno'];   
        $school_affi = $row['school_affiliationno'];   
        $school_udise = $row['school_udise'];   
        $chars = str_split($school_udise);
        $school_board = $row['school_board'];   
        $school_medium = $row['school_medium']; 
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
            $student_dob = str_replace("/","",$row['student_dob']);
            $student_prev_schoolstd = $row['student_prev_schoolstd'];
            $student_prev_schoolname = $row['student_prev_schoolname'];
            $student_dateofadmi = $row['student_dateofadmi'];
            $student_admistd = $row['student_admistd'];
            $student_status = $row['student_status'];
        }
    }
}
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="autofiles/lc.css">
    <title>LC Generator</title>
    <link rel="icon" type="image/x-icon" href="./assets/education.png">
    <style>
        .lcdiv .dup{
            font: 20px;
            color: red;
            margin: 3px;
            margin-left: 580px;
            opacity: 0.8;
            position: absolute;
        }
    </style>
</head>
<body>
    <div class="lcdiv">
        <?php if($student_status == 0): ?>
            <h1 class="dup" style="font-family: Arial, Helvetica, sans-serif;"><b>DUPLICATE</b></h1>
        <?php endif; ?>
        <div class="schoolinfo">
            <div class="tbl">
                <table class="show" style="width: 70%; margin: 0 auto;">
                    <tr>
                        <td colspan="3">व्यवस्थापनाचे नाव : </td>
                        <td> <?php echo $school_auth ?></td>
                    </tr>
                    <tr>
                        <td colspan="3">शाळेचे नाव  :<b></td>
                        <td><b> <?php echo $school_name ?></b></td>
                    </tr>
                    <tr>
                        <td colspan="3">पत्ता : </td>
                        <td>मु. पो. <?php echo $school_village ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">तालुका : <?php echo $school_taluka ?></td>
                        <td colspan="2">जिल्हा : <?php echo $school_dist ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">फोन : <?php echo $school_contact ?></td>
                        <td colspan="2">ई-मेल : <?php echo $school_email ?></td>
                    </tr>
                    <tr>
                        <td colspan="3">शाळा मान्यता क्र.  : <?php echo $school_accred ?></td>
                        <td colspan="1"><?php echo $school_accred ?></td>
                    </tr>
                </table>
            </div>
            <div class="tbl1">
                <table class="show1">
                    <tr>
                        <td>युडायस क्रमांक : </td>
                        <td>
                            <table class="udise">
                                <tr>
                                <?php foreach($chars as $c): ?>
                                    <td><?php echo $c; ?></td>
                                <?php endforeach;?>
                                </tr>
                            </table>
                        </td>
                        <td>माध्यम : <?php echo $school_medium; ?></td>
                        <td>अ. नं. : <?php echo $lc_srn;?></td>
                    </tr>
                    <tr>
                        <td>बोर्ड : </td>
                        <td><?php echo $school_board; ?></td>
                        <td colspan="2">संलग्नता क्रमांक : <?php echo $school_affi; ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="headline">
            <h1>शाळा सोडल्याचे प्रमाणप्रत्र</h1>
        </div>
        <div class="tbl1">
            <table class="show1">
                <tr>
                    <td>जनरल रजिस्टर क्र. : </td>
                    <td><?php echo $stud_grn; ?></td>
                    <td class="fake"></td>
                    <td> बुक क्र : <?php echo $student_bid; ?></td>
                </tr>
                <tr>
                    <td>स्टूडेंट आय. डी. : </td>
                    <td colspan="3">
                        <table class="udise">
                            <tr>
                                <td><?php echo $student_sid[0]; ?></td>
                                <td><?php echo $student_sid[1]; ?></td>
                                <td><?php echo $student_sid[2]; ?></td>
                                <td><?php echo $student_sid[3]; ?></td>
                                <td><?php echo $student_sid[4]; ?></td>
                                <td><?php echo $student_sid[5]; ?></td>
                                <td><?php echo $student_sid[6]; ?></td>
                                <td><?php echo $student_sid[7]; ?></td>
                                <td><?php echo $student_sid[8]; ?></td>
                                <td><?php echo $student_sid[9]; ?></td>
                                <td><?php echo $student_sid[10]; ?></td>
                                <td><?php echo $student_sid[11]; ?></td>
                                <td><?php echo $student_sid[12]; ?></td>
                                <td><?php echo $student_sid[13]; ?></td>
                                <td><?php echo $student_sid[14]; ?></td>
                                <td><?php echo $student_sid[15]; ?></td>
                                <td><?php echo $student_sid[16]; ?></td>
                                <td><?php echo $student_sid[17]; ?></td>
                                <td><?php echo $student_sid[18]; ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>आधार क्रमांक : </td>
                    <td colspan="3">
                        <table class="udise dob">
                            <tr>
                                <td><?php echo $student_uid[0]; ?></td>
                                <td><?php echo $student_uid[1]; ?></td>
                                <td><?php echo $student_uid[2]; ?></td>
                                <td><?php echo $student_uid[3]; ?></td>
                            </tr>
                        </table>
                        <table class="udise dob">
                            <tr>
                                <td><?php echo $student_uid[4]; ?></td>
                                <td><?php echo $student_uid[5]; ?></td>
                                <td><?php echo $student_uid[6]; ?></td>
                                <td><?php echo $student_uid[7]; ?></td>
                            </tr>
                        </table>
                        <table class="udise dob">
                            <tr>
                                <td><?php echo $student_uid[8]; ?></td>
                                <td><?php echo $student_uid[9]; ?></td>
                                <td><?php echo $student_uid[10]; ?></td>
                                <td><?php echo $student_uid[11]; ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        <hr class="hr">
        <div class="studinfo">
            <table class="studtbl">
                <tr >
                    <td class="left right top bot" rowspan="2">विद्यार्थ्याचे संपूर्ण नाव  : </td>
                    <td class="top">&emsp;नाव</td>
                    <td class="top">वडिलांचे नाव</td>
                    <td class="top right">&emsp;&emsp;आडनाव</td>
                </tr>
                <tr>
                    <td class="bot"><b>&emsp;<?php echo $student_fname; ?></b></td>
                    <td class="bot"><b><?php echo $student_mname; ?></b></td>
                    <td class="bot right"><b>&emsp;&emsp;<?php echo $student_lname; ?></b></td>
                </tr>
                <tr>
                    <td class="left right top bot">आईचे नाव  : </td>
                    <td colspan="3" class="bot right"><b>&emsp;<?php echo $student_mothername; ?> </b></td>
                </tr>
                <tr>
                    <td class="bot left">राष्ट्रीयत्व  : &emsp;<?php echo $student_nation; ?></td>
                    <td class="bot right" colspan="3">&emsp;मातृभाषा : &emsp;<?php echo $student_mothertongue; ?></td>
                </tr>
                <tr>
                    <td class="bot left">धर्म   :&emsp;&emsp; <?php echo $student_religion; ?></td>
                    <td class="bot">&emsp;जात  : &emsp;<?php echo $student_caste; ?></td>
                    <td class="bot right" colspan="2">पोट-जात  : &emsp;&emsp;<b>-</b></td>
                </tr>
                <tr>
                    <td class="right left">जन्मस्थळ  :</td>
                    <td class="right" colspan="3">&emsp;<?php echo $student_dob_place; ?></td>
                </tr>
                <tr>
                    <td class="bot right left">तालुका, जिल्हा, राज्य, देश  :</td>
                    <td class="bot right" colspan="3">&emsp;ता. - <?php echo $student_dob_taluka ?>, जि. - <?php echo $student_dob_dist ?>, राज्य - <?php echo $student_dob_state ?>, देश - <?php echo $student_nation ?></td>
                </tr>
                <tr>
                    <td class="right left">इ. सनाप्रमाणे जन्म दिनांक  :</td>
                    <td class="right" colspan="3">
                        <table class="udise dob">
                            <tr>
                                <td><?php echo $student_dob[0]; ?></td>
                                <td><?php echo $student_dob[1]; ?></td>
                            </tr>
                        </table>
                        <table class="udise dob">
                            <tr>
                                <td><?php echo $student_dob[2]; ?></td>
                                <td><?php echo $student_dob[3]; ?></td>
                            </tr>
                        </table>
                        <table class="udise dob">
                            <tr>
                                <td><?php echo $student_dob[4]; ?></td>
                                <td><?php echo $student_dob[5]; ?></td>
                                <td><?php echo $student_dob[6]; ?></td>
                                <td><?php echo $student_dob[7]; ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="bot right left">जन्म दिनांक अक्षरी :</td>
                    <td class="bot right" colspan="3">&emsp;<?php echo $dob_word; ?></td>
                </tr>
                <tr >
                    <td class="left right top bot" rowspan="2">या पूर्वीची शाळा व इयत्ता : </td>
                    <td colspan="3" class="top right">&emsp;<?php echo $student_prev_schoolname; ?></td>
                </tr>
                <tr>
                    <td colspan="3" class="bot right">&emsp;इयत्ता : <?php echo $student_prev_schoolstd ?></td>
                </tr>
                <tr>
                    <td class="bot left" colspan="1">या शाळेत प्रवेश घेतल्याचा दिनांक : </td>
                    <td class="bot " colspan="2">&emsp;<?php echo $student_dateofadmi; ?></td>
                    <td class="bot right">इयत्ता : &ensp;&ensp;&ensp;<?php echo $student_admistd; ?></td>
                </tr>
                <tr>
                    <td class="bot left" colspan="1">अभ्यासातील प्रगती : </td>
                    <td class="bot " colspan="2">&emsp; <?php echo $academic_prg; ?></td>
                    <td class="bot right">वर्तवणूक : &ensp; <?php echo $behavior; ?></td>
                </tr>
                <tr>
                    <td class="left right top bot">शाळा सोडल्याची दिनांक : </td>
                    <td colspan="3" class="bot right">&emsp;<?php echo $leave_date; ?></td>
                </tr>
                <tr >
                    <td class="left right top">कोणत्या इयत्तेत शिकत होता : </td>
                    <td colspan="3" class="top right">&emsp;इयत्ता : <?php echo $leave_std; ?></td>
                </tr>
                <tr>
                    <td class="left right bot">केव्हापासून : </td>
                    <td colspan="3" class="bot right">&emsp;<?php echo $student_dateofadmi; ?></td>
                </tr>
                <tr>
                    <td class="left right top bot">शाळा सोडल्याचे कारण : </td>
                    <td colspan="3" class="bot right">&emsp;<?php echo $reason; ?></td>
                </tr>
                <tr>
                    <td class="left right top bot">शेरा</td>
                    <td colspan="3" class="bot right"></td>
                </tr>
            </table>
        </div>
        <hr class="hr">
        <div class="signblock">
            <p class="padl warn">दाखला देण्यात येतो की वरील माहिती शाळेतील जनरल रजिस्टर नं. १ प्रमाणे बरोबर आहे.</p>
            <p class="padl">तारीख -  &emsp;&emsp; माहे -  &emsp;&emsp;सन - &emsp;&emsp;</p>
            <br><br>
            <table class="sign">
                <tr>
                    <td class="pad">वर्गशिक्षक</td>
                    <td>लेखनिक</td>
                    <td>मुख्याध्यापक <br> <?php echo $school_name ?><br> ता. <?php echo $school_taluka; ?> जि. <?php echo $school_dist; ?></td>
                </tr>
            </table>
            <p class="padl warn">शाळा सोडल्याच्या दाखल्यामध्ये अनधिकृतरित्या बदल केल्यास संबंधितांवर कायदेशीर कारवाई केली जाईल.</p>
        </div>
    </div>
    <?php
        $sql =  "UPDATE $tbl SET student_status = '0', student_prg = '$academic_prg',student_beha = '$behavior',student_reason = '$reason',student_left_date = '$leave_date',student_currnstd = '$leave_std' WHERE student_id = '$id';";
        $stmtinsert = $conn->prepare($sql);
        $result = $stmtinsert->execute();
        $result = $conn->query($sql);        
    ?>
</body>
</html>