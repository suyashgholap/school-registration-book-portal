<?php
require "config.php";
if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit;
}
if ($_SESSION['prev_id'] == 2) {
    header("Location: ./index.php");
}
if (isset($_POST['submit'])) {
    /* ----------I N S E R T    S T U D E N T    D A T A   -----------------*/
    $table = $_POST['book_name'];
    $bid = $_POST['book_id'];
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
    $student_prev_schoolname = $_POST['student_prev_schoolname'];
    $student_prev_schoolstd = $_POST['student_prev_schoolstd'];
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
    $student_dob_taluka = $_POST['student_dob_taluka'];
    $sql = "SELECT student_grn FROM $table WHERE student_grn = '$student_grn';";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
        $sql =  "INSERT INTO $table (student_dob_taluka,student_prev_schoolname,student_prev_schoolstd,student_status,student_bid,student_fname,student_mname,student_lname,student_grn,student_sid,student_mothername,student_uid,student_dob,student_contact,student_gender,student_mothertongue,student_category,student_religion,student_caste,student_bpl,student_dateofadmi,student_admistd,student_currnstd,student_semieng,student_admitype,student_disability,student_disabilitytype,student_dispercentage,student_dob_place,student_dob_dist,student_dob_state,student_addr_hno,student_addr_strtname,student_addr_village,student_addr_post,student_addr_tal,student_addr_dist,student_addr_state,student_addr_country,student_addr_pin) VALUES ('$student_dob_taluka','$student_prev_schoolname','$student_prev_schoolstd', '1','$bid','$student_fname','$student_mname','$student_lname','$student_grn','$student_sid','$student_mothername','$student_uid','$student_dob','$student_contact','$student_gender','$student_mothertongue','$student_category','$student_religion','$student_caste','$student_bpl','$student_dateofadmi','$student_admistd','$student_admistd','$student_semieng','$student_admitype','$student_disability','$student_disabilitytype','$student_dispercentage','$student_dob_place','$student_dob_dist','$student_dob_state','$student_addr_hno','$student_addr_strtname','$student_addr_village','$student_addr_post','$student_addr_tal','$student_addr_dist','$student_addr_state','$student_addr_country','$student_addr_pin') ;";
        $conn->query($sql);
        $grn = $student_grn + 1;
        $sql = "UPDATE tbl_books SET `book_current` = '$grn' WHERE book_id = '$bid'";
        $conn->query($sql);
        /* ----------I N S E R T    S T U D E N T    P H O T O  ----------------- */
        $target_dir = "files/student_photo/";
        $target_file = $target_dir . basename($_FILES["student_photo"]["name"]);
        if (isset($_FILES['student_photo'])) {
            $sql = "SELECT student_id,student_sid FROM $table WHERE student_grn = '$student_grn';";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $id = $row['student_id'];
                $student_grn = $row['student_grn'];
                $name = $_FILES['student_photo']['name'];
                $size = $_FILES['student_photo']['size'];
                $type = $_FILES['student_photo']['type'];
                $temp = $_FILES['student_photo']['tmp_name'];
                $caption1 = $_POST['caption'];
                $link = $_POST['link'];
                $str_arr = array_pop(explode(".", $name));
                $name = $table.$student_grn . '.' . $str_arr;
                move_uploaded_file($temp, "files/student_photo/" . $name);
                $path = $target_dir . $name;
                $sql =  "UPDATE $table SET student_photo ='$path' WHERE student_id = '$id';";
                $stmtinsert = $conn->prepare($sql);
                $result = $stmtinsert->execute();
                $result = $conn->query($sql);
            }
        }        
    }else{
        echo "<script>alert('General Register Number Already Used')</script>";
    }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/all.css">
    <title>Insert Student</title>
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
                $sql = "SELECT book_name,book_id,book_current FROM tbl_books WHERE book_active = 1;";
                $result = $conn->query($sql);
                if ($result->num_rows == 1) {
                    $row = $result->fetch_assoc();
                }
            ?>
            <div>
                <h1>Insert New Student Information</h1>
            </div>
            <div class="editform">
                <h2>Current GRN on <?php echo $row['book_name']; ?> is <?php echo $row['book_current']; ?> </h2>
                <form enctype="multipart/form-data" action="insert-student.php" method="post">
                    <table>
                        <h2>Personal Details</h2>
                        <input type="hidden" id="table" name="book_name" value="<?php echo $row['book_name']; ?>">
                        <input type="hidden" id="table" name="book_id" value="<?php echo $row['book_id']; ?>">
                        <tr>
                            <td colspan="3"><label for="Name">Full Name <span class="require">*</span></label></td>
                            <td><label for="Name">General Register No. <span class="require">*</span></label></td>
                            <td><label for="Name">Student ID </td>
                        </tr>
                        <tr>
                            <td><input type="text" placeholder="Enter First Name" name="student_fname" id="student_fname" required></td>
                            <td><input type="text" placeholder="Enter Middle Name" name="student_mname" id="student_mname" required></td>
                            <td><input type="text" placeholder="Enter Last Name" name="student_lname" id="student_lname" required></td>
                            <td><input type="text" placeholder="Enter General Register No" name="student_grn" id="student_grn" value="<?php echo $row['book_current']; ?> " required></td>
                            <td><input type="text" placeholder="Enter Student ID" name="student_sid" id="student_sid"></td>
                        </tr>
                        <tr>
                            <td><label for="Name">Student Mother Name <span class="require">*</span></label></td>
                            <td><label for="Name">Aadhaar Number <span class="require">*</span></label></td>
                            <td><label for="Name">Date of Birth <span class="require">*</span></label></td>
                            <td><label for="Name">Contact Number <span class="require">*</span></label></td>
                            <td><label for="Name">Gender</label> <span class="require">*</span></td>
                        </tr>
                        <tr>
                            <td><input type="text" placeholder="Enter Mother Name" name="student_mothername" id="student_mothername" value="<?php echo $row['student_mothername']; ?>" required></td>
                            <td><input type="text" placeholder="Enter Aadhaar Number" name="student_uid" id="student_uid" value="<?php echo $row['student_uid']; ?>" required></td>
                            <td><input type="text" placeholder="DD/MM/YYYY" name="student_dob" id="student_dob" value="<?php echo $row['student_dob']; ?>" required></td>
                            <td><input type="text" placeholder="Enter Contact Number" name="student_contact" id="student_contact" value="<?php echo $row['student_contact']; ?>" required></td>
                            <td><select name="student_gender" id="student_gender" required>
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td><label for="Name">Student Mother Tongue <span class="require">*</span></label></td>
                            <td><label for="Name">Category</label></td>
                            <td><label for="Name">Religion</label></td>
                            <td><label for="Name">Caste</label></td>
                            <td><label for="Name">BPL</label></td>
                        </tr>
                        <tr>
                            <td><input type="text" placeholder="Enter Mother Tongue" name="student_mothertongue" id="student_mothertongue" value="<?php echo $row['student_mothertongue']; ?>" required></td>
                            <td><input type="text" placeholder="Enter Category" name="student_category" id="student_category" value="<?php echo $row['student_category']; ?>"></td>
                            <td><input type="text" placeholder="Enter Religion" name="student_religion" id="student_religion" value="<?php echo $row['student_religion']; ?>"></td>
                            <td><input type="text" placeholder="Enter Caste" name="student_caste" id="student_caste" value="<?php echo $row['student_caste']; ?>"></td>
                            <td>
                                <select name="student_bpl" id="student_bpl">
                                    <option value="N">No</option>
                                    <option value="Y">Yes</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5">
                                <h2>Admission Details</h2>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="Name">Date of Admission <span class="require">*</span></label></td>
                            <td><label for="Name">Admission Standard <span class="require">*</span></label></td>
                            <td colspan="2"><label for="Name">Previous School Name </label></td>
                            <td><label for="Name">Previous School Standard</label></td>
                        </tr>
                        <tr>
                            <td><input type="text" placeholder="DD/MM/YYYY" name="student_dateofadmi" id="student_dateofadmi" value="<?php echo $row['student_dateofadmi']; ?>" required></td>
                            <td>
                                <select name="student_admistd" id="student_admistd" required>
                                        <option value="" disabled selected>Select Admission Standard</option>
                                        <option value="1">1st Standard</option>                                        
                                        <option value="2">2nd Standard</option>
                                        <option value="3">3rd Standard</option>
                                        <option value="4">4th Standard</option>
                                        <option value="5">5th Standard</option>
                                        <option value="6">6th Standard</option>
                                        <option value="7">7th Standard</option>
                                        <option value="8">8th Standard</option>
                                        <option value="9">9th Standard</option>
                                        <option value="10">10th Standard</option>
                                </select>
                            </td>
                            <td colspan="2"><input type="text" placeholder="Previous School" name="student_prev_schoolname" id="student_prev_schoolname"></td>
                            <td>
                                <select name="student_prev_schoolstd" id="student_prev_schoolstd">
                                    <option value="" selected>Select Previous School</option>
                                    <option value="1">1st Standard</option>
                                    <option value="2">2nd Standard</option>
                                    <option value="3">3rd Standard</option>
                                    <option value="4">4th Standard</option>
                                    <option value="5">5th Standard</option>
                                    <option value="6">6th Standard</option>
                                    <option value="7">7th Standard</option>
                                    <option value="8">8th Standard</option>
                                    <option value="9">9th Standard</option>
                                    <option value="10">10th Standard</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><label for="semienglish">Is Semi English? <span class="require">*</span></label></td>
                            <td><label for="semienglish">Admission Type <span class="require">*</span></label></td>
                        </tr>
                        <tr>
                            <td colspan="2"><select name="student_semieng" id="student_semieng" required style="margin-top: 0px;">
                                <option value="" selected disabled>is Semi English?</option>
                                    <option value="Y">Yes</option>
                                    <option value="N">No</option>
                                </select></td>
                            <td colspan="3">
                                <select name="student_admitype" id="student_admitype" required style="margin-top: 0px;">
                                    <option value="Regular">Regular</option>
                                    <option value="RTE 25%">RTE 25%</option>
                                    <option value="Out of School">Out of School</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5">
                                <br>
                                <h2>Disability Details</h2>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="Name">Is Disable ? <span class="require">*</span></label></td>
                            <td colspan="2"><label for="Name">Disability Type</label></td>
                            <td><label for="Name">Disability Percentage</label></td>
                        </tr>
                        <tr>
                            <td><select name="student_disability" id="student_disability" required>
                                    <option value="N" <?php if ($row['student_disability'] == 'N') {
                                                            echo "selected";
                                                        } ?>>No</option>
                                    <option value="Y" <?php if ($row['student_disability'] == 'Y') {
                                                            echo "selected";
                                                        } ?>>Yes</option>
                                </select></td>
                            <td colspan="2">
                                <select name="student_disabilitytype" id="student_disabilitytype">
                                    <option value='Acid Attack Victim'>Acid Attack Victim</option>
                                    <option value='Autism Spectrum Disorder'>Autism Spectrum Disorder</option>
                                    <option value='Blindness'>Blindness</option>
                                    <option value='Cerebral Palsy'>Cerebral Palsy</option>
                                    <option value='Chronic Neurological Conditions'>Chronic Neurological Conditions</option>
                                    <option value='Dwarfism' >Dwarfism</option>
                                    <option value='Epidermolysis Bullosa' >Epidermolysis Bullosa</option>
                                    <option value='Hearing Impairment - deft and hard of hearing' >Hearing Impairment - deft and hard of hearing</option>
                                    <option value='Hemophilia' >Hemophilia</option>
                                    <option value='Intellectual Disability - Mentally challenged / Slow Learners' >Intellectual Disability - Mentally challenged / Slow Learners</option>
                                    <option value='Leprosy Cured Persons' >Leprosy Cured Persons</option>
                                    <option value='Locomotor Disability including Orthopedic disability' >Locomotor Disability including Orthopedic disability</option>
                                    <option value='Low vision / Partial Blind' >Low vision / Partial Blind</option>
                                    <option value='Mental Illness' >Mental Illness</option>
                                    <option value='Multiple Disabilities' >Multiple Disabilities</option>
                                    <option value='Multiple Sclerosis' >Multiple Sclerosis</option>
                                    <option value='Muscular Dystrophy' >Muscular Dystrophy</option>
                                    <option value='Parkinson’s Disease' >Parkinsons Disease</option>
                                    <option value='Sickle Cell Disease' >Sickle Cell Disease</option>
                                    <option value='Specific Learning Disabilities' >Specific Learning Disabilities</option>
                                    <option value='Speech and Language Disability' >Speech and Language Disability</option>
                                    <option value='Thalassemia / Cancer' >Thalassemia / Cancer</option>
                                    <option value='' >Not Applicable</option>
                                </select>
                            </td>
                            <td><input type="text" placeholder="Disability Percentage" name="student_dispercentage" id="student_dispercentage" value="<?php echo $row['student_dispercentage']; ?>"></td>
                        </tr>
                        <tr>
                            <td colspan="5">
                                <h2>Birth Details</h2>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="Name">Birth Place</label></td>
                            <td><label for="Name">Birth Taluka</label></td>
                            <td><label for="Name">Birth District</label></td>
                            <td><label for="Name">Birth State</label></td>
                        </tr>
                        <tr>
                            <td><input type="text" placeholder="Birth Place" name="student_dob_place" id="student_dob_place" value="<?php echo $row['student_dob_place']; ?>"></td>
                            <td><input type="text" placeholder="Birth Taluka" name="student_dob_taluka" id="student_dob_taluka" value="<?php echo $row['student_dob_taluka']; ?>"></td>
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