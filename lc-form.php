<?php
    require "config.php";
    if (!isset($_SESSION['uid'])) {
        header("Location: login.php");
        exit;
    }
    if ($_SESSION['prev_id'] == 2) {
        header("Location: ./index.php");
    }
    $id =  $_GET['id'];
    $grn =  $_GET['grn'];
    $tble =  $_GET['xyz'];
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/datatable.css">
    <title>LC Required Information</title>
    <link rel="icon" type="image/x-icon" href="./assets/education.png">
    <style>
        .editform form{
            margin: 3px auto;
            width: 50%;
        }
    </style>
</head>
<body>
    <?php require_once('navbar.php'); ?>
    <div class="row1">
        <div class="columnz left">
            <?php require_once('sidebar.php'); ?>
        </div>
        <div class="columnz right"> 
            <div class="editform">
                <form enctype="multipart/form-data" action="lc.php" method="post">
                    <h1>Leaving Certificate Required Details</h1>
                    <table>
                        <input type="hidden" name="tbl" value="<?php echo $tble; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <tr>
                            <td><label for="lc_srn">General Register No. <span class="require">*</span></label></td>
                            <td><input type="text" placeholder="Enter LC Serial No" name="stud_grn" id="stud_grn" value="<?php echo $grn;?>" readonly required></td>
                        </tr>
                        <tr>
                            <td><label for="lc_srn">LC Serial Number <span class="require">*</span></label></td>
                            <td><input type="text" placeholder="Enter LC Serial No" name="lc_srn" id="lc_srn" required></td>
                        </tr>
                        <tr>
                            <td><label for="academic_prg">Academic Progress <span class="require">*</span></label></td>
                            <td><input type="text" placeholder="Academic Progress" name="academic_prg" id="academic_prg" required></td>
                        </tr>
                        <tr>
                            <td><label for="behavior">Student Behavior <span class="require">*</span></label></td>
                            <td><input type="text" placeholder="Behavior" name="behavior" id="behavior" required></td>
                        </tr>
                        <tr>
                            <td><label for="date">Date of School Leaving <span class="require">*</span></label></td>
                            <td><input type="text" placeholder="DD/MM/YYYY" name="leave_date" id="leave_date" required></td>
                        </tr>
                        <tr>
                            <td><label for="date">Standard When Leaving <span class="require">*</span></label></td>
                            <td><select name="leave_std" id="leave_std" required>
                                        <option value="" disabled selected>Select Standard</option>
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
                                </select></td>
                        </tr>
                        <tr>
                            <td><label for="reason">Reason of School Leaving <span class="require">*</span></label></td>
                            <td><input type="text" placeholder="Reason" name="Reason" id="Reason" required></td>
                        </tr>
                        <tr>
                            <td colspan="">
                                <button type="submit" name="submit" class="addbtn">Generate LC</button>
                            </td>
                        </tr>                                          
                    </table>
                </form>
            </div>             
        </div>
    </div>
</body>

</html>