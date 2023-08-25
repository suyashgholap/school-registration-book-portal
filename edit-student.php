<?php
require "config.php";
date_default_timezone_set("Asia/Calcutta");
if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit;
}
if ($_SESSION['uid'] == 2) {
    header("Location: ./index.php");
}
if (isset($_POST['submit'])) {
    /* ----------U P D A T E    S T U D E N T    D A T A   -----------------*/
    $id =  $_POST['id'];
    $table =  $_POST['table'];
    $student_fname = $_POST['student_fname'];
    $student_mname = $_POST['student_mname'];
    $student_lname = $_POST['student_lname'];
    $student_grn = $_POST['student_grn'];
    $student_sid = $_POST['student_sid'];
    $student_mothername = $_POST['student_mothername'];
    $student_uid = $_POST['student_uid'];
    $student_uid = str_replace(' ', '', $student_uid);
    $arr = str_split($student_uid, 4);
    $student_uid = $arr[0] . ' ' . $arr[1] . ' ' . $arr[2];
    unset($arr);
    $student_dob = $_POST['student_dob'];
    $student_contact = $_POST['student_contact'];
    $student_gender = $_POST['student_gender'];
    $student_mothertongue = $_POST['student_mothertongue'];
    $student_category = $_POST['student_category'];
    $student_religion = $_POST['student_religion'];
    $student_caste = $_POST['student_caste'];
    $student_bpl = $_POST['student_bpl'];
    $student_dateofadmi = $_POST['student_dateofadmi'];
    $student_admistd = $_POST['student_admistd'];
    $student_currnstd = $_POST['student_currnstd'];
    $student_semieng = $_POST['student_semieng'];
    $student_admitype = $_POST['student_admitype'];
    $student_disability = $_POST['student_disability'];
    $student_disabilitytype = $_POST['student_disabilitytype'];
    $student_dispercentage = $_POST['student_dispercentage'];
    $student_dob_place = $_POST['student_dob_place'];
    $student_dob_dist = $_POST['student_dob_dist'];
    $student_dob_state = $_POST['student_dob_state'];
    $student_addr_hno = $_POST['student_addr_hno'];
    $student_addr_strtname = $_POST['student_addr_strtname'];
    $student_addr_village = $_POST['student_addr_village'];
    $student_addr_post = $_POST['student_addr_post'];
    $student_addr_tal = $_POST['student_addr_tal'];
    $student_addr_dist = $_POST['student_addr_dist'];
    $student_addr_state = $_POST['student_addr_pin'];
    $student_addr_country = $_POST['student_addr_country'];
    $student_addr_pin = $_POST['student_addr_pin'];
    $sql =  "UPDATE $table SET student_fname = '$student_fname',student_mname = '$student_mname',student_lname = '$student_lname',student_grn = '$student_grn',student_sid = '$student_sid',student_mothername = '$student_mothername',student_uid = '$student_uid',student_dob = '$student_dob',student_contact = '$student_contact',student_gender = '$student_gender',student_mothertongue = '$student_mothertongue',student_category = '$student_category',student_religion = '$student_religion',student_caste = '$student_caste',student_bpl = '$student_bpl',student_dateofadmi = '$student_dateofadmi',student_admistd = '$student_admistd',student_currnstd = '$student_currnstd',student_semieng = '$student_semieng',student_admitype = '$student_admitype',student_disability = '$student_disability',student_disabilitytype = '$student_disabilitytype',student_dispercentage = '$student_dispercentage',student_dob_place = '$student_dob_place',student_dob_dist = '$student_dob_dist',student_dob_state = '$student_dob_state',student_addr_hno = '$student_addr_hno',student_addr_strtname = '$student_addr_strtname',student_addr_village = '$student_addr_village',student_addr_post = '$student_addr_post',student_addr_tal = '$student_addr_tal',student_addr_dist = '$student_addr_dist',student_addr_state = '$student_addr_pin',student_addr_country = '$student_addr_country',student_addr_pin = '$student_addr_pin' WHERE student_id = '$id';";
    $stmtinsert = $conn->prepare($sql);
    $result = $stmtinsert->execute();
    $result = $conn->query($sql);
    /* ----------U P D A T E    S T U D E N T    P H O T O  -----------------*/
    $target_dir = "files/student_photo/";
    $target_file = $target_dir . basename($_FILES["student_photo"]["name"]);
    if (isset($_FILES['student_photo'])) {
        $name = $_FILES['student_photo']['name'];
        $size = $_FILES['student_photo']['size'];
        $type = $_FILES['student_photo']['type'];
        $temp = $_FILES['student_photo']['tmp_name'];
        $caption1 = $_POST['caption'];
        $link = $_POST['link'];
        $str_arr = explode (".", $name);
        $name = $student_sid.'.'.$str_arr[1];
        move_uploaded_file($temp, "files/student_photo/" . $name);
        $path = $target_dir.$name;
        $sql =  "UPDATE $table SET student_photo ='$path' WHERE student_id = '$id';";
        $stmtinsert = $conn->prepare($sql);
        $result = $stmtinsert->execute();
        $result = $conn->query($sql);
    }
    header("Location: view-student.php?id=$id&xyz=$table");
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/all.css">
    <title>Edit Student Information</title>
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
            <div class="testedit">
                <h1>Edit Student Information</h1>
            </div>
            <div class="testedsp">
                <?php if ($_SESSION['prev_id'] == 1 || $_SESSION['prev_id'] == 3) : ?>
                    <a class="editst" href="./view-student.php?id=<?php echo $row['student_id']; ?>&xyz=<?php echo $tble; ?>"><i class="fa fa-fw fa-lg fa-eye"></i>View</a>
                <?php endif; ?>
            </div>
            <div class="editform">
                <form enctype="multipart/form-data" action="edit-student.php" method="post">
                    <table>
                        <h2>Personal Details</h2>
                        <input type="hidden" id="id" name="id" value="<?php echo $grn ?>">
                        <input type="hidden" id="table" name="table" value="<?php echo $tble; ?>">
                        <tr>
                            <td colspan="3"><label for="Name">Full Name</label></td>
                            <td><label for="Name">General Register No.</label></td>
                            <td><label for="Name">Student ID</label></td>
                        </tr>
                        <tr>
                            <td><input type="text" placeholder="Enter First Name" name="student_fname" id="student_fname" value="<?php echo $row['student_fname']; ?>"></td>
                            <td><input type="text" placeholder="Enter Middle Name" name="student_mname" id="student_mname" value="<?php echo $row['student_mname']; ?>"></td>
                            <td><input type="text" placeholder="Enter Last Name" name="student_lname" id="student_lname" value="<?php echo $row['student_lname']; ?>"></td>
                            <td><input type="text" placeholder="Enter General Register No" name="student_grn" id="student_grn" value="<?php echo $row['student_grn']; ?>"></td>
                            <td><input type="text" pattern="[0-9]{19}" placeholder="Enter Student ID" name="student_sid" id="student_sid" value="<?php echo $row['student_sid']; ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="Name">Student Mother Name</label></td>
                            <td><label for="Name">Aadhaar Number</label></td>
                            <td><label for="Name">Date of Birth</label></td>
                            <td><label for="Name" >Contact Number</label></td>
                            <td><label for="Name">Gender</label></td>
                        </tr>
                        <tr>
                            <td><input type="text" placeholder="Enter Mother Name" name="student_mothername" id="student_mothername" value="<?php echo $row['student_mothername']; ?>"></td>
                            <td><input type="text" placeholder="Enter Aadhaar Number" name="student_uid" id="student_uid" value="<?php echo $row['student_uid']; ?>"></td>
                            <td><input type="text" placeholder="DD/MM/YYYY" name="student_dob" id="student_dob" value="<?php echo $row['student_dob']; ?>"></td>
                            <td><input type="text" pattern="[0-9]{10}" placeholder="Enter Contact Number" name="student_contact" id="student_contact" value="<?php echo $row['student_contact']; ?>"></td>
                            <td><select name="student_gender" id="student_gender">
                                    <option value="M" <?php if ($row['student_gender'] == 'M') {
                                                            echo "selected";
                                                        } ?>>Male</option>
                                    <option value="F" <?php if ($row['student_gender'] == 'F') {
                                                            echo "selected";
                                                        } ?>>Female</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td><label for="Name">Student Mother Tongue</label></td>
                            <td><label for="Name">Category</label></td>
                            <td><label for="Name">Religion</label></td>
                            <td><label for="Name">Caste</label></td>
                            <td><label for="Name">BPL</label></td>
                        </tr>
                        <tr>
                            <td><input type="text" placeholder="Enter Mother Tongue" name="student_mothertongue" id="student_mothertongue" value="<?php echo $row['student_mothertongue']; ?>"></td>
                            <td><input type="text" placeholder="Enter Category" name="student_category" id="student_category" value="<?php echo $row['student_category']; ?>"></td>
                            <td><input type="text" placeholder="Enter Religion" name="student_religion" id="student_religion" value="<?php echo $row['student_religion']; ?>"></td>
                            <td><input type="text" placeholder="Enter Caste" name="student_caste" id="student_caste" value="<?php echo $row['student_caste']; ?>"></td>
                            <td><select name="student_bpl" id="student_bpl">
                                    <option value="Y" <?php if ($row['student_bpl'] == 'Y') {
                                                            echo "selected";
                                                        } ?>>Yes</option>
                                    <option value="N" <?php if ($row['student_bpl'] == 'N') {
                                                            echo "selected";
                                                        } ?>>No</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td colspan="5">
                                <h2>Admission Details</h2>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="Name">Date of Admission</label></td>
                            <td><label for="Name">Admission Standard</label></td>
                            <td><label for="Name">Current Standard Standard</label></td>
                            <td><label for="Name">Is Semi-English</label></td>
                            <td><label for="Name">Admission Type</label></td>
                        </tr>
                        <tr>
                            <td><input type="text" placeholder="DD/MM/YYYY" name="student_dateofadmi" id="student_dateofadmi" value="<?php echo $row['student_dateofadmi']; ?>"></td>
                            <td><select name="student_admistd" id="student_admistd">
                                    <option value="1" <?php if ($row['student_'] == '1') {
                                                            echo "selected";
                                                        } ?>>1st Standard</option>
                                    <option value="2" <?php if ($row['student_admistd'] == '2') {
                                                            echo "selected";
                                                        } ?>>2nd Standard</option>
                                    <option value="3" <?php if ($row['student_admistd'] == '3') {
                                                            echo "selected";
                                                        } ?>>3rd Standard</option>
                                    <option value="4" <?php if ($row['student_admistd'] == '4') {
                                                            echo "selected";
                                                        } ?>>4th Standard</option>
                                    <option value="5" <?php if ($row['student_admistd'] == '5') {
                                                            echo "selected";
                                                        } ?>>5th Standard</option>
                                    <option value="6" <?php if ($row['student_admistd'] == '6') {
                                                            echo "selected";
                                                        } ?>>6th Standard</option>
                                    <option value="7" <?php if ($row['student_admistd'] == '7') {
                                                            echo "selected";
                                                        } ?>>7th Standard</option>
                                    <option value="8" <?php if ($row['student_admistd'] == '8') {
                                                            echo "selected";
                                                        } ?>>8th Standard</option>
                                    <option value="9" <?php if ($row['student_admistd'] == '9') {
                                                            echo "selected";
                                                        } ?>>9th Standard</option>
                                    <option value="10" <?php if ($row['student_admistd'] == '10') {
                                                            echo "selected";
                                                        } ?>>10th Standard</option>
                                </select></td>
                            <td><select name="student_currnstd" id="student_currnstd">
                                    <option value="1" <?php if ($row['student_'] == '1') {
                                                            echo "selected";
                                                        } ?>>1st Standard</option>
                                    <option value="2" <?php if ($row['student_currnstd'] == '2') {
                                                            echo "selected";
                                                        } ?>>2nd Standard</option>
                                    <option value="3" <?php if ($row['student_currnstd'] == '3') {
                                                            echo "selected";
                                                        } ?>>3rd Standard</option>
                                    <option value="4" <?php if ($row['student_currnstd'] == '4') {
                                                            echo "selected";
                                                        } ?>>4th Standard</option>
                                    <option value="5" <?php if ($row['student_currnstd'] == '5') {
                                                            echo "selected";
                                                        } ?>>5th Standard</option>
                                    <option value="6" <?php if ($row['student_currnstd'] == '6') {
                                                            echo "selected";
                                                        } ?>>6th Standard</option>
                                    <option value="7" <?php if ($row['student_currnstd'] == '7') {
                                                            echo "selected";
                                                        } ?>>7th Standard</option>
                                    <option value="8" <?php if ($row['student_currnstd'] == '8') {
                                                            echo "selected";
                                                        } ?>>8th Standard</option>
                                    <option value="9" <?php if ($row['student_currnstd'] == '9') {
                                                            echo "selected";
                                                        } ?>>9th Standard</option>
                                    <option value="10" <?php if ($row['student_currnstd'] == '10') {
                                                            echo "selected";
                                                        } ?>>10th Standard</option>
                                </select></td>
                            <td><select name="student_semieng" id="student_semieng">
                                    <option value="Y" <?php if ($row['student_semieng'] == 'Y') {
                                                            echo "selected";
                                                        } ?>>Yes</option>
                                    <option value="N" <?php if ($row['student_semieng'] == 'N') {
                                                            echo "selected";
                                                        } ?>>No</option>
                                </select></td>
                            <td><select name="student_admitype" id="student_admitype">
                                    <option value="Regular" <?php if ($row['student_admitype'] == 'Regular') {
                                                                echo "selected";
                                                            } ?>>Regular</option>
                                    <option value="RTE 25%" <?php if ($row['student_admitype'] == 'RTE 25%') {
                                                                echo "selected";
                                                            } ?>>RTE 25%</option>
                                    <option value="Out of School" <?php if ($row['student_admitype'] == 'Out of School') {
                                                                        echo "selected";
                                                                    } ?>>Out of School</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td colspan="5">
                                <h2>Disability Details</h2>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="Name">Is Disable ?</label></td>
                            <td colspan="2"><label for="Name">Disability Type</label></td>
                            <td><label for="Name">Disability Percentage</label></td>
                        </tr>
                        <tr>
                            <td><select name="student_disability" id="student_disability">
                                    <option value="Y" <?php if ($row['student_disability'] == 'Y') {
                                                            echo "selected";
                                                        } ?>>Yes</option>
                                    <option value="N" <?php if ($row['student_disability'] == 'N') {
                                                            echo "selected";
                                                        } ?>>No</option>
                                </select></td>
                            <td colspan="2"><select name="student_disabilitytype" id="student_disabilitytype">
                                    <option value='Acid Attack Victim' <?php if ($row['student_disabilitytype'] == 'Acid Attack Victim') {
                                                                            echo 'selected';
                                                                        } ?>>Acid Attack Victim</option>
                                    <option value='Autism Spectrum Disorder' <?php if ($row['student_disabilitytype'] == 'Autism Spectrum Disorder') {
                                                                                    echo 'selected';
                                                                                } ?>>Autism Spectrum Disorder</option>
                                    <option value='Blindness' <?php if ($row['student_disabilitytype'] == 'Blindness') {
                                                                    echo 'selected';
                                                                } ?>>Blindness</option>
                                    <option value='Cerebral Palsy' <?php if ($row['student_disabilitytype'] == 'Cerebral Palsy') {
                                                                        echo 'selected';
                                                                    } ?>>Cerebral Palsy</option>
                                    <option value=' Chronic Neurological Conditions' <?php if ($row['student_disabilitytype'] == ' Chronic Neurological Conditions') {
                                                                                            echo 'selected';
                                                                                        } ?>> Chronic Neurological Conditions</option>
                                    <option value='Dwarfism' <?php if ($row['student_disabilitytype'] == 'Dwarfism') {
                                                                    echo 'selected';
                                                                } ?>>Dwarfism</option>
                                    <option value='Epidermolysis Bullosa' <?php if ($row['student_disabilitytype'] == 'Epidermolysis Bullosa') {
                                                                                echo 'selected';
                                                                            } ?>>Epidermolysis Bullosa</option>
                                    <option value='Hearing Impairment - deft and hard of hearing' <?php if ($row['student_disabilitytype'] == 'Hearing Impairment - deft and hard of hearing') {
                                                                                                        echo 'selected';
                                                                                                    } ?>>Hearing Impairment - deft and hard of hearing</option>
                                    <option value='Hemophilia' <?php if ($row['student_disabilitytype'] == 'Hemophilia') {
                                                                    echo 'selected';
                                                                } ?>>Hemophilia</option>
                                    <option value='Intellectual Disability - Mentally challenged / Slow Learners' <?php if ($row['student_disabilitytype'] == 'Intellectual Disability - Mentally challenged / Slow Learners') {
                                                                                                                        echo 'selected';
                                                                                                                    } ?>>Intellectual Disability - Mentally challenged / Slow Learners</option>
                                    <option value='Leprosy Cured Persons' <?php if ($row['student_disabilitytype'] == 'Leprosy Cured Persons') {
                                                                                echo 'selected';
                                                                            } ?>>Leprosy Cured Persons</option>
                                    <option value='Locomotor Disability including Orthopedic disability' <?php if ($row['student_disabilitytype'] == 'Locomotor Disability including Orthopedic disability') {
                                                                                                                echo 'selected';
                                                                                                            } ?>>Locomotor Disability including Orthopedic disability</option>
                                    <option value='Low vision / Partial Blind' <?php if ($row['student_disabilitytype'] == 'Low vision / Partial Blind') {
                                                                                    echo 'selected';
                                                                                } ?>>Low vision / Partial Blind</option>
                                    <option value='Mental Illness' <?php if ($row['student_disabilitytype'] == 'Mental Illness') {
                                                                        echo 'selected';
                                                                    } ?>>Mental Illness</option>
                                    <option value='Multiple Disabilities' <?php if ($row['student_disabilitytype'] == 'Multiple Disabilities') {
                                                                                echo 'selected';
                                                                            } ?>>Multiple Disabilities</option>
                                    <option value='Multiple Sclerosis' <?php if ($row['student_disabilitytype'] == 'Multiple Sclerosis') {
                                                                            echo 'selected';
                                                                        } ?>>Multiple Sclerosis</option>
                                    <option value='Muscular Dystrophy' <?php if ($row['student_disabilitytype'] == 'Muscular Dystrophy') {
                                                                            echo 'selected';
                                                                        } ?>>Muscular Dystrophy</option>
                                    <option value='Parkinson’s Disease' <?php if ($row['student_disabilitytype'] == 'Parkinson’s Disease') {
                                                                            echo 'selected';
                                                                        } ?>>Parkinson’s Disease</option>
                                    <option value='Sickle Cell Disease' <?php if ($row['student_disabilitytype'] == 'Sickle Cell Disease') {
                                                                            echo 'selected';
                                                                        } ?>>Sickle Cell Disease</option>
                                    <option value='Specific Learning Disabilities' <?php if ($row['student_disabilitytype'] == 'Specific Learning Disabilities') {
                                                                                        echo 'selected';
                                                                                    } ?>>Specific Learning Disabilities</option>
                                    <option value='Speech and Language Disability' <?php if ($row['student_disabilitytype'] == 'Speech and Language Disability') {
                                                                                        echo 'selected';
                                                                                    } ?>>Speech and Language Disability</option>
                                    <option value='Thalassemia / Cancer' <?php if ($row['student_disabilitytype'] == 'Thalassemia / Cancer') {
                                                                                echo 'selected';
                                                                            } ?>>Thalassemia / Cancer</option>
                                    <option value='' <?php if ($row['student_disabilitytype'] == '') {
                                                            echo 'selected';
                                                        } ?>>Not Applicable</option>
                                </select></td>
                            <td><input type="text" placeholder="Disability Percentage" name="student_dispercentage" id="student_dispercentage" value="<?php echo $row['student_dispercentage']; ?>"></td>
                        </tr>
                        <tr>
                            <td colspan="5">
                                <h2>Birth Details</h2>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="Name">Birth Place</label></td>
                            <td><label for="Name">Birth District</label></td>
                            <td><label for="Name">Birth State</label></td>
                        </tr>
                        <tr>
                            <td><input type="text" placeholder="Birth Place" name="student_dob_place" id="student_dob_place" value="<?php echo $row['student_dob_place']; ?>"></td>
                            <td><input type="text" placeholder="Birth District" name="student_dob_dist" id="student_dob_dist" value="<?php echo $row['student_dob_dist']; ?>"></td>
                            <td><input type="text" placeholder="Birth State" name="student_dob_state" id="student_dob_state" value="<?php echo $row['student_dob_state']; ?>"></td>
                        </tr>
                        <tr>
                            <td colspan="5">
                                <h2>Residential Address</h2>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><label for="Name">House Number</label></td>
                            <td><label for="Name">Street Name</label></td>
                            <td><label for="Name">Village</label></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="text" placeholder="House Number" name="student_addr_hno" id="student_addr_hno" value="<?php echo $row['student_addr_hno']; ?>"></td>
                            <td><input type="text" placeholder="Street Name" name="student_addr_strtname" id="student_addr_strtname" value="<?php echo $row['student_addr_strtname']; ?>"></td>
                            <td><input type="text" placeholder="Village" name="student_addr_village" id="student_addr_village" value="<?php echo $row['student_addr_village']; ?>"></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><label for="Name">Post Name</label></td>
                            <td><label for="Name">Taluka</label></td>
                            <td><label for="Name">District</label></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="text" placeholder="Post" name="student_addr_post" id="student_addr_post" value="<?php echo $row['student_addr_post']; ?>"></td>
                            <td><input type="text" placeholder="Taluka" name="student_addr_tal" id="student_addr_tal" value="<?php echo $row['student_addr_tal']; ?>"></td>
                            <td><input type="text" placeholder="District" name="student_addr_dist" id="student_addr_dist" value="<?php echo $row['student_addr_dist']; ?>"></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><label for="Name">State</label></td>
                            <td><label for="Name">Country</label></td>
                            <td><label for="Name">Pin Code</label></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="text" placeholder="State" name="student_addr_state" id="student_addr_state" value="<?php echo $row['student_addr_state']; ?>"></td>
                            <td><input type="text" placeholder="Country" name="student_addr_country" id="student_addr_country" value="<?php echo $row['student_addr_country']; ?>"></td>
                            <td><input type="text" placeholder="Pin Code" name="student_addr_pin" id="student_addr_pin" value="<?php echo $row['student_addr_pin']; ?>"></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="5"><label for="Name">Student Photo</label></td>
                        </tr>
                        <tr>
                            <td colspan="5"><input type="file" name="student_photo" id="student_photo"></td>
                        </tr>
                        <tr>
                            <td colspan="">
                                <button type="submit" name="submit" class="addbtn">Submit Changes</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</body>
</html>