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
                <form enctype="multipart/form-data" action="lcd.php" method="post">
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